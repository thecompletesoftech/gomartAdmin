<?php

namespace App\Services\Api;

use App\Models\Cart;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartItemService
{

    // Start Add To Cart

    public static function Addcart(Request $request)
    {

        $request->validate([
            'user_id' => 'required|integer',
            'item_id' => 'required|integer',
            'item_name' => 'required',
            'item_price' => 'required',
            'item_quantity' => 'required|integer',
            'item_image' => 'required',
            'item_weight' => 'required',
        ]);

        $ItemImage = FileService::fileUploaderWithoutRequest($request->item_image, 'cartItem/image/');

        $cartItem = Cart::Create([
            'user_id' => $request->user_id,
            'item_id' => $request->item_id,
            'item_name' => $request->item_name,
            'item_price' => $request->item_price,
            'item_quantity' => $request->item_quantity,
            'item_image' => $ItemImage,
            'item_weight' => $request->item_weight,
            'item_total' => $request->item_price * $request->item_quantity,
        ]);

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
                    'message' => 'Data not Found',
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
        $request->validate([
            'user_id' => 'required',
            'item_id' => 'required',
        ]);

        $cartItem = DB::table('cart_items')->where('item_id', $request->item_id)->orWhere('user_id', $request->user_id)->get();

        if ($cartItem) {
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