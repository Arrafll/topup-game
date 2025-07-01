<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
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
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function __construct()
    {
        if(!session('guest'))
        {
            $this->cartList = $this->get_carts();
        }
        else
        {
            $this->cartList = new Cart();
        }
        setlocale(LC_TIME, 'id_ID');
        \Carbon\Carbon::setLocale('id');
    }


    public function home()
    {
        $data = [
            'title' => 'Home',
            'role' => 2,
            'cartList' => $this->cartList
        ];

        return view('customer.mainPage.home', $data);
    }

    public function get_carts()
    {
        $queryAttachment = DB::table('attachments')
            ->select(DB::raw(value: 'MIN(attachments.name) as product_pic'), 'product_id')
            ->groupBy('attachments.product_id');
        $carts = DB::table('carts')
            ->select('products.*', 'carts.id as cart_id', 'attachments.product_pic', 'product_packages.price as product_price', 'product_packages.amount as package_amount', 'carts.game_id', 'product_packages.id as package_id')
            ->leftJoin('products', 'products.id', '=', 'carts.product_id')
            ->leftJoin('product_packages', 'product_packages.id', '=', 'carts.package_id')
            ->leftJoinSub($queryAttachment, 'attachments', function (JoinClause $join) {
                $join->on('products.id', '=', 'attachments.product_id');
            })
            ->where('carts.user_id', Auth::user()->id)
            ->get();

        return $carts;

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
            $products = $products->where('products.name', '=', $search)->orWhere('products.game', '=', $search);
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

    public function product_list()
    {

        $category = Category::all();

        $data = [
            'title' => 'Games',
            'role' => 2,
            'cartList' => $this->cartList,
            'categories' => $category
        ];

        return view('customer.product.list', $data);
    }
    public function invoiceList()
    {
        $data = [
            'title' => 'Home',
            'role' => 2,
            'cartList' => $this->cartList
        ];

        return view('customer.invoice.list', $data);
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


        $packages = ProductPackage::where('product_id', '=', $id)->get();
        $attachments = Attachment::where('product_id', '=', $id)->get();
        $attachmentsCount = $attachments->count();

        $data = [
            'title' => $product->name,
            'product' => $product,
            'related' => $related,
            'packages' => $packages,
            'attachments' => $attachments,
            'attachmentsCount' => $attachmentsCount,
            'cartList' => $this->cartList,
            'role' => 2
        ];

        return view('customer.product.detail', $data);
    }

    public function productInvoice($id)
    {
        $data = [
            'title' => 'Home',
            'role' => 2,
            'cartList' => $this->cartList
        ];

        return view('customer.invoice.invoice', $data);
    }

    public function cart_add(request $request)
    {
        $productId = $request->productId;
        $packageId = $request->packageId;
        $gameId = $request->gameId;
        $userId = Auth::user()->id;


        $cart = [
            'product_id' => $productId,
            'package_id' => $packageId,
            'game_id' => $gameId,
            'user_id' => $userId
        ];

        $cart = Cart::create($cart);

        $queryAttachment = DB::table('attachments')
            ->select(DB::raw(value: 'MIN(attachments.name) as product_pic'), 'product_id')
            ->groupBy('attachments.product_id');
        $carts = DB::table(table: 'carts')
            ->select('products.*', 'carts.id as cart_id', 'attachments.product_pic', 'product_packages.price as product_price', 'product_packages.amount as package_amount')
            ->leftJoin('products', 'products.id', '=', 'carts.product_id')
            ->leftJoin('product_packages', 'product_packages.id', '=', 'carts.package_id')
            ->leftJoinSub($queryAttachment, 'attachments', function (JoinClause $join) {
                $join->on('products.id', '=', 'attachments.product_id');
            })
            ->where('carts.id', $cart->id)
            ->first();

        return response()->json(['response' => 'success', 'carts' => $carts]);

    }

    public function cart_delete($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();
        return response()->json(['response' => 'success']);

    }

    public function cart_delete_sync($id)
    {

        $cart = Cart::findOrFail($id);
        $cart->delete();

        return redirect()->back()->with('successEdit', 'Data profil berhasil diperbarui.');
    }

    public function order_cart()
    {
        if ($this->cartList->count('id') == 0)
            return redirect()->back();
        $data = [
            'title' => 'Buat Pesanan',
            'role' => 2,
            'carts' => $this->cartList,
            'cartList' => $this->cartList,
        ];

        return view('customer.order.cart', $data);

    }
    public function order_list()
    {
        $orders = Order::where('user_id', '=', Auth::user()->id)->orderBy('created_at', 'DESC')->get();

        $data = [
            'title' => 'Order List',
            'role' => 2,
            'orders' => $orders,
            'cartList' => $this->cartList
        ];

        return view('customer.order.list', $data);
    }

    public function order_add(Request $request)
    {

        $note = $request->descOrder;
        $orderCode = "KTO" . date('ymdhis');
        $userId = Auth::user()->id;

        $dataOrder = ['user_id' => $userId, 'note' => $note, 'status' => 'Waiting Payment', 'code' => $orderCode, 'pay_status' => 'Unpaid'];
        $orderId = Order::create($dataOrder)->id;

        $carts = $this->cartList;
        foreach ($carts as $c) {
            $orderItem = [
                'order_id' => $orderId,
                'product_id' => $c->id,
                'package_id' => $c->package_id,
                'game_id' => $c->game_id,
            ];

            OrderItem::create($orderItem);

        }

        $carts = Cart::where('user_id', '=', $userId)->delete();
        return redirect('/customer_order_detail/' . $orderId);

    }

    public function order_detail($id)
    {

        $order = Order::find($id);
        $queryAttachment = DB::table('attachments')
            ->select(DB::raw(value: 'MIN(attachments.name) as product_pic'), 'product_id')
            ->groupBy('attachments.product_id');
        $orders = DB::table(table: 'orders')
            ->select(
                'products.*',
                'attachments.product_pic',
                'product_packages.price as product_price',
                'product_packages.amount as package_amount',
                'orders.created_at as order_date',
                'order_items.game_id',
                'order_items.voucher_code'
            )
            ->leftJoin('order_items', 'order_items.order_id', '=', 'orders.id')
            ->leftJoin('products', 'products.id', '=', 'order_items.product_id')
            ->leftJoin('product_packages', 'product_packages.id', '=', 'order_items.package_id')
            ->leftJoinSub($queryAttachment, 'attachments', first: function (JoinClause $join) {
                $join->on('products.id', '=', 'attachments.product_id');
            })
            ->where('orders.id', $id)
            ->get();

        $snapToken = $order->snap_token;
        if (empty($order->snap_token) && empty($order->payed_at)) {
            Config::$serverKey = config('midtrans.server_key');
            Config::$isProduction = config('midtrans.is_production');
            Config::$isSanitized = config('midtrans.is_sanitized');
            Config::$is3ds = config('midtrans.is_3ds');

            $params = [
                'transaction_details' => [
                    'order_id' => $order->code,
                    'gross_amount' => $orders->sum('product_price') + 2500,
                ],
                'customer_details' => [
                    'first_name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                ],
            ];

            $snapToken = Snap::getSnapToken($params);
            $order->pay_total = $orders->sum('product_price') + 2500;
            $order->snap_token = $snapToken;
            $order->save();

        }
        $data = [
            'title' => 'Order Detail',
            'role' => 2,
            'orders' => $orders,
            'order' => $order,
            'snapToken' => $snapToken,
            'cartList' => $this->cartList
        ];

        return view('customer.order.detail', $data);
    }

    public function order_cancel($id)
    {
        $order = Order::findOrFail($id);
        $order->status = "Cancelled";
        $order->pay_total = 0;
        $order->finished_at = date('Y-m-d H:i:s');
        $order->save();
        return redirect('/customer_order_detail/' . $id)->with('cancel', 'Pesanan telah dibatalkan');
    }

    public function checkout(request $request)
    {

        $id = $request->orderId;
        $jsonMidtrans = $request->jsonMidtrans;
        $respMidtrans = json_decode($jsonMidtrans, true);

        $order = Order::find($id);
        $order->pay_method = $respMidtrans['payment_type'];
        $order->payed_at = $respMidtrans['transaction_time'];
        $order->status = "Processed";
        $order->processed_at = date('Y-m-d h:i:s');
        $order->pay_status = "Paid";
        $order->save();

        return redirect('/customer_order_detail/' . $id)->with('paid', 'Pesanan akan segera diproses, mohon tunggu');
    }

    public function order_now($id = "", $package = "", $gameId = "")
    {

        $queryAttachment = DB::table('attachments')
            ->select(DB::raw(value: 'MIN(attachments.name) as product_pic'), 'product_id')
            ->groupBy('attachments.product_id');
        $product = DB::table('products')
            ->select('products.*', 'attachments.product_pic', 'product_packages.price as product_price', 'product_packages.amount as package_amount', 'product_packages.id as package_id')
            ->leftJoin('product_packages', 'product_packages.product_id', '=', 'products.id')
            ->leftJoinSub($queryAttachment, 'attachments', function (JoinClause $join) {
                $join->on('products.id', '=', 'attachments.product_id');
            })
            ->where('products.id', $id)
            ->where('product_packages.id', $package)
            ->first();



        $data = [
            'title' => 'Buat Pesanan',
            'role' => 2,
            'product' => $product,
            'game_id' => $gameId,
            'cartList' => $this->cartList
        ];

        return view('customer.order.order_now', $data);

    }


    public function order_add_now(Request $request)
    {
    
        $note = $request->descOrder;
        $packageId = $request->packageId;
        $gameId = $request->gameId;
        $productId = $request->productId;

        $orderCode = "KTO" . date('ymdhis');
        $userId = Auth::user()->id;

        $dataOrder = ['user_id' => $userId, 'note' => $note, 'status' => 'Waiting Payment', 'code' => $orderCode, 'pay_status' => 'Unpaid'];
        $orderId = Order::create($dataOrder)->id;

        $carts = $this->cartList;

        $orderItem = [
            'order_id' => $orderId,
            'product_id' => $productId,
            'package_id' => $packageId,
            'game_id' => $gameId,
        ];

        OrderItem::create($orderItem);


        $carts = Cart::where('user_id', '=', $userId)->delete();
        return redirect('/customer_order_detail/' . $orderId);

    }

    public function customerDetail($id)
    {
        $user = User::with('userData')->findOrFail($id);

        $data = [
            'title' => 'Home',
            'role' => 2,
            'cartList' => $this->cartList,
            'user' => $user
        ];

        return view('customer.profile.profileDetail', $data);
    }

public function customerDetailUpdate(Request $request, $id)
{
    $user = User::findOrFail($id);

    // Validasi manual, tanpa try-catch
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'handphone' => 'nullable|string|max:255',
        'alamat' => 'nullable|string',
        'bio' => 'nullable|string',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    // Update ke tabel users
    $user->name = $request->input('name');
    $user->save();

    // Update atau insert ke user_data
    $userData = $user->userData ?? new \App\Models\UserData();
    $userData->user_id = $user->id;
    $userData->handphone = $request->input('handphone');
    $userData->alamat = $request->input('alamat');
    $userData->bio = $request->input('bio');
    $userData->save();

    session()->flash('success', 'Profil berhasil diperbarui');
    return response()->json(['reload' => true]);

}



public function customerSecurityUpdate(Request $request, $id)
{
    $user = User::findOrFail($id);

    if ($user->media_id) {
        return response()->json([
            'errors' => ['email' => ['Akun Google tidak dapat mengubah email atau password.']]
        ], 422);
    }

    $rules = [];

    // Validasi email jika diisi
    if ($request->filled('email')) {
        $rules['email'] = 'required|email|unique:users,email,' . $user->id;
    }

    // Jika user ingin ganti password (input new_password terisi)
    if ($request->filled('new_password') || $request->filled('current_password') || $request->filled('new_password_confirmation')) {
        $rules['current_password'] = 'required';
        $rules['new_password'] = 'required|min:8|confirmed';
        $rules['new_password_confirmation'] = 'required';
    }

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    // Validasi isi password lama
    if ($request->filled('new_password')) {
        if (!Hash::check($request->input('current_password'), $user->password)) {
            return response()->json([
                'errors' => ['current_password' => ['Password lama salah.']]
            ], 422);
        }

        $user->password = Hash::make($request->input('new_password'));
    }

    // Simpan email jika diubah
    if ($request->filled('email')) {
        $user->email = $request->input('email');
    }

    $user->save();

    session()->flash('success', 'Keamanan akun berhasil diperbarui');
    return response()->json(['reload' => true]);
}






}
