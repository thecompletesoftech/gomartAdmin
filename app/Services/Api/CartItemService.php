<?php

namespace App\Services\Api;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartItemService
{

    public static function Addcart(Request $request)
    {

        $request->validate([
            'user_id' => 'required|integer',
            'item_id' => 'required|integer',
            'quantity' => 'required|integer',
        ]);

        $cartItem = Cart::Create([
            'user_id' => $request->user_id,
            'item_id' => $request->item_id,
            'quantity' => $request->quantity,
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
}