<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductPackage;
use App\Models\Attachment;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Query\JoinClause;
use Midtrans\Config;
use Midtrans\Snap;


class GuestController extends Controller
{
    //
    public function home()
    {
        $data = [
            'title' => 'Home',
            'role' => 0
        ];

        return view('guest.home', $data);
    }

    public function get_product(Request $request)
    {
        $limit = $request->limit;
        $category = $request->category;
        $orders = $request->orders;
        $offset = $request->offset;
        $search = $request->search;
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


        if (!empty($search)) {
            $products = $products->where('products.name', 'like', "%$search%")->orWhere('products.game', 'like', "%$search%");
        }

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
            $products = $products->orderBy($order[0], $order[1]);
        }


        $products = $products->orderBy('products.updated_at', direction: 'DESC')
            ->groupBy('products.id');
        $productsTotal = $products->get()->count();
        $products = $products->limit($limit);

        if (!empty($offset)) {
            $products = $products->offset($offset);
        }

        $products = $products->get();

        return response()->json(['products' => $products, 'productsCount' => $productsTotal]);


    }

    public function product_detail($id)
    {
        $product = Product::findOrFail($id);

        $queryAttachment = DB::table('attachments')
            ->select(DB::raw(value: 'MIN(attachments.name) as product_pic'), 'product_id')
            ->groupBy('attachments.product_id');
        $queryPackage = DB::table('product_packages')
            ->select(DB::raw(value: 'MIN(product_packages.price) as product_price'), 'product_id')
            ->groupBy('product_packages.product_id');
        $related = DB::table('products')
            ->select('products.*', 'attachments.product_pic', DB::raw('IFNULL(product_packages.product_price,0) as product_price'))
            ->leftJoinSub($queryAttachment, 'attachments', function (JoinClause $join) {
                $join->on('products.id', '=', 'attachments.product_id');
            })
            ->leftJoinSub($queryPackage, 'product_packages', function (JoinClause $join) {
                $join->on('products.id', '=', 'product_packages.product_id');
            })
            ->where('category_id', $product->category_id)
            ->where('products.id', '!=', $product->id)
            ->limit(5)
            ->get();


        $queryVouchers = DB::table('vouchers')
            ->select(DB::raw('COUNT(vouchers.id) as vouchers_count'), 'vouchers.packages_id')
            ->where('vouchers.is_used', '=', '0')
            ->groupBy('vouchers.packages_id');
        $packages = DB::table('product_packages')
            ->select(DB::raw('IFNULL(vouchers.vouchers_count,0) as vouchers_count'), 'product_packages.*')
            ->leftJoinSub($queryVouchers, 'vouchers', function (JoinClause $join) {
                $join->on('product_packages.id', '=', 'vouchers.packages_id');
            })
            ->where('product_id', '=', $id)
            ->groupBy('product_packages.id')
            ->get();

        $attachments = Attachment::where('product_id', '=', $id)->get();
        $attachmentsCount = $attachments->count();

        $data = [
            'title' => $product->name,
            'product' => $product,
            'related' => $related,
            'packages' => $packages,
            'attachments' => $attachments,
            'attachmentsCount' => $attachmentsCount,
            'role' => 0
        ];

        return view('guest.product_detail', $data);
    }

    public function product_list()
    {

        $category = Category::all();

        $data = [
            'title' => 'Games',
            'role' => 0,
            'categories' => $category
        ];

        return view('guest.product_list', $data);
    }

}
