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
}
