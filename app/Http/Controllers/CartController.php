<?php


namespace App\Http\Controllers;


use App\Models\Product;
use App\Models\Addresse;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request, Product $product) // Using route model binding
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // check qty
        if($request->quantity  > $product->stock_quantity){
            return back()->with('danger','quantity demanded not dispooo!');
        }
        $user = Auth::user();

        $cartItem = CartItem::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            CartItem::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'price' => $product->price,
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function index(){
        $user = Auth::user();
        //dd(Auth::user()->id);
        $addresses = Addresse::where('user_id', $user->id)->get();


        $CartItems = CartItem::where('user_id', $user->id)->get();

        return view('cart', compact(['CartItems','addresses']));
    }
    public function clearCart(CartItem $cartItem){
        $cartItem->delete();
        return redirect()->back()->with('success', 'Deleted successfully!');
    }
    public function updateCart(Request $request){
        $item = CartItem::find($request->item_id);

        if ($item) {
            $item->quantity = $request->quantity;
            $item->save();

            $newTotal = $item->price * $item->quantity;

            return response()->json([
                'success' => true,
                'newTotal' => $newTotal
            ]);
        }

        return response()->json(['success' => false]);
            }

        }
