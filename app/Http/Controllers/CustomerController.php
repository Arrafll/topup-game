<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Query\JoinClause;

class CustomerController extends Controller
{
    //
    public function shop()
    {
        $data = [
            'title' => 'Home',
            'role' => 2
        ];

        return view('customer.shop', $data);
    }

    public function get_product(Request $request)
    {

        $queryAttachment = DB::table('attachments')
            ->select(DB::raw(value: 'MIN(attachments.name) as product_pic'), 'product_id')
            ->groupBy('attachments.product_id');
        $products = DB::table('products')
            ->select('products.*', 'categories.name as category_name', 'attachments.*')
            ->leftJoin('categories', 'categories.id', '=', 'products.category_id')
            ->leftJoinSub($queryAttachment, 'attachments', function (JoinClause $join) {
                $join->on('products.id', '=', 'attachments.product_id');
            })
            ->orderBy('products.created_at', direction: 'ASC')
            ->groupBy('products.id')
            ->get();

        return response()->json(['products' => $products]);
    }
}
