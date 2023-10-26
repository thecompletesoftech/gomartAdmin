<?php

namespace App\Services\Api;

use App\Models\Cart;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartItemService
{

    // Start Add To Cart

    public static function Addcart(Request $request)
    {

        $request->validate([
            'item_id' => 'required|integer',
            'item_name' => 'required',
            'item_price' => 'required',
            'item_quantity' => 'required|integer',
            'item_weight' => 'required',
            'item_expiry_date' => 'required',
        ]);

        $data = Item::where('item_id', $request->item_id)->first();

        if ($request->item_quantity > $data->quantity) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Stock in Not Available According Your Quantity',
                ],
                400
            );
        } else {
            $percent=$request->item_price * $data->dis_item_price/100;
            $actual_price = $request->item_price - $percent;

            $cartItem = Cart::Create([
                'user_id' => auth()->user()->id,
                'item_id' => $request->item_id,
                'item_name' => $request->item_name,
                'item_price' => round($actual_price),
                'item_quantity' => $request->item_quantity,
                'item_weight' => $request->item_weight,
                'item_expiry_date' => $request->item_expiry_date,
                'item_description' => $request->item_description,
                'dis_item_price' => $data->dis_item_price,

            ]);
            $discount_amount = $request->item_price * $data->dis_item_price / 100;
            $cartItem['discount_amount']=round($discount_amount);

        }

        if ($cartItem) {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Item Added Successfully',
                    'data' => $cartItem,
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Found',
                    'data' => [],
                ],
                200
            );
        }

    }

    // End Add To Cart

    // remove Add To Cart

    public static function RemoveAddcart(Request $request)
    {
        $request->validate([
            'cart_id' => 'required',
        ]);

        $cartItem = DB::table('cart_items')->where('id', $request->cart_id)->delete();

        if ($cartItem) {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Deleted Successfully',
                    'data' => $cartItem,
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data Not Deleted',
                    'data' => [],
                ],
                200
            );
        }

    }

    // End Remove Add To Cart

    // Start get Add To Cart Record
    public static function getCartItem(Request $request)
    {
        $cartItem = DB::table('items')
            ->join('cart_items', 'cart_items.item_id', '=', 'items.item_id')
            ->join('coupans', 'coupans.coupan_id', '=', 'cart_items.coupon_id')
            ->select(
                'items.item_image', 'cart_items.item_id',
                'cart_items.item_name', 'cart_items.id',
                'cart_items.item_weight', 'cart_items.item_quantity',
                'cart_items.item_price', 'cart_items.dis_item_price',
                'cart_items.item_description', 'cart_items.item_expiry_date',
                'cart_items.coupon_id')
            ->where('cart_items.user_id', auth()->user()->id)->get();

        if ($cartItem)
        {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Find Successfully',
                    'data' => $cartItem,
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data not Found',
                    'data' => [],
                ],
                200
            );
        }

    }
    // End get Add To Cart Record
}
