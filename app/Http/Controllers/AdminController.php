<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //

    public function index(){
        $data = [
            'title' => 'Home',
            'role' => 1
        ];

        return view('admin/index', $data);
    }
}
