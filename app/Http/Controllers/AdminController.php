<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductPackage;
use App\Models\Attachment;
use Intervention\Image\Laravel\Facades\Image;


class AdminController extends Controller
{
    //

    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'role' => 1
        ];

        return view('admin/dashboard', $data);
    }
    public function product_list()
    {

        $product = Product::all();
        $data = [
            'title' => 'Product List',
            'product' => $product,
            'role' => 1
        ];

        return view('admin.product.product_list', $data);
    }

    public function product_add()
    {

        $category = Category::all();
        $data = [
            'title' => 'Product Add',
            'role' => 1,
            'category' => $category
        ];

        return view('admin.product.product_add', $data);
    }

    public function product_insert(Request $request)
    {
        $product = [
            'name' => $request->namaProduk,
            'game' => $request->namaGame,
            'description' => $request->deskProduk,
            'category_id' => $request->kategoriProduk,
            'unit' => $request->satuanProduk
        ];

        $productId = Product::create($product)->id;
        ;

        $packages = $request->jumlahPaket;
        $nominal = $request->nominalPaket;
        
        $i = 0;
        foreach ($packages as $p) {

            $dataPackages = [
                'amount' => $p,
                'price' => $nominal[$i],
                'product_id' => $productId
            ];

            ProductPackage::create($dataPackages);
            $i++;
        }

        $files = $request->file('imgDetailProduk');
        $fileNumber = 0;
        foreach ($files as $file) {

            $imageName = $request->namaProduk . $fileNumber . '_' . time() . '.' . $file->getClientOriginalExtension();
            $image_resize = Image::read($file->getRealPath());
            $image_resize->save(public_path('uploads/product/' . $imageName));
        
            $data = [
                'name' => $imageName,
                'product_id' => $productId
            ];

            Attachment::create($data);
            $fileNumber++;
        }
        
        echo "sukses";

    }


}
