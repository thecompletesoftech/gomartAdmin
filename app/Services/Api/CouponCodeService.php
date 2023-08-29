<?php

namespace App\Services\Api;

use App\Models\Coupan;
use App\Services\FileService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CouponCodeService
{

    public static function addCouponcode(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'coupan_code' => 'required',
                'discount' => 'required',
                'coupon_desc' => 'required',
                'expiry_date' => 'required',
                'coupan_status' => 'required',
                'discount_type' => 'required',
                'store_id' => 'required',
                'coupon_image' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation fails',
                    'error' => $validator->errors(),
                ], 400);
            }

            $CouponCode = FileService::fileUploaderWithoutRequest($request->coupon_image, 'couponcode/image/');

            $AddratingInput = [
                'coupan_code' => $request->coupan_code,
                'discount' => $request->discount,
                'expiry_date' => $request->expiry_date,
                'coupan_status' => $request->coupan_status,
                'store_id' => $request->store_id,
                'discount_type' => $request->discount_type,
                'coupon_desc' => $request->coupon_desc,
                'coupon_image' => $CouponCode,
            ];

            $CoupanAdded = Coupan::create($AddratingInput);

            if ($CoupanAdded) {
                return response()->json(
                    [
                        'status' => true,
                        'message' => 'Coupan Add Successfully',
                        'Data' => $CoupanAdded,
                    ],
                    200
                );
            } else {
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'Not Added',
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

    public static function getCouponcode(Request $request)
    {
        $getCouponCode = DB::table('coupans')->get();

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