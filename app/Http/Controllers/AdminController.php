<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductPackage;
use App\Models\Attachment;
use App\Models\User;
use App\Models\UserData;
use App\Models\Role;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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


        $queryAttachment = DB::table('attachments')
            ->select(DB::raw(value: 'MIN(attachments.name) as product_pic'), 'product_id')
            ->groupBy('attachments.product_id');
        $product = DB::table('products')
            ->select('products.*', 'categories.name as category_name', 'attachments.*')
            ->leftJoin('categories', 'categories.id', '=', 'products.category_id')
            ->leftJoinSub($queryAttachment, 'attachments', function (JoinClause $join) {
                $join->on('products.id', '=', 'attachments.product_id');
            })
            ->orderBy('products.created_at', direction: 'ASC')
            ->groupBy('products.id')
            ->get();

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

        return redirect('admin_product_list')->with('success', 'Data produk berhasil ditambahkan.');

    }

    public function product_delete($id)
    {

        //get product by ID
        $product = Product::findOrFail($id);

        ProductPackage::where('product_id', '=', $id)->delete();
        $attachments = Attachment::where('product_id', '=', $id);
        $attachmentData = $attachments->get();
        foreach ($attachmentData as $att) {
            //delete image
            $path = public_path() . "/uploads/product/$att->name";
            File::delete($path);

        }
        $attachments->delete();
        //delete product
        $product->delete();

        //redirect to index
        return redirect('admin_product_list')->with('success', 'Data produk berhasil dihapus.');

    }

    public function product_edit($id)
    {
        $product = Product::findOrFail($id);

        $packages = ProductPackage::where('product_id', '=', $id)->get();
        $attachments = Attachment::where('product_id', '=', $id)->get();
        $category = Category::all();

        $data = [
            'title' => 'Edit Product',
            'role' => 1,
            'packages' => $packages,
            'product' => $product,
            'category' => $category,
            'attachments' => $attachments
        ];

        return view('admin.product.product_edit', $data);

    }

    public function product_update(Request $request)
    {

        $productId = $request->productId;
        $namaProduk = $request->namaProduk;
        $namaGame = $request->namaGame;
        $deskProduk = $request->deskProduk;
        $unit = $request->satuanProduk;

        $product = Product::find($productId);
        $product->name = $namaProduk;
        $product->game = $namaGame;
        $product->description = $deskProduk;
        $product->unit = $unit;
        $product->save();

        $files = $request->file('imgDetailProduk');
        $fileNumber = 0;


        // Kondisi ketika update file baru
        if (!empty($files)) {
            // Jika ada file lama ada yang diubah atau dihapus, maka file lama dihapus
            $attachments = Attachment::where('product_id', '=', $productId);
            $attachmentData = $attachments->get();
            foreach ($attachmentData as $att) {
                $path = public_path() . "/uploads/product/$att->name";
                File::delete($path);
                $att->delete();
            }

            foreach ($files as $file) {

                $imageName = $namaProduk . $fileNumber . '_' . time() . '.' . $file->getClientOriginalExtension();
                $image_resize = Image::read($file->getRealPath());
                $image_resize->save(public_path('uploads/product/' . $imageName));

                $data = [
                    'name' => $imageName,
                    'product_id' => $productId
                ];

                Attachment::create($data);
                $fileNumber++;
            }
        }


        $packages = $request->jumlahPaket;
        $nominal = $request->nominalPaket;

        $i = 0;
        ProductPackage::where('product_id', '=', $productId)->delete();

        foreach ($packages as $p) {

            $dataPackages = [
                'amount' => $p,
                'price' => $nominal[$i],
                'product_id' => $productId
            ];

            ProductPackage::create($dataPackages);
            $i++;
        }

        return redirect('admin_product_list')->with('success', "Data produk $namaProduk berhasil diubah.");
    }

    public function user_list()
    {
        $auth = Auth::user();

        $users = DB::table('users')
            ->select('users.*', 'roles.name as role_name')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->where('users.id', '!=', $auth->id)
            ->get();

        $data = [
            'title' => 'User List',
            'role' => 1,
            'users' => $users,
        ];
        return view('admin.user.user_list', $data);
    }
    public function user_edit($id)
    {
        $roles = Role::all();
        $user = DB::table('users')
            ->select('users.*', 'user_data.handphone as handphone', 'user_data.alamat as alamat')
            ->join('user_data', 'users.id', '=', 'user_data.user_id')
            ->where('users.id', '=', $id)
            ->first();


        $data = [
            'title' => 'User Edit',
            'role' => 1,
            'user' => $user,
            'roles' => $roles
        ];
        return view('admin.user.user_edit', $data);
    }

    public function user_update(Request $request)
    {

        $userId = (int) $request->userId;
        $email = $request->email;

        $existingUser = User::where('email', $email)->first();
        if ($existingUser) {
            // Email is already registered
            if ($existingUser->id != $userId)
                return back()->withInput()->withErrors(['email' => 'This email address is already registered.']);
        }

        $name = $request->name;
        $alamat = $request->alamat;
        $handphone = $request->handphone;
        $role = $request->role;

        $user = User::find($userId);
        $userData = UserData::find($userId);

        $user->name = $name;
        $user->email = $email;
        $user->role_id = $role;

        $userData->handphone = $handphone;
        $userData->alamat = $alamat;

        $user->save();
        $userData->save();

        return redirect('admin_user_list')->with('success', 'Data user berhasil diubah.');


    }

    public function user_delete($id)
    {
        $userData = UserData::where('user_id', '=',$id)->delete();
        $user = User::where('id', '=',$id)->delete();
        return redirect('admin_list')->with('success', 'Data produk berhasil dihapus.');


    }



}
