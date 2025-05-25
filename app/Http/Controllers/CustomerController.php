<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //
    public function shop(){
        $data = [
            'title' => 'Home',
            'role' => 2
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
