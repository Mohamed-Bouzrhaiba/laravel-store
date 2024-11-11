<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\CartItem;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\PayPal as PayPalClient;


class PaypalController extends Controller
{
    public function paypal(Request $request) {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config("paypal"));
        $provider->getAccessToken();

        $cartItems = CartItem::where('user_id', Auth::id())->with('product')->get();
        $totalAmount = 0;
        $items = [];

        foreach ($cartItems as $item) {
            if ($item->product) {
                $items[] = [
                    "name" => $item->product->name,
                    "unit_amount" => [
                        "currency_code" => "USD",
                        "value" => number_format($item->product->price, 2, '.', ''),
                    ],
                    "quantity" => $item->quantity,
                ];
                // Accumulate the total amount
                $totalAmount += $item->quantity * $item->product->price;
            }
        }
        //dd($totalAmount);

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route("success",['addresse_id' => $request->addresse_id]),
                "cancel_url" => route("cancel")
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => number_format($totalAmount, 2, '.', ''),
                        "breakdown" => [
                            "item_total" => [
                                "currency_code" => "USD",
                                "value" => number_format($totalAmount, 2, '.', ''),
                            ]
                        ]
                    ],
                    "items" => $items,
                ]
            ]
        ]);

        // Redirect to PayPal checkout if order creation is successful
        if (isset($response['links'][1]['href'])) {
            return redirect($response['links'][1]['href']);
        } else {
            // Debug response in case of an error
            dd(vars: $response);
        }
    }


public function success(Request $request)
{
    $formfields = $request->validate([
        'addresse_id' => 'required|exists:addresses,id',

    ]);
    $provider = new PayPalClient();
    $provider->setApiCredentials(config("paypal"));
    $provider->getAccessToken();
    $response = $provider->capturePaymentOrder($request->token);

    if (isset($response['status']) && $response['status'] === 'COMPLETED') {

            // Create the main Order
            $order = new Order;
            $order->user_id = Auth::id();
            $order->total_amount = $response['purchase_units'][0]['payments']['captures'][0]['amount']['value'];
            //$order->currency = $response['purchase_units'][0]['payments']['captures'][0]['amount']['currency_code'];
            //$order->payment_status = $response['status'];
            $order->payment_method = "PayPal";
            $order->addresse_id = $formfields['addresse_id'];
            $order->save();
    //dd($order);
    $cartItems = CartItem::where('user_id', Auth::id())->get();

    foreach ($cartItems as $cartItem) {
        $orderDetail = new OrderDetails;
        $orderDetail->order_id = $order->id;
        $orderDetail->product_id = $cartItem->product_id;
        $orderDetail->quantity = $cartItem->quantity;
        $orderDetail->price = $cartItem->price;
        $orderDetail->save();
        $cartItem->product->decrement('stock_quantity', $cartItem->quantity);

    }

    CartItem::where('user_id', Auth::id())->delete();

        return to_route("orders")->with("success","order paid succefuly ...!");
    } else {
        return redirect()->route('cancel');
    }
    }


    public function cancel (){

    }
}
