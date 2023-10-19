<?php

namespace App\Services\Api;

use App\Models\Cart;
use App\Models\Item;
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

        $data = Item::where('item_id', $request->item_id)->first();

        if ($data->quantity < $request->item_quantity) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Stock in Not Available According Your Quantity',
                ],
                400
            );
        } else {
            $cartItem = Cart::Create([
                'user_id' => $request->user_id,
                'item_id' => $request->item_id,
                'item_name' => $request->item_name,
                'item_price' => $request->item_price,
                'item_quantity' => $request->item_quantity,
                'item_image' => $ItemImage,
                'item_weight' => $request->item_weight,
                'item_expiry_date' => $request->item_expiry_date,
                'item_description' => $request->item_description,
                'dis_item_price' => $request->dis_item_price,
            ]);
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
        $cartItem = DB::table('cart_items')->where('user_id', auth()->user()->id)->get();

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