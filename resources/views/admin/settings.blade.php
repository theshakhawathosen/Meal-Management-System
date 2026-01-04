@extends('layout.admin-layout')
@section('title', 'Settings')
@section('content')
    <section class="section">
        <div class="container-fluid">
            <!-- ========== title-wrapper start ========== -->
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="title">
                            <h2>Settings</h2>
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-md-6">
                        <div class="breadcrumb-wrapper">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Settings
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- ========== title-wrapper end ========== -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <d class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h4 class="card-title">Reset Everything?</h4>
                                    <p class="card-text">Please make sure to reset.If you click reset button you can't be
                                        able to retrive. Deposite,Cost,Bazar,Meal will be deleted! So before delete make a
                                        backup.</p>
                                </div>
                                <div class="mx-5"></div>
                                <button class="btn btn-danger ml-5" id="resetbutton">Reset</button>
                            </d>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
@endsection
@push('admin_js')
    <script>
        $("#resetbutton").click(function() {

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.everything') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            status: true,
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    title: "Everything Deleted!",
                                    text: "You can't to retrive privious data",
                                    icon: "success"
                                });
                            }else{
                                Swal.fire({
                                    title: "Failed!",
                                    text: "Something Went Wrong!",
                                    icon: "error"
                                });
                            }
                        }
                    });


                }
            });
        });
    </script>
@endpush
