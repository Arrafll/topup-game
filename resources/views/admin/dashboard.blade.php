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
                                            <a href="#" class="text-secondary " role="button" data-bs-toggle="dropdown"
                                                aria-expanded="false">2025
                                            </a>

                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center position-relative">
                                        <div class="flex-shrink-0 align-self-end">
                                            <p class="f-s-16 mb-0">Order</p>
                                            <h5>102 </h5>
                                        </div>
                                        <div class="order-chart">
                                            <div id="orderChart"></div>
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
                                            <a href="#" class="text-warning" role="button" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                2025
                                            </a>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="flex-shrink-0 align-self-end">
                                            <p class="f-s-16 mb-0">Penjualan</p>
                                            <h5>Rp. 23.439.320</h5>
                                        </div>
                                        <div class="sales-chart">
                                            <div id="salesChart"></div>
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
                                            <a href="#" class="text-danger" role="button" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                2025
                                            </a>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center position-relative">
                                        <div class="flex-shrink-0 align-self-end">
                                            <p class="f-s-16 mb-0">User</p>
                                            <h5>105</h5>
                                        </div>
                                        <div class="order-chart">
                                            <div id="userChart"></div>
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
                                            <a href="#" class="text-success" role="button" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                2025
                                            </a>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="flex-shrink-0 align-self-end">
                                            <p class="f-s-16 mb-0">Produk</p>
                                            <h5>35</h5>
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
                                    <h5>Trend Penjualan</h5>
                                    <p class="text-secondary mb-0">Tahun 2025</p>
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
                                    <p class="text-secondary mb-0">Tahun 2025</p>
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
                                            <p class="text-secondary mb-0">Tahun 2025</p>
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
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="position-relative">
                                                            <div class=" position-absolute">
                                                                <img src="https://play-lh.googleusercontent.com/QXCVbZd0d71ho4MIYHHxnY6BJFGXI-fzRS5MXJXU1n4n2T-VdQgB1vrdJpydokA34UA"
                                                                    alt="" class=" w-35">
                                                            </div>
                                                            <div class="ms-5">
                                                                <h6 class="mb-0">Mobile Legends</h6>
                                                                <p class="mb-0">13 Paket</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>Mobile Game</td>
                                                    <td>190</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="position-relative">
                                                            <div class="position-absolute">
                                                                <img src="https://pointgo.id/assets/images/games/1695642076_770d7dfeb9d2b96f2579.webp"
                                                                    alt="" class=" w-35">
                                                            </div>
                                                            <div class="ms-5">
                                                                <h6 class="mb-0">Point Blank</h6>
                                                                <p class="mb-0">10 Paket</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>PC Game</td>
                                                    <td>131</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="position-relative">
                                                            <div class=" position-absolute">
                                                                <img src="https://cdn2.downdetector.com/static/uploads/c/300/0df83/val_7fLptSn.png"
                                                                    alt="" class=" w-35">
                                                            </div>
                                                            <div class="ms-5">
                                                                <h6 class="mb-0">Valorant</h6>
                                                                <p class="mb-0">15 Paket</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>PC Game</td>
                                                    <td>98</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="position-relative">
                                                            <div class=" position-absolute">
                                                                <img src="https://img.utdstc.com/icon/4d1/b37/4d1b37eb5bc4e9e64c5b840330d3c494a6f441b8db889b8bf957436e9793056e:200"
                                                                    alt="" class=" w-35">
                                                            </div>
                                                            <div class="ms-5">
                                                                <h6 class="mb-0">Genshin Impact</h6>
                                                                <p class="mb-0">11 Paket</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>Mobile Game</td>
                                                    <td>73</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="position-relative">
                                                            <div class=" position-absolute">
                                                                <img src="https://images.seeklogo.com/logo-png/28/1/dota-2-logo-png_seeklogo-284923.png"
                                                                    alt="" class=" w-35">
                                                            </div>
                                                            <div class="ms-5">
                                                                <h6 class="mb-0">Dota 2</h6>
                                                                <p class="mb-0">5 Paket</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>PC Game</td>
                                                    <td>43</td>
                                                </tr>
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
        var options = {
            series: [{
                name: "Desktops",
                data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
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
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
            }
        };

        var chart = new ApexCharts(document.querySelector("#line1"), options);
        chart.render();



        // **------ pie_charts 1**
        var optionsPie = {
            series: [44, 55, 13, 43, 22],
            chart: {
                height: 340,
                type: 'pie',
            },
            colors: ['#48BECE', '#8B8476', '#AECC34', '#FF5E40', '#F9D249'],
            labels: ['PC Game', 'Mobile Game', 'Epic Games', 'Playstation', 'XBOX'],
            legend: {
                position: 'bottom'
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

        var chart = new ApexCharts(document.querySelector("#pie1"), optionsPie);
        chart.render();


        // order chart js

        var optionsWg = {
            series: [{
                name: 'Sales',
                data: [20, 50, 12, 58, 37]
            }],
            chart: {
                width: 140,
                height: 120,
                type: 'line',
            },
            forecastDataPoints: {
                count: 2
            },
            stroke: {
                width: 2,
                curve: 'smooth'
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shade: '#26C450',
                    // gradientToColors: [ '#78738C','#26C450'],
                    shadeIntensity: 1,
                    type: 'horizontal',
                    opacityFrom: 1,
                    opacityTo: 1,
                    colorStops: [
                        {
                            offset: 0,
                            color: "rgba(var(--secondary),1)",
                            opacity: 1,
                        },
                        {
                            offset: 100,
                            color: "rgba(var(--secondary),1)",
                            opacity: .1,
                        },
                    ],
                },
            },
            xaxis: {
                show: false,
                labels: {
                    show: false
                },
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                }
            },
            yaxis: {
                show: false,
            },
            grid: {
                show: false,
                xaxis: {
                    lines: {
                        show: false
                    }
                },
                yaxis: {
                    lines: {
                        show: false
                    }
                },
            },
            tooltip: {
                enabled: false,
            },
            responsive: [{
                breakpoint: 1440,
                options: {
                    chart: {
                        width: 100,
                        height: 120
                    },

                }
            }]
        };


        new ApexCharts(document.querySelector("#orderChart"), optionsWg).render();
        optionsWg.fill.gradient.colorStops = [
            {
                offset: 0,
                color: "rgba(var(--warning),1)",
                opacity: 1,
            },
            {
                offset: 100,
                color: "rgba(var(--warning),1)",
                opacity: .1,
            },
        ],
            new ApexCharts(document.querySelector("#salesChart"), optionsWg).render();
        optionsWg.fill.gradient.colorStops = [
            {
                offset: 0,
                color: "rgba(var(--danger),1)",
                opacity: 1,
            },
            {
                offset: 100,
                color: "rgba(var(--danger),1)",
                opacity: .1,
            },
        ],
            new ApexCharts(document.querySelector("#userChart"), optionsWg).render();
        optionsWg.fill.gradient.colorStops = [
            {
                offset: 0,
                color: "rgba(var(--success),1)",
                opacity: 1,
            },
            {
                offset: 100,
                color: "rgba(var(--success),1)",
                opacity: .1,
            },
        ],
            new ApexCharts(document.querySelector("#productChart"), optionsWg).render();


    </script>
@endsection