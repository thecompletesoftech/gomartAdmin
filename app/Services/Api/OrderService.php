<?php

namespace App\Services\Api;

use App\Models\Order;
use App\Models\OrderItem;
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
                // 'items' => 'required',
                'order_date' => 'required',
                'driver_id' => 'required',
                'store_id' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation fails',
                    'error' => $validator->errors(),
                ], 400);
            }
            
            $data= json_encode($request->items,true);
            $new=json_decode($data);
          
            $OrderInput = [           
                'user_id' => Auth::user()->id,
                'driver_id' => $request->driver_id,
                'store_id' => $request->store_id,
                'order_date' => $request->order_date,
                'order_amount' => $request->order_amount,
                'order_type' => $request->order_type,
                'order_status' => 0,
            ];
           
            $addOrder = Order::create($OrderInput);
           
            $get_order=Order::where('order_id',$addOrder->order_id)->first();
        
            foreach ($new as $newdata) {
                       
                $newdatainput = [
                    'order_id' => $get_order['order_id'],
                    'item_id' => $newdata->item_id,
                    'item_name' => $newdata->item_name,
                    'item_price' => $newdata->item_price,
                    'store_id' => $newdata->store_id,
                    'category_id' => $newdata->category_id,
                    'quantity' => $newdata->quantity,
                    'item_publish' => $newdata->item_publish,
                    'dis_item_price' => $newdata->dis_item_price,
                    'item_description' => $newdata->item_description,
                ];

                OrderItem::create($newdatainput);

            }

            // $data=[
            //     'order_id'=> $OrderInput->order_id,
            //     'item_id' => $OrderInput['items']['item_id']
            // ]
            // $screen = 0;
            // $input = [
            //     'notification' => 'Order Purchase',
            //     'message' => 'You Order Purchase',
            //     'user_id' => auth()->user()->id,
            //     'order_id' => $request->order_id,
            // ];
            // NotificationService::create($input, $screen);

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

    public static function deleteorder(Request $request)
    {

        try {

            $validator = Validator::make($request->all(), [
                'user_id' => 'required',
                'order_id' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation fails',
                    'error' => $validator->errors(),
                ], 400);
            }

            $orderdelete = DB::table('orders')
                ->where('order_id', $request->order_id)
                ->orWhere('name', $request->user_id)->delete();

            if ($orderdelete) {
                return response()->json(
                    [
                        'status' => true,
                        'message' => 'Order Deleted Successfully',
                        'Order' => $orderdelete,
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

    public static function getOrderdetail(Request $request)
    {

        try {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required',
                'order_id' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation fails',
                    'error' => $validator->errors(),
                ], 400);
            }

            $getData = DB::table('orders')->join('items', 'items.item_id', '=', 'orders.item_name')
                ->where('order_id', $request->order_id)->orWhere('name', $request->user_id)
                ->select('orders.*', 'items.*')
                ->get();

            if ($getData) {
                return response()->json(
                    [
                        'status' => true,
                        'message' => 'Order Find Successfully',
                        'data' => $getData,
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
