@extends('layout.main')
@section('content')

    <!-- toastify css-->
    <!-- slick css -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/slick/slick-theme.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/toastify/toastify.css') }}">
    <main>
        <div class="container-fluid">
            <!-- Breadcrumb start -->
            <div class="row m-1">
                <div class="col-12 ">
                    <h4 class="main-title">Edit Product</h4>
                    <ul class="app-line-breadcrumbs mb-3">
                        <li class="">
                            <a href="/" class="f-s-14 f-w-500">
                                <span>
                                    KlikTopUp
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="f-s-14 f-w-500">Data Management</a>
                        </li>
                        <li class="active">
                            <a href="#" class="f-s-14 f-w-500">Product Edit</a>
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
                            <form class="app-form" method="POST" id="form-edit-product"
                                action="{{ route('admin_product_update') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="productId" value="{{ $product->id }}">

                                <div class="app-product-section">
                                    <div class="main-title">
                                        <h6>General Information</h6>
                                    </div>
                                    <div>
                                        <div class="row">
                                            <div class="mb-3 col-sm-6">
                                                <label class="form-label">Nama Produk</label>
                                                <input type="text" class="form-control form-product" name="namaProduk"
                                                    placeholder="Isi nama produk..." value="{{ $product->name }}">
                                            </div>
                                            <div class="mb-3 col-sm-6">
                                                <label class="form-label">Nama Game</label>
                                                <input type="text" class="form-control form-product" name="namaGame"
                                                    placeholder="Isi nama game..." value="{{$product->game }}">
                                            </div>
                                            <div class="mb-3 col-sm-12">
                                                <label class="form-label">Deskripsi Produk</label>
                                                <textarea class="form-control form-product" id="textareaexample3"
                                                    name="deskProduk" placeholder="Tulis deskripsi..."
                                                    rows="6">{{$product->description }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="app-divider-v dashed"></div>

                                    <div class="main-title">
                                        <h6>Rincian Produk</h6>
                                    </div>

                                    <div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Kategori Produk</label>
                                                    <select class="form-select form-product" id="city"
                                                        name="kategoriProduk">
                                                        <option value="" selected>Pilih Kategori</option>

                                                        @foreach ($category as $item)
                                                            <option value="{{ $item->id }}" @if ($item->id == $product->category_id) selected @endif>
                                                                {{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Pengiriman Produk</label>
                                                    <select class="form-select form-product" id="bentukProduk" name="bentukProduk">
                                                        <option value="">Pilih Pengiriman</option>
                                                        <option value="1" @if ($product->is_voucher == 1) selected @endif>Voucher</option>
                                                        <option value="0" @if ($product->is_voucher == 0) selected @endif>Transfer In Game</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label class="form-label">Nama Satuan Produk</label>
                                                <input type="text" class="form-control form-product"
                                                    placeholder="Contoh : Diamond, Cash, dan lainnya" name="satuanProduk"
                                                    value="{{ $product->unit }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="app-divider-v dashed"></div>

                                    <div class="main-title">
                                        <h6>Daftar Paket</h6>
                                    </div>

                                    <div>
                                        <div class="row list-paket">
                                            @if (count($packages) > 0)
                                                @foreach ($packages as $pack)
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
                                                                            id="paket" name="jumlahPaket[]"
                                                                            value="{{ $pack->amount }}">
                                                                    </div>

                                                                    <div class="input-group">
                                                                        <input type="number" min="1"
                                                                            class="form-control form-product"
                                                                            placeholder="Masukkan nominal harga"
                                                                            name="nominalPaket[]" value="{{ $pack->price }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                @endforeach
                                            @else
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
                                            @endif
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
                                                <button type="reset" class="btn btn-light-secondary">Reset</button>
                                                <button type="submit" role="button" class="btn btn-primary">Edit
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
                                @if (count($attachments) < 1)
                                    <div class="responsive app-arrow">
                                        <img src="{{ asset('assets/images/icons/broken-img.jpg') }}" class="img-fluid rounded"
                                            alt="image">
                                    </div>
                                    <h6 class="text-center">Gambar tidak tersedia</h6>
                                @else
                                    <div class="responsive app-arrow">
                                        @foreach ($attachments as $at)
                                            <div class="resopns-item">
                                                <img src="{{ asset('uploads/product/' . $at->name) }}" class="img-fluid rounded"
                                                    alt="image">
                                            </div>
                                        @endforeach
                                    </div>
                                @endif


                                <div class="app-divider-v dashed"></div>
                                <div class="gambar-detail-produk">

                                </div>


                                <div class="col-12">
                                    <div class="mt-3 d-flex justify-content-center gap-2 flex-column flex-sm-row">
                                        <a type="reset" class="btn btn-danger d-none" id="rmImgDetailBtn"
                                            onclick="removeGambarRow()"><i class="ti ti-minus"></i> Hapus Gambar</a>
                                        <a class="btn btn-success btn-md d-none" onclick="addGambarRow()"
                                            id="addImgDetailBtn"> <i class="ti ti-plus"></i> Tambah Gambar </a>
                                        <a class="btn btn-info btn-md" onclick="reuploadGambar()" id="reuploadImgDetailBtn">
                                            <i class="ti ti-repeat"></i> Upload Ulang </a>
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
    <!-- slick-file -->
    <script src="{{ asset('assets/vendor/slick/slick.min.js') }}"></script>

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

        const formProduct = document.getElementById("form-edit-product");
        formProduct.addEventListener("submit", function (e) {
            e.preventDefault();
            let isValid = true;
            let fileType;

            $(`.form-product`).removeClass(`is-invalid`);
            $(`.invalid-feedback`).remove();

            $(`.form-product`).each(function () {
                console.log($(this));

                if ($(this).val() == "") {
                    $(this).addClass('is-invalid');
                    $(this).after(`<div class="invalid-feedback">
                                          Formulir tidak boleh kosong!
                                    </div>`)
                    isValid = false;
                }
            })

            var validImageTypes = ["image/jpg", "image/jpeg", "image/png"];
            $(`.image-form`).each(function () {
                fileType = $(this).prop("files")[0].type;
                if ($.inArray(fileType, validImageTypes) < 0) {
                    $(this).addClass('is-invalid');
                    $(this).after(`<div class="invalid-feedback">
                                          Format file harus jpg, jpeg, atau png!
                                        </div>`)
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
            $('#form-edit-product').serialize();
            $('#form-edit-product').submit();

        });

        function addGambarRow() {
            let ele = ` <div class="input-file mb-2 row-gambar-detail-produk">
                                    <label class="form-label mb-2">Upload Gambar</label>
                                    <input type="file" class="form-control form-product image-form" name="imgDetailProduk[]" form="form-edit-product" accept="image/*">
                                    </div>`

            $(`.gambar-detail-produk`).append(ele);
            $(`#rmImgDetailBtn`).show();
        }

        function removeGambarRow(ele) {
            event.preventDefault();

            $('.row-gambar-detail-produk').last().remove();
            if ($('.row-gambar-detail-produk').length == 0) {
                $('#rmImgDetailBtn').addClass('d-none')
                $('#addImgDetailBtn').addClass('d-none')
                $('#reuploadImgDetailBtn').removeClass('d-none')
            }
        }

        function reuploadGambar() {
            addGambarRow();
            $('#rmImgDetailBtn').removeClass('d-none')
            $('#addImgDetailBtn').removeClass('d-none')
            $('#reuploadImgDetailBtn').addClass('d-none')

        }

        $('.responsive').slick({
            slidesToShow: 2,
            slidesToScroll: 2,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1
                    }
                },
            ]
        });


    </script>
@endsection