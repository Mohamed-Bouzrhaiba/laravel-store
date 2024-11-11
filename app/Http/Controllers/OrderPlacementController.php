<?php

namespace App\Http\Controllers;

 use App\Models\Addresse;
    use App\Models\Order;
    use App\Models\CartItem;
    use App\Models\OrderDetails;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

    class OrderPlacementController extends Controller
    {
        public function showCheckout(){

            $user  = Auth::user();
            $cart = CartItem::where("user_id", $user->id)->get();
            $addresses = Addresse::where('user_id', $user->id)->get();
            foreach($cart as $item){
                if($item->quantity >  $item->product->stock_quantity){
                    return redirect()->back()->with('danger','stock quantity problem..!');
                }
            }
            $totalAmount = $cart->sum(function($product) {
                return $product->quantity * $product->price;
            });


            return view("checkout",compact("cart","addresses","totalAmount"));

        }

        public function processOrder(Request $request) {
            $formFields = $request->validate([
                'addresse_id' => 'required|exists:addresses,id',
            ]);

            $orderFields = [
                'user_id' => Auth::user()->id,
                'addresse_id' => $formFields['addresse_id'],
                'payment_method' => 'cash',
                'total_amount' => 0, // We'll calculate this later
            ];
            $order = Order::create($orderFields);

            $cartItems = CartItem::where('user_id', Auth::user()->id)->get();

            $totalAmount = 0;

            foreach ($cartItems as $item) {
                $totalAmount += $item->product->price * $item->quantity;

                OrderDetails::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);
            }
           // dd($totalAmount);
            $order->update(['total_amount' => $totalAmount]);

            CartItem::where('user_id', Auth::user()->id)->delete();

            return redirect()->route("orders")->with('success', 'Order placed successfully! You will pay cash on delivery.');
        }

    }

