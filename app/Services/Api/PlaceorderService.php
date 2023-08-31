<?php

namespace App\Services\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlaceorderService
{
    public static function Placeorder(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
        ]);

        $getItem['Products'] = DB::table('checkout')->where('user_id', $request->user_id)->get();

        $subtotal = 0;
        $discountvalue = 0;
        $finaltotal = 0;

        foreach ($getItem as $data) {
            $subtotal += $data->item_total;
            $discountvalue += $data->item_dis_price;
            $finaltotal += $data->item_total - $data->item_dis_price;
        }

        // if ($getItem) {
        //     return response()->json(
        //         [
        //             'status' => true,
        //             'message' => 'Successfully',
        //             'data' => $getItem,
        //         ],
        //         200
        //     );
        // } else {
        //     return response()->json(
        //         [
        //             'status' => false,
        //             'message' => 'Data not Found',
        //             'data' => [],
        //         ],
        //         200
        //     );
        // }

    }

}
