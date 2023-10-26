<?php

namespace App\Services\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CouponCodeService
{
    public static function addCouponcode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'coupan_id' => 'required',
        ]);

        if ($validator->fails())
        {
            return response()->json([
                'message' => 'Validation fails',
                'error' => $validator->errors(),
            ], 400);
        }

        $getCodeData = DB::table('coupans')->where('coupan_id', $request->coupan_id)->first();
        $getCartDatabyuser = DB::table('cart_items')->where('user_id', auth()->user()->id)->get();

        if ($getCartDatabyuser)
        {
            foreach ($getCartDatabyuser as $obj) {
                DB::table('cart_items')->where('item_id', $obj->item_id)->update(['promocode_discount' => $getCodeData->id]);
            }
        }

        if ($getCodeData) {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Add Successfully',
                    'Data' => $getCodeData,
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Not Found',
                    'Data' => $getCodeData,
                ],
                200
            );
        }

    }

    public static function getCouponcode(Request $request)
    {
        $getCouponCode = DB::table('coupans')->where(['coupan_status' => 0])->get();

        if (count($getCouponCode) > 0) {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Successfully',
                    'data' => $getCouponCode,
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

    public static function RemoveCouponcode(Request $request)
    {
        $request->validate([
            'coupan_id' => 'required',
        ]);

        $deleteCouponCode = DB::table('coupans')->where('coupan_id', $request->coupan_id)->delete();

        if ($deleteCouponCode) {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data Deleted Successfully',
                    'data' => $deleteCouponCode,
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
