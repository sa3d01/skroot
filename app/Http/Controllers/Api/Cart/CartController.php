<?php

namespace App\Http\Controllers\Api\Cart;

use App\Http\Controllers\Controller;
use App\Http\Enums\ProductTypes;
use App\Http\Enums\UserRole;
use App\Http\Resources\Cart\CartDTO;
use App\Http\Resources\General\StaticPageDTO;
use App\Http\Resources\Product\PartDTO;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $user=$request->user();
        $pre_request_cart=Cart::where(['user_id'=>$user->id,'status'=>'pre_request'])->latest()->first();
        if (!$pre_request_cart){
            return response()->json(['data'=>[]]);
        }else{
            return response()->json(['data'=>CartDTO::collection($pre_request_cart->cartItems)]);

        }
    }

    public function addToCart($part_id,Request $request)
    {
        if (!Product::find($part_id))
            return response()->json(['message' => "هذه القطعه غير متاحه."], 400);
        $user=$request->user();
        $pre_request_cart=Cart::where(['user_id'=>$user->id,'status'=>'pre_request'])->latest()->first();
        if (!$pre_request_cart){
            $pre_request_cart=Cart::create([
               'user_id'=>$user->id
            ]);
        }
        $cart_item=CartItem::where(['cart_id'=>$pre_request_cart->id,'product_id'=>$part_id])->latest()->first();
        if ($cart_item){
            return response()->json(['message' => "هذه القطعه بسلتك بالفعل."], 400);
        }
        CartItem::create(['cart_id'=>$pre_request_cart->id,'product_id'=>$part_id]);
        return response()->json(['message' => 'success.'], 200);
    }

    public function updateCounts(){
        foreach (\request()->cart as $obj){
            $cartItem=CartItem::find($obj['cart_item_id']);
            $cartItem->update([
               'count'=>$obj['count']
            ]);
        }
        return response()->json(['message' => 'success.'], 200);
    }

    public function requestPricing(){
        $user=\request()->user();
        $pre_request_cart=Cart::where(['user_id'=>$user->id,'status'=>'pre_request'])->latest()->first();
        foreach ($pre_request_cart->cartItems as $cartItem){
            $supplier_ids=\DB::table('car_brand_user')->where('car_brand_id',$cartItem->product->car_brand_id)->pluck('user_id');
            $suppliers=User::whereIn('id',$supplier_ids)->get();
            foreach ($suppliers as $supplier){
                ProductRequest::create([
                   'cart_item_id'=>$cartItem->id,
                   'supplier_id'=>$supplier->id
                ]);
            }
        }
        $pre_request_cart->update([
            'status'=>'requested'
        ]);
        return response()->json(['message' => 'success.'], 200);
    }

}
