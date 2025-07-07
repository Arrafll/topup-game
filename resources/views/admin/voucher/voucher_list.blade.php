@extends('layout.main')
@section('content')

<main>
    <div class="container-fluid">
        <!-- Breadcrumb start -->
<div class="row m-1">
                <div class="col-12 ">
                    <h4 class="main-title">Product List</h4>
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
                        <li>
                            <a href="#" class="f-s-14 f-w-500">Product List</a>
                        </li>
                        <li class="active">
                            <a href="#" class="f-s-14 f-w-500">Voucher</a>
                        </li>
                    </ul>
                </div>
            </div>        <!-- Breadcrumb end -->

        <!-- Ticket start -->
        <div class="row ticket-app">
            <div class="col-lg-6">
                <div class="card create-ticket-card">
                    <div class="card-body">
                        <div class="col-xl-12">
                            <div class="row align-items-center">
                                <div class="col-sm-7 col-12">
                                    <div class="ticket-create">
                                        <h5 class=" mb-2 ">{{$product->game}}</h5>
                                        <p class="mb-5 mt-3 text-secondary"> Lorem ipsum dolor sit amet consectetur
                                            adipisicing elit. Nobis iure quis obcaecati id accusantium ipsa deleniti quo
                                            tempora exercitationem corporis?</p>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#voucherModal">Create Voucher</button>
                                    </div>
                                </div>
                                <div class="col-sm-5 col-12">
                                    <img src="../assets/images/icons/ticket.png" alt=""
                                        class="img-fluid w-300 d-block m-auto">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">

<div class="d-flex justify-content-between align-items-center mb-2">
    <h5 class="ms-3 mb-2">Game Items</h5>
    <a href="{{ route('admin_product_voucher', ['id' => $product->id, 'package_id' => 'all']) }}"
       class="badge text-bg-primary me-3 {{ ($selectedPackage ?? 'all') == 'all' ? 'active' : '' }}">
        Show All
    </a>
</div>
<ul class="ticket-slider">
    @foreach ($productPackage as $pp)
        <li>
            <div class="card ticket-card bg-primary">
                <div class="card-body">
                    <i class="ph-bold ph-circle circle-bg-img"></i>
                    <div class="h-50 w-50 d-flex-center b-r-15 bg-white mb-3">
                        <i class="ti ti-diamond f-s-25 text-primary"></i>
                    </div>
                    <p class="f-s-16 text-white">{{ $product->unit }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="text-white">{{ $pp->amount }}</h4>
                        <div class="b-r-15 bg-white">
                            <a href="{{ route('admin_product_voucher', ['id' => $product->id, 'package_id' => $pp->id]) }}"
                               class="btn btn-light-primary">
                                Show
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    @endforeach
</ul>


            </div>

            <!-- start create ticket modal  -->
            <!-- Modal -->
            <div class="modal fade" id="voucherModal" tabindex="-1" aria-labelledby="voucherModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <form action="{{ route('admin_product_voucher_add') }}" method="POST">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <h1 class="modal-title fs-5 text-white" id="voucherModalLabel">Add Voucher</h1>
                                <button type="button" class="btn-close m-0" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <input type="hidden" name="game_id" value="{{ $product->id }}">

                                <div class="mb-3">
                                    <label class="form-label">Package</label>
                                    <select name="packages_id" class="form-select select2" required>
                                        <option selected disabled>Pilih Paket</option>
                                        @foreach($productPackage as $package)
                                        <option value="{{ $package->id }}">{{$product->game}} - {{ $package->amount }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Redeem Code</label>
                                    <input type="text" name="redeem_code" class="form-control"
                                        placeholder="Masukkan kode voucher" required>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan Voucher</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- end create ticket modal  -->
            <!-- end create ticket modal  -->
            <!-- Edit Modal -->
            <div class="modal fade" id="editVoucherModal" tabindex="-1" aria-labelledby="editVoucherModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" g">
                    <form id="editVoucherForm" method="POST" action="{{ route('admin_product_voucher_update') }}">
                        @csrf
                        <input type="hidden" name="id" id="edit_voucher_id">
                        <div class="modal-content">
                            <div class="modal-header bg-warning">
                                <h5 class="modal-title" id="editVoucherModalLabel">Edit Redeem Code</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="edit_redeem_code" class="form-label">Redeem Code</label>
                                    <input type="text" class="form-control" id="edit_redeem_code" name="redeem_code"
                                        required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- end create ticket modal  -->

            <!-- TICKET DETAIL tabel 5 -->
            <div class="col-12">
                <div class="card">
                    <div class="card-body px-0">
                        <div class="table-responsive app-scroll app-datatable-default">
                            <table id="ticketdatatable" class="w-100 display ticket-app-table">
                                <thead>
                                    <tr>
                                        <th>Game Items</th>
                                        <th>Value</th>
                                        <th>Redeem Code</th>
                                        <th>Status</th>
                                        <th>Used Date</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="ticket_key_body">
                                    @foreach($voucher as $vc)
                                    <tr>
                                        <td>{{ $vc->game->name ?? '-' }}</td>
                                        <td>{{ $vc->gamePackage->amount ?? '-' }}</td>
                                        <td>{{ $vc->redeem_code }}</td>
                                        <td>
                                            @if($vc->is_used)
                                            <span class="badge text-outline-danger">Used</span>
                                            @else
                                            <span class="badge text-outline-success">Availble</span>
                                            @endif
                                        </td>
                                        <td>{{ $vc->used_date ? \Carbon\Carbon::parse($vc->used_date)->format('d-m-Y') : '-' }}
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($vc->created_at)->format('d-m-Y') }}</td>
                                        <td>
                                            <div class="btn-group dropdown-icon-none">
                                                <button class="btn border-0 icon-btn b-r-4 dropdown-toggle active"
                                                    type="button" data-bs-toggle="dropdown" data-bs-auto-close="true"
                                                    aria-expanded="false">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item edit-btn" href="#"
                                                            data-id="{{ $vc->id }}" data-code="{{ $vc->redeem_code }}"
                                                            data-bs-toggle="modal" data-bs-target="#editVoucherModal">
                                                            <i class="ti ti-edit text-success me-2"></i> Edit
                                                        </a>

                                                    </li>
                                                    <li>
                                                        <form action="{{ route('admin_product_voucher_delete')}}"
                                                            method="POST"
                                                            onsubmit="return confirm('Yakin ingin menghapus voucher ini?')">
                                                            @csrf
                                                            <!-- Hapus: @method('DELETE') -->
                                                            <input type="hidden" name="id" value="{{ $vc->id }}">
                                                            <button class="dropdown-item delete-btn" type="submit">
                                                                <i class="ti ti-trash text-danger me-2"></i> Delete
                                                            </button>
                                                        </form>

                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ticket table end -->
        </div>
        <!-- Ticket end -->
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.edit-btn');

    editButtons.forEach(btn => {
        btn.addEventListener('click', function () {
            document.getElementById('edit_voucher_id').value = this.dataset.id;
            document.getElementById('edit_redeem_code').value = this.dataset.code;
        });
    });
});
</script>



@endsection
