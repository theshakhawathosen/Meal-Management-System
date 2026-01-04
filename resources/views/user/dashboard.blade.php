@extends('layout.user-layout')
@section('content')
    <section class="section">
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="icon-card mb-30">
                        <div class="icon purple">
                            <i class="lni lni-money-protection"></i>
                        </div>
                        <div class="content">
                            <h6 class="mb-10">My Balance</h6>
                            <h3 class="text-bold mb-10">{{ floor((Auth::user()->deposite->sum('amount') - (Auth::user()->cost->sum('amount') + (Auth::user()->meal->sum('amount') * $mealrate))) * 100 ) / 100 }} TK</h3>
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
                            <h6 class="mb-10">My Deposite</h6>
                            <h3 class="text-bold mb-10">{{ floor(Auth::user()->deposite->sum('amount') * 100) / 100 }} TK</h3>
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
                            <h6 class="mb-10">My Cost</h6>
                            <h3 class="text-bold mb-10">{{ floor(Auth::user()->cost->sum('amount') * 100) / 100 }} TK</h3>
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
                            <h6 class="mb-10">My Meal</h6>
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
                            <h3 class="text-bold mb-10">{{ floor(Auth::user()->meal->sum('amount') * 100) / 100 }} </h3>
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




            <!-- End Row -->
        </div>
        <!-- end container -->
    </section>
@endsection
@push('user_css')
    <style>
        .cardwrapper .card:hover {
            background: #00eb89;
            cursor: pointer;
        }
    </style>
@endpush
@push('user_js')
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
                url: "{{ route('user.showreport') }}",
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
