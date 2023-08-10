<?php

namespace App\Services\Api;

use App\Models\Order;
use App\Services\NotificationService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class OrderService
{

    public static function addOrder(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'order_amount' => 'required',
                'order_type' => 'required',
                'item_name' => 'required',
                'order_date' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation fails',
                    'error' => $validator->errors(),
                ], 400);
            }

            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = Str::random($charactersLength - 1);
            $randomCharacter = $characters[rand(0, $charactersLength - 1)];
            $randomString = substr_replace($randomString, $randomCharacter, rand(0, $charactersLength - 2), 0);

            $OrderInput = [
                'order_id' => $randomString,
                'name' => Auth::user()->id,
                'store_id' => 1,
                'item_name' => 1,
                'order_date' => $request->order_date,
                'order_amount' => $request->order_amount,
                'order_type' => $request->order_type,
                'order_status' => 0,
            ];

            $addOrder = Order::create($OrderInput);
            $screen = 0;
            $input = [
                'notification' => 'Order Purchase',
                'message' => 'You Order Purchase',
                'user_id' => auth()->user()->id,
                'order_id' => $request->order_id,
            ];

            NotificationService::create($input, $screen);

            if ($addOrder) {
                return response()->json(
                    [
                        'status' => true,
                        'message' => 'Order Add Successfully',
                        'OrderData' => $addOrder,
                    ],
                    200
                );
            } else {
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'Order Not Added',
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

    public static function cancelOrder(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'order_id' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation fails',
                    'error' => $validator->errors(),
                ], 400);
            }

            $input['order_status'] = 2;

            $result = DB::table('orders')->where('order_id', $request->order_id)->update($input);

            if ($result) {
                return response()->json(
                    [
                        'status' => true,
                        'message' => 'Order Cancel Successfully',
                    ],
                    200
                );
            } else {
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'Data not Updated',
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
