<?php

namespace App\Services\Api;

use Illuminate\Support\Facades\DB;

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
}
