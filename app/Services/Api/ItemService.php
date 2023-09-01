<?php

namespace App\Services\Api;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ItemService
{
    public static function getProduct()
    {
        $getItem = DB::table('items')->where('item_publish', 'Yes')->get();

        if (count($getItem) > 0) {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Successfully',
                    'data' => $getItem,
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

    public static function getProductByCatID(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'category_id' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation fails',
                    'error' => $validator->errors(),
                ], 400);
            }

            $getProductByCatId['product'] = DB::table('items')->where('items.category_id', $request->category_id)->get();

            foreach ($getProductByCatId['product'] as $rating) {
                $rating->rating = DB::table('reviewandratings')
                    ->where('item_id', $rating->item_id)->avg('rating');
            }

            if (count($getProductByCatId) > 0) {
                return response()->json(
                    [
                        'status' => true,
                        'message' => 'Successfully',
                        'data' => $getProductByCatId,
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

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public static function getProductByItemID(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'item_id' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation fails',
                    'error' => $validator->errors(),
                ], 400);
            }

            $getProductByCatId['product'] = DB::table('items')->where('items.item_id', $request->item_id)->get();

            foreach ($getProductByCatId['product'] as $rating) {
                $rating->rating = DB::table('reviewandratings')
                    ->where('item_id', $rating->item_id)->avg('rating');
            }

            if (count($getProductByCatId) > 0) {
                return response()->json(
                    [
                        'status' => true,
                        'message' => 'Find Successfully',
                        'data' => $getProductByCatId,
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

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public static function updateItemQuantity(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'item_id' => 'required',
                'item_quantity' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation fails',
                    'error' => $validator->errors(),
                ], 400);
            }
            
            $data['item_quantity'] = $request->item_quantity;

            $updatequanity = DB::table('cart_items')
                ->where('item_id', $request->item_id)
                ->update($data);

            if ($updatequanity) {
                return response()->json(
                    [
                        'status' => true,
                        'message' => 'Quantity Updated Successfully',
                    ],
                    200
                );
            } else {
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'not updated',
                    ],
                    200
                );
            }

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }

    }

}
