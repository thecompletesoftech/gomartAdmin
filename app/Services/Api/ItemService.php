<?php

namespace App\Services\Api;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Constraint\Count;

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
                $gete =
                $rating->rating = DB::table('reviewandratings')
                    ->where('item_id', $rating->item_id)->avg('rating');
                $like_status = DB::table('favorites')
                    ->where('user_id', $request->user_id)
                    ->where('item_id', $rating->item_id)
                    ->first();
                if ($like_status) {
                    $rating->like_status = 1;
                } else {
                    $rating->like_status = 0;
                }

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

}
