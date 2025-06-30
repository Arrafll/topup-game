@extends('layout.main')
@section('content')
    <main>
        <div class="container-fluid">
            <div class="row">



                <div class="col-lg-12 col-xxl-12">
                    <div class="row">

                        <div class="col-sm-3">
                            <div class="card eshop-cards">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="bg-secondary h-40 w-40 d-flex-center b-r-15 f-s-18">
                                            <i class="ph-bold ph-shopping-cart"></i>
                                        </span>
                                        <div class="dropdown">
                                            <a href="#" class="text-secondary year-label" role="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                            </a>

                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center position-relative">
                                        <div class="flex-shrink-0 align-self-end">
                                            <p class="f-s-16 mb-0">Order</p>
                                            <h5 id="orderTotal">0</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card eshop-cards">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="bg-warning h-40 w-40 d-flex-center b-r-15 f-s-18">
                                            <i class="ph-fill  ph-coins"></i>
                                        </span>
                                        <div class="dropdown">
                                            <a href="#" class="text-warning year-label" role="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="flex-shrink-0 align-self-end">
                                            <p class="f-s-16 mb-0">Pendapatan</p>
                                            <h5 id="salesTotal">Rp. 0</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card eshop-cards">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="bg-danger h-40 w-40 d-flex-center b-r-15 f-s-18">
                                            <i class="ph-bold  ph-user"></i>
                                        </span>
                                        <div class="dropdown">
                                            <a href="#" class="text-danger year-label" role="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center position-relative">
                                        <div class="flex-shrink-0 align-self-end">
                                            <p class="f-s-16 mb-0">User</p>
                                            <h5 id="userTotal">105</h5>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card eshop-cards">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="bg-success h-40 w-40 d-flex-center b-r-15 f-s-18">
                                            <i class="ph-fill ph-archive"></i>
                                        </span>
                                        <div class="dropdown">
                                            <a href="#" class="text-success year-label" role="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="flex-shrink-0 align-self-end">
                                            <p class="f-s-16 mb-0">Produk</p>
                                            <h5 id="productTotal">0</h5>
                                        </div>
                                        <div class="sales-chart">
                                            <div id="productChart"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="col-lg-12 col-xxl-12">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Trend Pesanan</h5>
                                    <p class="text-secondary mb-0 years-label"></p>
                                </div>
                                <div class="card-body">
                                    <div id="line1"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Kategori Populer</h5>
                                    <p class="text-secondary mb-0 years-label"></p>
                                </div>
                                <div class="card-body">
                                    <div id="pie1"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-xxl-4">
                            <div class="card equal-card top-product-card">
                                <div class="card-header card-header-title">
                                    <div class="d-flex">
                                        <div>
                                            <h5>Produk Populer</h5>
                                            <p class="text-secondary mb-0 years-label"></p>
                                        </div>
                                        <div>

                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive app-scroll">
                                        <table class="table align-middle top-products-table mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Produk</th>
                                                    <th scope="col">Kategori</th>
                                                    <th scope="col">Terjual</th>
                                                </tr>
                                            </thead>
                                            <tbody id="widgetPopularProd">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
    <!-- apexcharts-->

    <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>

    <script>

        var formatIdr = function (num) {
            if (num == null) num = 0;
            var str = num.toString().replace("", ""), parts = false, output = [], i = 1, formatted = null;
            if (str.indexOf(".") > 0) {
                parts = str.split(".");
                str = parts[0];
            }
            str = str.split("").reverse();
            for (var j = 0, len = str.length; j < len; j++) {
                if (str[j] != ",") {
                    output.push(str[j]);
                    if (i % 3 == 0 && j < (len - 1)) {
                        output.push(".");
                    }
                    i++;
                }
            }
            formatted = output.reverse().join("");
            return ("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
        };



        let chartSales;
        let chartCategories;

        $(`#dashboard-year-filter`).on(`change`, function () {
            widgetGet($(this).val());
        })
        function widgetGet(year = '') {
            let data = { 'year': year, '_token': '{{ csrf_token() }}' };
            $.ajax({
                type: "POST",
                url: "/admin_widget_get",
                data: data,
                success: function (response) {

                    $('.years-label').text(`Tahun ${year}`);
                    $('.year-label').text(`${year}`);
                    $(`#orderTotal`).text(response.data.totalOrder);
                    $(`#productTotal`).text(response.data.productCount);
                    $(`#userTotal`).text(response.data.userCount);
                    $(`#salesTotal`).text(`Rp. ${formatIdr(response.data.saleSum.sales)}`);
                    generateLineChart(response.data.salesTrends);
                    pieChart(response.data.categories);
                    popularProduct(response.data.productList);
                }
            });
        }



        function generateLineChart(data) {
            let totals = [];
            let months = [];

            if (chartSales) {
                chartSales.destroy();
            }

            data.forEach(function (item) {
                //get the value of name
                let total = item.total
                let month = item.month
                totals.push(total);
                months.push(month);
            });

            console.log(totals);
            var options = {
                series: [{
                    name: "Pesanan",
                    data: [...totals]
                }],
                chart: {
                    height: 350,
                    type: 'line',
                    zoom: {
                        enabled: false
                    }
                },
                stroke: {
                    curve: 'straight'
                },
                title: {
                    text: '',
                    align: 'left'
                },

                colors: ['#7752FE', '#78738C', '#26C450', '#E65051', '#F09E3C'],

                xaxis: {
                    categories: [...months],
                }
            };

            chartSales = new ApexCharts(document.querySelector("#line1"), options);
            chartSales.render();

        }

        function pieChart(data) {
            // **------ pie_charts 1**


            if (chartCategories) {
                chartCategories.destroy();
            }

            let categories = [];
            let order = [];

            if (chartCategories) {
                chartCategories.destroy();
            }

            data.forEach(function (item) {
                categories.push(item.name);
                order.push(parseInt(item.order_counts));
            });


            var optionsPie = {
                series: [...order],
                chart: {
                    height: 340,
                    type: 'pie',
                },
                labels: [...categories],
                legend: {
                    position: 'bottom'
                },
                noData: {
                    text: 'Tidak ada data',
                    align: 'center',
                    verticalAlign: 'middle',
                    style: {
                        color: '#999',
                        fontSize: '16px'
                    }
                },
                responsive: [{
                    breakpoint: 1366,
                    options: {
                        chart: {
                            height: 250
                        },
                        legend: {
                            show: false,
                        },
                    }
                }]
            };

            chartCategories = new ApexCharts(document.querySelector("#pie1"), optionsPie);
            chartCategories.render();
        }

        function popularProduct(data) {
            console.log(data)
            let tr = "";
            $(`#widgetPopularProd`).html('');

            if (data.length > 1) {
                data.forEach(function (item) {
                    //get the value of name
                    tr += `<tr>
                                            <td>
                                                <div class="position-relative">
                                                    <div class="position-absolute">
                                                        <img src="{{ asset('uploads/product/${item.product_pic}') }}"
                                                        alt="" class=" w-35">
                                                    </div>
                                                    <div class="ms-5">
                                                        <h6 class="mb-0">${item.name }</h6>
                                                        <p class="mb-0">${item.packages} Paket</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>${item.category_name}</td>
                                            <td>${item.orders_count || 0}</td>
                                        </tr>`

                });
            }

            if (data.length == 0) {
                tr = `<tr>
                                <td colspan="3" class="text-center">
                                    Tidak ada data
                                </td>
                            </tr>`
            }

            $(`#widgetPopularProd`).append(tr);

        }

        widgetGet(`{{ date('Y') }}`);


    </script>
@endsection