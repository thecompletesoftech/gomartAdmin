<?php

namespace App\Services\Api;

use App\Models\Adduseraddress;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AddaddressService
{

    public static function useraddress(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'user_id' => 'required',
                'order_id' => 'required',
                'address' => 'required',
                'zip' => 'required',
                'city' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation fails',
                    'error' => $validator->errors(),
                ], 400);
            }

            $addressinput = [
                'user_id' => $request->user_id,
                'order_id' => $request->order_id,
                'address' => $request->address,
                'zip' => $request->zip,
                'city' => $request->city,
            ];

            $add = Adduseraddress::create($addressinput);

            if ($add) {
                return response()->json(
                    [
                        'status' => true,
                        'message' => 'Address Add Successfully',
                        'data' => $add,
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

    public static function listuseraddress(Request $request)
    {
        try {

            $add = Adduseraddress::get();

            if ($add) {
                return response()->json(
                    [
                        'status' => true,
                        'message' => 'Data Find Successfully',
                        'data' => $add,
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