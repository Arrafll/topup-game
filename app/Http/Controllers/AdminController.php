<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\ProductPackage;
use App\Models\Attachment;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Query\JoinClause;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class AdminController extends Controller
{
    //

    public function __construct()
    {
        setlocale(LC_TIME, 'id_ID');
        \Carbon\Carbon::setLocale('id');
    }
    public function index()
    {
        $years = DB::table(table: 'orders')->selectRaw('YEAR(created_at) as year')->groupByRaw('YEAR(created_at)')->orderByRaw('YEAR(created_at) DESC')->get();
        $data = [
            'title' => 'Dashboard',
            'role' => 1,
            'years' => $years
        ];

        return view('admin/dashboard', $data);
    }

    public function widget_get(Request $request)
    {

        $year = $request->year;
        if (empty($year)) {
            $year = date('Y');
        }

        $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $saleTrends = [];
        $totalOrder = 0;
        $month = 1;
        for ($i = 0; $i < 12; $i++) {
            $order = DB::table(table: 'orders')->selectRaw('COUNT(id) as total, SUM(IFNULL(pay_total,0)) as sales')->whereRaw("MONTH(created_at) = '$month' AND YEAR(created_at) = '$year'")->first();
            $arr = ['month' => $months[$i], 'total' => $order->total];
            array_push($saleTrends, $arr);
            $month++;
            $totalOrder += (int) $order->total;
        }

        $productCount = Product::whereRaw("YEAR(created_at) = $year")->count();
        $userCount = User::whereRaw("YEAR(created_at) = $year")->count();
        $saleSum = DB::table(table: 'orders')->selectRaw('COUNT(id) as total, SUM(IFNULL(pay_total,0)) as sales')->whereRaw("status IN ('Done') AND YEAR(created_at) = '$year'")->first();

        $queryAttachment = DB::table('attachments')
            ->select(DB::raw(value: 'MIN(attachments.name) as product_pic'), 'product_id')
            ->groupBy('attachments.product_id');
        $queryOrderItems = DB::table('order_items')
            ->select(DB::raw(value: 'COUNT(order_items.id) as orders_count'), 'product_id')
            ->whereRaw("YEAR(order_items.created_at) = '$year'")
            ->groupBy('order_items.product_id');
        $product = DB::table('products')
            ->select('products.*', 'attachments.*', 'order_items.*', DB::raw('COUNT(product_packages.id) as packages'), 'categories.name as category_name')
            ->leftJoin('product_packages', 'product_packages.product_id', '=', 'products.id')
            ->leftJoin('categories', 'categories.id', '=', 'products.category_id')
            ->leftJoinSub($queryAttachment, 'attachments', function (JoinClause $join) {
                $join->on('products.id', '=', 'attachments.product_id');
            })
            ->leftJoinSub($queryOrderItems, 'order_items', function (JoinClause $join) {
                $join->on('products.id', '=', 'order_items.product_id');
            })
            ->whereRaw("YEAR(products.created_at) = '$year'")
            ->orderBy('products.created_at', 'ASC')
            ->groupBy('products.id')
            ->limit(5)
            ->get();

        $categories = DB::table(table: 'categories')
            ->select('categories.*', DB::raw('SUM(order_items.orders_count) as order_counts'))
            ->leftJoin('products', 'categories.id', '=', 'products.category_id')
            ->leftJoinSub($queryOrderItems, 'order_items', function (JoinClause $join) {
                $join->on('products.id', '=', 'order_items.product_id');
            })
            ->whereRaw("YEAR(products.created_at) = '$year'")
            ->groupBy('categories.id')
            ->limit(5)
            ->get();

        $data = [
            'salesTrends' => $saleTrends,
            'totalOrder' => $totalOrder,
            'saleSum' => $saleSum,
            'userCount' => $userCount,
            'productCount' => $productCount,
            'productList' => $product,
            'categories' => $categories

        ];
        return response()->json(['response' => 'success', 'data' => $data]);
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


    public function order_list()
    {

        $orders = Order::where('pay_status', '!=', 'unpaid')->get();
        $data = [
            'title' => 'Order List',
            'orders' => $orders,
            'role' => 1
        ];

        return view('admin.order.order_list', $data);
    }

    public function order_detail($id)
    {
        $order = Order::with('user')->where('orders.id', '=', $id)->first();
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
                'orders.updated_at as order_update_date',
                'order_items.id as item_id',
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

        $data = [
            'title' => 'Order Detail',
            'orders' => $orders,
            'order' => $order,
            'role' => 1
        ];

        return view('admin.order.order_detail', $data);
    }


    public function order_finish(Request $request)
    {
        $order_id = $request->orderId;
        $voucherCodes = $request->voucherCodes;
        $orderItems = $request->itemIds;


        $idx = 0;
        foreach ($orderItems as $oi) {
            $orderItem = OrderItem::find($oi);
            $orderItem->voucher_code = $voucherCodes[$idx];
            $orderItem->save();
            $idx++;
        }

        $order = Order::find($order_id);
        $order->status = 'Done';
        $order->save();

        return redirect('/admin_order_detail/' . $order_id)->with('finish', 'Pesanan telah diselesaikan');

    }

    public function order_cancel($id)
    {
        $order = Order::findOrFail($id);
        $order->status = "Cancelled";
        $order->pay_status = "Refunded";
        $order->pay_total = 0;
        $order->finished_at = date('Y-m-d H:i:s');
        $order->save();
        return redirect('/admin_order_detail/' . $id)->with('cancel', 'Payment telah direfund ke customer');
    }

    public function report_list()
    {

        $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $years = DB::table(table: 'orders')->selectRaw('YEAR(finished_at) as year')->groupByRaw('YEAR(finished_at)')->orderByRaw('YEAR(finished_at) DESC')->where('finished_at', '!=', NULL)->get();
        $reports = DB::table(table: 'orders')
            ->selectRaw('YEAR(finished_at) as year, MONTH(finished_at) as month, COUNT(id) as total_order, SUM(IFNULL(pay_total,0)) as gross')
            ->whereIn('status', ['Done', 'Cancelled'])
            ->groupByRaw('YEAR(finished_at), MONTH(finished_at)')
            ->orderByRaw('YEAR(finished_at) DESC, MONTH(finished_at) DESC')
            ->get();

        $data = [
            'title' => 'Order Detail',
            'years' => $years,
            'months' => $months,
            'reports' => $reports,
            'role' => 1
        ];

        return view('admin.report.report_list', $data);
    }

    public function report_export($year = "", $month = "")
    {
        // Ambil data dari database
        $reports = DB::table('orders')
            ->selectRaw('YEAR(finished_at) as year, MONTH(finished_at) as month, COUNT(id) as total_order, SUM(pay_total) as gross,
            SUM(CASE WHEN status = "Cancelled" THEN 1 ELSE 0 END) AS total_cancelled, SUM(CASE WHEN status = "Done" THEN 1 ELSE 0 END) AS total_done
            ')
            ->whereIn('status', ['Done', 'Cancelled']);

        if (!empty($year) && !empty($month)) {
            $reports = $reports->whereRaw("YEAR(finished_at) = '$year' AND MONTH(finished_at) = '$month'");
        }

        $reports = $reports->groupByRaw('YEAR(finished_at), MONTH(finished_at)')
            ->orderByRaw('YEAR(finished_at), MONTH(finished_at)')
            ->get();


        // Buat spreadsheet baru
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header kolom
        // Merge kolom A1 sampai C1
        // Isi data mulai dari baris ke-2
        $styleArray = array(
            'borders' => array(
                'outline' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => array('argb' => '#000000'),
                ),
            ),
        );

        $sheet->mergeCells('A2:F2');
        $sheet->setCellValue('A2', 'Laporan Bulanan KlikTopup');
        $sheet->getStyle('A2')->getAlignment()->setHorizontal('center');
        // Buat border, alignment, bold, dll (opsional)

        $sheet->getColumnDimension('A')->setWidth(10);
        $sheet->getColumnDimension('B')->setWidth(10);
        $sheet->getColumnDimension('C')->setWidth(15);
        $sheet->getColumnDimension('D')->setWidth(15);
        $sheet->getColumnDimension('E')->setWidth(15);
        $sheet->getColumnDimension('F')->setWidth(20);

        $sheet->getStyle('A2:F2')->applyFromArray([
            'font' => ['bold' => true, 'size' => 14],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ]);

        $sheet->getStyle('A2:F2')->applyFromArray($styleArray);

        $sheet->setCellValue('A3', 'Tahun');
        $sheet->setCellValue('B3', 'Bulan');
        $sheet->setCellValue('C3', 'Transaksi Batal');
        $sheet->setCellValue('D3', 'Transaksi Sukses');
        $sheet->setCellValue('E3', 'Total Transaksi');
        $sheet->setCellValue('F3', 'Pendapatan');

        $sheet->getStyle('A3')->applyFromArray($styleArray);
        $sheet->getStyle('B3')->applyFromArray($styleArray);
        $sheet->getStyle('C3')->applyFromArray($styleArray);
        $sheet->getStyle('D3')->applyFromArray($styleArray);
        $sheet->getStyle('E3')->applyFromArray($styleArray);
        $sheet->getStyle('F3')->applyFromArray($styleArray);


        $sumPendapatan = 0;
        $sumTotalOrder = 0;
        $sumGagal = 0;
        $sumBerhasil = 0;

        $row = 4;
        foreach ($reports as $r) {

            $sheet->setCellValue('A' . $row, $r->year);
            $sheet->setCellValue('B' . $row, \Carbon\Carbon::create()->month($r->month)->monthName);
            $sheet->setCellValue('C' . $row, $r->total_cancelled);
            $sheet->setCellValue('D' . $row, $r->total_done);
            $sheet->setCellValue('E' . $row, $r->total_order);
            $sheet->setCellValue('F' . $row, $r->gross);

            $sheet->getStyle('A' . $row)->applyFromArray($styleArray);
            $sheet->getStyle('B' . $row)->applyFromArray($styleArray);
            $sheet->getStyle('C' . $row)->applyFromArray($styleArray);
            $sheet->getStyle('D' . $row)->applyFromArray($styleArray);
            $sheet->getStyle('E' . $row)->applyFromArray($styleArray);
            $sheet->getStyle('F' . $row)->applyFromArray($styleArray);

            $row++;

            $sumTotalOrder += (int) $r->total_order;
            $sumPendapatan += (int) $r->gross;
            $sumGagal += (int) $r->total_cancelled;
            $sumBerhasil += (int) $r->total_done;

        }

        $sheet->mergeCells('A' . $row . ':B' . $row);
        $sheet->setCellValue('A' . $row, 'Total');
        $sheet->getStyle('A' . $row)->getAlignment()->setHorizontal('center');


        $sheet->getStyle('A' . $row . ':B' . $row)->applyFromArray($styleArray);
        $sheet->getStyle('C' . $row)->applyFromArray($styleArray);
        $sheet->getStyle('D' . $row)->applyFromArray($styleArray);
        $sheet->getStyle('E' . $row)->applyFromArray($styleArray);
        $sheet->getStyle('F' . $row)->applyFromArray($styleArray);

        $sheet->setCellValue('C' . $row, $sumGagal);
        $sheet->setCellValue('D' . $row, $sumBerhasil);
        $sheet->setCellValue('E' . $row, $sumTotalOrder);
        $sheet->setCellValue('F' . $row, $sumPendapatan);

        // Export ke Excel
        $filename = 'Laporan_Transaksi - ' . date('Y-m-d H:i:s') . '.xlsx';
        $writer = new Xlsx($spreadsheet);

        // Kirim file ke browser
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=\"$filename\"");
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }
}
