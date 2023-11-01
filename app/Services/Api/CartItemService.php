<?php

namespace App\Services\Api;

use App\Models\Cart;
use App\Models\Item;
use Exception;
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

            $percent = $request->item_price * $data->dis_item_price / 100;
            $actual_price = $request->item_price - $percent;

            $recordExists = Cart::where(['user_id' => auth()->user()->id, 'item_id' => $request->item_id])->first();

            if ($recordExists) {

                $newupdaterecord = [
                    'item_quantity' => $recordExists->item_quantity + $request->item_quantity,
                ];

                $setdata = Cart::where(['id' => $recordExists->id, 'user_id' => auth()->user()->id, 'item_id' => $request->item_id])
                    ->update($newupdaterecord);

                $record = Cart::where(['user_id' => auth()->user()->id, 'item_id' => $request->item_id])->first();

                $new = [
                    'item_price' => round($actual_price) * $record->item_quantity,
                ];

                $updatedata = Cart::where(['id' => $recordExists->id, 'user_id' => auth()->user()->id, 'item_id' => $request->item_id])
                    ->update($new);

                if ($updatedata) {
                    return response()->json(
                        [
                            'status' => true,
                            'message' => 'Successfully',
                        ],
                        200
                    );
                } else {
                    return response()->json(
                        [
                            'status' => false,
                            'message' => 'Data Not Updated',
                            'data' => [],
                        ],
                        200
                    );
                }

            } else {

                $percent = $request->item_price * $data->dis_item_price / 100;
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
                $cartItem['discount_amount'] = round($discount_amount);

                if ($cartItem) {
                    return response()->json(
                        [
                            'status' => true,
                            'message' => 'Add Successfully',
                        ],
                        200
                    );
                } else {
                    return response()->json(
                        [
                            'status' => false,
                            'message' => 'Data Not Updated',
                            'data' => [],
                        ],
                        200
                    );
                }

            }

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
        $secondcartitemlist = DB::table('items')
            ->join('cart_items', 'cart_items.item_id', '=', 'items.item_id')
            ->select(
                'items.item_image', 'cart_items.item_id',
                'cart_items.item_name', 'cart_items.id',
                'cart_items.item_weight', 'cart_items.item_quantity',
                'cart_items.item_price', 'cart_items.dis_item_price',
                'cart_items.item_description', 'cart_items.item_expiry_date')
            ->where([
                'cart_items.user_id' => auth()->user()->id,
                'cart_items.purchased_status' => 1,
            ])
            ->get();

        if (count($secondcartitemlist) > 0) {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Find Successfully',
                    'data' => $secondcartitemlist,
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

    // Start Update Add to Cart quantity and amount

    public static function updateItemQuantity(Request $request)
    {
        try {

            $request->validate([
                'id' => 'required|integer',
                'item_quantity' => 'required|integer',
                'item_id' => 'required|integer'
            ]);

            $newdatainput = [
                'id' => $request->id,
                'item_quantity' => $request->item_quantity,
            ];

            $updatedata = Cart::where(['id' => $request->id,
            'user_id' =>auth()->user()->id,
            'item_id' => $request->item_id])
            ->update($newdatainput);

            $update = Cart::where(['id' => $request->id])->first();
            $quantitywithprice = $newdatainput['item_quantity'] * $update['item_price'];
            $percent = $quantitywithprice * $update['dis_item_price'] / 100;
            $actual_price = $quantitywithprice - $percent;

            $updateprice =Cart::where(['id' => $request->id,
            'user_id' => auth()->user()->id,
            'item_id' => $update['item_id']
            ])->update(['item_price' => round($actual_price)]);

            if ($updateprice) {
                return response()->json(
                    [
                        'status' => true,
                        'message' => 'Updated Successfully',
                        'data' => $updateprice,
                    ],
                    200
                );
            } else {
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'Data Not Updated',
                    ],
                    400
                );
            }

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }

    }

    // End Update Add to Cart quantity and amount

}
