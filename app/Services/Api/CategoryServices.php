<?php

namespace App\Services\Api;

use Illuminate\Support\Facades\DB;

class CategoryServices
{

    public static function getCategory()
    {

        $getData = DB::table('categories')->join('languages', 'languages.language_id', '=', 'categories.language_id')
            ->select('categories.*','languages.language_name','languages.language_slug')
            ->get();

        if (count($getData) > 0) {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Successfully',
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

    }
}