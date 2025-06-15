<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Query\JoinClause;

class CustomerController extends Controller
{
    //
    public function shop()
    {
        $category = Category::all();

        $data = [
            'title' => 'Home',
            'role' => 2,
            'categories' => $category
        ];

        return view('customer.shop', $data);
    }

    public function home()
    {

        $data = [
            'title' => 'Home',
            'role' => 2
        ];

        return view('customer.mainPage.home', $data);
    }

    public function get_product(Request $request)
    {
        $limit = $request->limit;
        $category = $request->category;
        $orders = $request->orders;
        $offset = $request->offset;
        $categories = json_decode($request->categories);
        // $categories = implode(',', $categories);

        $queryAttachment = DB::table('attachments')
            ->select(DB::raw(value: 'MIN(attachments.name) as product_pic'), 'product_id')
            ->groupBy('attachments.product_id');
        $queryPackage = DB::table('product_packages')
            ->select(DB::raw(value: 'MIN(product_packages.price) as product_price'), 'product_id')
            ->groupBy('product_packages.product_id');
        $products = DB::table('products')
            ->select('products.*', 'categories.name as category_name', 'attachments.product_pic', DB::raw('IFNULL(product_packages.product_price,0) as product_price'))
            ->leftJoin('categories', 'categories.id', '=', 'products.category_id')
            ->leftJoinSub($queryAttachment, 'attachments', function (JoinClause $join) {
                $join->on('products.id', '=', 'attachments.product_id');
            })
            ->leftJoinSub($queryPackage, 'product_packages', function (JoinClause $join) {
                $join->on('products.id', '=', 'product_packages.product_id');
            });

        if (!empty($category)) {
            if ($category != "favorite") {
                $products = $products->where('products.category_id', '=', $category);
            }
        }

        if (!empty($categories)) {
            $products = $products->whereIn('products.category_id', $categories);
        }

        if (!empty($orders)) {
            $order = explode('-', $orders);
            $products = $products->orderBy( $order[0], $order[1]);
        }

 
        $products = $products->orderBy('products.updated_at', direction: 'DESC')
            ->groupBy('products.id');
        $productsTotal = $products->get()->count();
        $products = $products->limit($limit);
        
        if (!empty($offset)) {
            $products = $products->offset( $offset);
        }

        $products = $products->get();

        return response()->json(['products' => $products, 'productsCount' => $productsTotal]);


    }

    public function productList()
    {
        $data = [
            'title' => 'Home',
            'role' => 2
        ];

        return view('customer.product.list', $data);
    }
    public function invoiceList()
    {
        $data = [
            'title' => 'Home',
            'role' => 2
        ];

        return view('customer.invoice.list', $data);
    }

    public function productDetail($id)
    {
        $data = [
            'title' => 'Home',
            'role' => 2
        ];

        return view('customer.product.detail', $data);
    }

    public function productInvoice($id)
    {
        $data = [
            'title' => 'Home',
            'role' => 2
        ];

        return view('customer.invoice.invoice', $data);
    }
}
