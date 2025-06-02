@extends('layout.main')
@section('content')

    <!-- toastify css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/toastify/toastify.css') }}">
    <main>
        <div class="container-fluid">
            <!-- Breadcrumb start -->
            <div class="row m-1">
                <div class="col-12 ">
                    <h4 class="main-title">Add Product</h4>
                    <ul class="app-line-breadcrumbs mb-3">
                        <li class="">
                            <a href="#" class="f-s-14 f-w-500">
                                <span>
                                    <i class="ph-duotone  ph-stack f-s-16"></i> Apps
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="f-s-14 f-w-500">E-shop</a>
                        </li>
                        <li class="active">
                            <a href="#" class="f-s-14 f-w-500">Add Product</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Breadcrumb end -->

            <!-- Add Product start -->
            <div class="row">
                <div class="col-lg-7 col-xxl-8">
                    <div class="card">
                        <div class="card-body">
                            <form class="app-form" method="POST" id="form-add-product"
                                action="{{ route('admin_product_insert') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="app-product-section">
                                    <div class="main-title">
                                        <h6>General Information</h6>
                                    </div>
                                    <div>
                                        <div class="row">
                                            <div class="mb-3 col-sm-6">
                                                <label class="form-label">Nama Produk</label>
                                                <input type="text" class="form-control form-product" name="namaProduk"
                                                    placeholder="Isi nama produk...">
                                            </div>
                                            <div class="mb-3 col-sm-6">
                                                <label class="form-label">Nama Game</label>
                                                <input type="text" class="form-control form-product" name="namaGame"
                                                    placeholder="Isi nama game...">
                                            </div>
                                            <div class="mb-3 col-sm-12">
                                                <label class="form-label">Deskripsi Produk</label>
                                                <textarea class="form-control form-product" id="textareaexample3"
                                                    name="deskProduk" placeholder="Tulis deskripsi..." rows="6"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="app-divider-v dashed"></div>

                                    <div class="main-title">
                                        <h6>Rincian Produk</h6>
                                    </div>

                                    <div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Kategori Produk</label>
                                                    <select class="form-select form-product" id="city"
                                                        name="kategoriProduk">
                                                        <option value="" selected>Pilih Kategori</option>
                                                        @foreach ($category as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Nama Satuan Produk</label>
                                                <input type="text" class="form-control form-product"
                                                    placeholder="Contoh : Diamond, Cash, dan lainnya" name="satuanProduk">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="app-divider-v dashed"></div>

                                    <div class="main-title">
                                        <h6>Daftar Paket</h6>
                                    </div>

                                    <div>
                                        <div class="row list-paket">
                                            <div class="col-md-6 paket-row">
                                                <div class="card hover-effect box-shadow-3">
                                                    <div class="card-header code-header">
                                                        <h6>Paket</h6>
                                                        <a href="#" aria-expanded="false" aria-controls="accordionsItem1"
                                                            onclick="deletePaketRow(this)">
                                                            <i class="fa-solid fa-times fa-fw close-card"></i>
                                                        </a>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="app-form">
                                                            <div class="input-group mb-3">
                                                                <input type="number" min="1"
                                                                    class="form-control form-product"
                                                                    placeholder="Masukkan jumlah paket (100 diamond, 100 cash, dll)"
                                                                    id="paket" name="jumlahPaket[]">
                                                            </div>

                                                            <div class="input-group">
                                                                <input type="number" min="1"
                                                                    class="form-control form-product"
                                                                    placeholder="Masukkan nominal harga"
                                                                    name="nominalPaket[]">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mt-4 d-flex justify-content-start gap-2 flex-column flex-sm-row">
                                                <a class="btn btn-success" onclick="addPaketRow()"> <i
                                                        class="ti ti-plus"></i>
                                                    Tambah Paket</a>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div
                                                class="mt-4 d-flex justify-content-end gap-2 flex-column flex-sm-row text-end">
                                                <button type="reset" class="btn btn-light-secondary">Discard</button>
                                                <button type="submit" role="button" class="btn btn-primary">Add
                                                    Product</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-xxl-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="app-product-section">
                                <div class="main-title">
                                    <h6>Gambar Produk</h6>
                                </div>

                                <div>
                                    <div class="input-file mb-2">
                                        <label class="form-label mb-2">Gambar Utama</label>
                                        <input type="file" class="form-control form-product" name="imgDetailProduk[]">
                                    </div>
                                </div>
                                <div class="app-divider-v dashed"></div>
                                <div class="gambar-detail-produk">
                                    <div class="input-file mb-2 row-gambar-detail-produk">
                                        <label class="form-label mb-2">Detail Gambar</label>
                                        <input type="file" class="form-control form-product" name="imgDetailProduk[]">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mt-4 d-flex justify-content-center gap-2 flex-column flex-sm-row">
                                        <a type="reset" class="btn btn-danger" id="rmImgDetailBtn"
                                            onclick="removeGambarRow()"><i class="ti ti-minus"></i> Hapus Gambar</a>
                                        <a class="btn btn-success btn-md" onclick="addGambarRow()"> <i
                                                class="ti ti-plus"></i> Tambah Gambar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    </form>
                </div>
            </div>
            <!-- Add Product end -->
        </div>
    </main>
    <!-- Toatify js-->
    <script src="{{ asset('assets/vendor/notifications/toastify-js.js') }}"></script>
    <script src="{{ asset('assets/vendor/toastify/toastify.js') }}"></script>


    <script>

        function addPaketRow() {
            let eleRow = `  <div class="col-md-6 paket-row"><div class="card hover-effect box-shadow-3"><div class="card-header code-header">
                                             <h6>Paket</h6><a href="#" aria-expanded="false" aria-controls="accordionsItem1" onclick="deletePaketRow(this)">
                                             <i class="fa-solid fa-times fa-fw close-card"></i></a></div><div class="card-body"><div class="app-form">
                                             <div class="input-group mb-3"><input type="number" min="1" class="form-control form-product" placeholder="Masukkan jumlah paket (100 diamond, 100 cash, dll)"
                                             name="jumlahPaket[]"></div><div class="input-group"><input type="number" min="1" class="form-control form-product" placeholder="Masukkan nominal harga" name="nominalPaket[]">
                                             </div></div></div></div></div>`

            $('.list-paket').append(eleRow);
            window.scrollTo(0, document.body.scrollHeight);
        }

        function deletePaketRow(ele) {
            event.preventDefault();
            if ($('.paket-row').length == 1) return false;
            $(ele).parent().parent().parent().remove();
        }

        const formProduct = document.getElementById("form-add-product");
        formProduct.addEventListener("submit", function (e) {
            e.preventDefault();
            let isValid = true;
            $(`.form-product`).removeClass(`is-invalid`);
            $(`.form-product`).each(function () {
                console.log($(this));

                if ($(this).val() == "") {
                    $(this).addClass('is-invalid');
                    isValid = false;
                }
            })
            if (isValid == false) {

                Toastify({
                    text: "Gagal menambahkan! Mohon pastikan seluruh formulir terisi",
                    duration: 2500,
                    position: "right",
                    style: {
                        background: "rgb(var(--danger),1)",
                    }
                }).showToast();

                return false;

            }
            $('#form-add-product').submit();

        });

        function addGambarRow() {
            let ele = ` <div class="input-file mb-2 row-gambar-detail-produk">
                                            <label class="form-label mb-2">Detail Gambar</label>
                                            <input type="file" class="form-control form-product" name="imgDetailProduk">
                                            </div>`

            $(`.gambar-detail-produk`).append(ele);
            $(`#rmImgDetailBtn`).show();
        }

        function removeGambarRow(ele) {
            event.preventDefault();

            $('.row-gambar-detail-produk').last().remove();
            if ($('.row-gambar-detail-produk').length == 0) $(`#rmImgDetailBtn`).hide();
        }



    </script>
@endsection