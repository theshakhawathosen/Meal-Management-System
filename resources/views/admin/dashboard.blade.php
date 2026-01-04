@extends('layout.admin-layout')
@section('content')
    <section class="section">
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="icon-card mb-30">
                        <div class="icon purple">
                            <i class="lni lni-cart-full"></i>
                        </div>
                        <div class="content">
                            <h6 class="mb-10">Current Balance</h6>
                            <h3 class="text-bold mb-10">{{ floor(($totalDeposite - ($totalCost + $totalBazar)) * 100) / 100; }} TK</h3>
                        </div>
                    </div>
                    <!-- End Icon Cart -->
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="icon-card mb-30">
                        <div class="icon purple">
                            <i class="lni lni-cart-full"></i>
                        </div>
                        <div class="content">
                            <h6 class="mb-10">Total Deposite</h6>
                            <h3 class="text-bold mb-10">{{ $totalDeposite }} TK</h3>
                        </div>
                    </div>
                    <!-- End Icon Cart -->
                </div>
                <!-- End Col -->
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="icon-card mb-30">
                        <div class="icon success">
                            <i class="lni lni-dollar"></i>
                        </div>
                        <div class="content">
                            <h6 class="mb-10">Other Cost</h6>
                            <h3 class="text-bold mb-10">{{ floor($totalCost * 100) / 100; }} TK</h3>
                        </div>
                    </div>
                    <!-- End Icon Cart -->
                </div>
                <!-- End Col -->
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="icon-card mb-30">
                        <div class="icon primary">
                            <i class="lni lni-cart"></i>
                        </div>
                        <div class="content">
                            <h6 class="mb-10">Total Bazar Cost</h6>
                            <h3 class="text-bold mb-10">{{ $totalBazar }} TK</h3>
                        </div>
                    </div>
                    <!-- End Icon Cart -->
                </div>

                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="icon-card mb-30">
                        <div class="icon primary">
                            <i class="lni lni-credit-cards"></i>
                        </div>
                        <div class="content">
                            <h6 class="mb-10">Total Meal</h6>
                            <h3 class="text-bold mb-10">{{ $totalMeal }}</h3>
                        </div>
                    </div>
                    <!-- End Icon Cart -->
                </div>

                <!-- End Col -->
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="icon-card mb-30">
                        <div class="icon orange">
                            <i class="lni lni-user"></i>
                        </div>
                        <div class="content">
                            <h6 class="mb-10">Meal Rate</h6>
                            <h3 class="text-bold mb-10">{{ $mealrate }} TK</h3>
                        </div>
                    </div>
                    <!-- End Icon Cart -->
                </div>



                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="icon-card mb-30">
                        <div class="icon primary">
                            <i class="lni lni-credit-cards"></i>
                        </div>
                        <div class="content">
                            <h6 class="mb-10">Total Users</h6>
                            <h3 class="text-bold mb-10">{{ $totalUser }}</h3>
                        </div>
                    </div>
                    <!-- End Icon Cart -->
                </div>

                <!-- End Col -->
            </div>


                <!-- End Col -->
                <div class="col-lg-12">
                    <div class="card-style mb-30">
                        <div class="title d-flex flex-wrap align-items-center justify-content-between">
                            <div class="left">
                                <h6 class="text-medium mb-30" id="reporttext">Deposite</h6>
                            </div>
                            <div class="right">
                                <div class="select-style-1">
                                    <div class="select-position select-sm">
                                        <select class="light-bg" onchange="showReport($(this).val())">
                                            <option value="Deposite">Deposite</option>
                                            <option value="Meal">Meal</option>
                                            <option value="Balance">Balance</option>
                                            <option value="Bazar">Bazar</option>
                                            <option value="MealCost">Meal Cost</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- end select -->
                            </div>
                        </div>
                        <!-- End Title -->
                        <div class="chart">
                            <canvas id="Chart2" style="width: 100%; height: 400px; margin-left: -45px;"></canvas>
                        </div>
                        <!-- End Chart -->
                    </div>
                </div>
                <!-- End Col -->


            <div class="row">

                @foreach ($users as $user)
                    <div class="col-lg-12 cardwrapper">
                        <div class="card-style mb-30">
                            <div class="title d-flex flex-wrap justify-content-start align-items-center mb-4">
                                <img style="width: 30px;height:30px;margin-right:10px;border-radius:50%"
                                    src="{{ $user->photo }}" alt="sdf">
                                <div>
                                    <h4 class="text-medium">{{ $user->name }}</h4>
                                    <span class="badge bg-primary text-capitalize">{{ $user->role }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <h5 class="card-title text-black">
                                                {{ $userdeposite = $user->deposite->sum('amount') }} TK</h5>
                                            <p class="card-text text-bold">Deposite</p>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-2">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <h5 class="card-title text-black">
                                                {{ $usertotalmeal = $user->meal->sum('amount') }}</h5>
                                            <p class="card-text text-bold">Meals</p>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-2">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <h5 class="card-title text-black">
                                                {{ $userothercost = $user->cost->sum('amount') }} TK</h5>
                                            <p class="card-text text-bold">Other Cost</p>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-2">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <h5 class="card-title text-black">
                                                {{ $usermealcost = $mealrate * $usertotalmeal }} TK</h5>
                                            <p class="card-text text-bold">Meal Cost</p>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-2">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <h5 class="card-title text-black">
                                                {{ $userdeposite - ($userothercost + $usermealcost) }} TK</h5>
                                            <p class="card-text text-bold">Balance</p>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-2">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <h5 class="card-title text-black">{{ $mealrate }} TK</h5>
                                            <p class="card-text text-bold">MealRate</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

            <!-- End Row -->
        </div>
        <!-- end container -->
    </section>
@endsection
@push('admin_css')
    <style>
        .cardwrapper .card:hover {
            background: #00eb89;
            cursor: pointer;
        }
    </style>
@endpush
@push('admin_js')
    <script>
        const ctx2 = document.getElementById("Chart2").getContext("2d");
        const chart2 = new Chart(ctx2, {
            type: "bar",
            data: {
                labels: {!! $labels !!},
                datasets: [{
                    label: "",
                    backgroundColor: "#365CF5",
                    borderRadius: 30,
                    barThickness: 6,
                    maxBarThickness: 8,
                    data: {!! $data !!},
                }, ],
            },
            options: {
                plugins: {
                    tooltip: {
                        callbacks: {
                            titleColor: function(context) {
                                return "#8F92A1";
                            },
                            label: function(context) {
                                let label = context.dataset.label || "";

                                if (label) {
                                    label += ": ";
                                }
                                label += context.parsed.y;
                                return label;
                            },
                        },
                        backgroundColor: "#F3F6F8",
                        titleAlign: "center",
                        bodyAlign: "center",
                        titleFont: {
                            size: 12,
                            weight: "bold",
                            color: "#8F92A1",
                        },
                        bodyFont: {
                            size: 16,
                            weight: "bold",
                            color: "#171717",
                        },
                        displayColors: false,
                        padding: {
                            x: 30,
                            y: 10,
                        },
                    },
                },
                legend: {
                    display: false,
                },
                legend: {
                    display: false,
                },
                layout: {
                    padding: {
                        top: 15,
                        right: 15,
                        bottom: 15,
                        left: 15,
                    },
                },
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        grid: {
                            display: false,
                            drawTicks: false,
                            drawBorder: false,
                        },
                        ticks: {
                            padding: 35,
                            max: 1200,
                            min: 0,
                        },
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false,
                            color: "rgba(143, 146, 161, .1)",
                            drawTicks: false,
                            zeroLineColor: "rgba(143, 146, 161, .1)",
                        },
                        ticks: {
                            padding: 20,
                        },
                    },
                },
                plugins: {
                    legend: {
                        display: false,
                    },
                    title: {
                        display: false,
                    },
                },
            },
        });

        function showReport(report) {
            $("#reporttext").html(report)
            $.ajax({
                type: "post",
                url: "{{ route('admin.showreport') }}",
                data: {
                    report: report,
                    mealrate: {{ $mealrate }},
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {
                    const newLabels = response.labels;
                    const newData = response.data;

                    // Update the chart's data
                    chart2.data.labels = newLabels;
                    chart2.data.datasets[0].data = newData;
                    chart2.update();
                }
            });
        }
    </script>
@endpush
