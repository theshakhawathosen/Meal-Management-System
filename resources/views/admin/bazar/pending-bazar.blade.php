@extends('layout.admin-layout')
@section('title', 'Pending Bazar')
@section('content')
    <section class="section">
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="card-style settings-card-1 mb-30">
                        <div class="title mb-30 d-flex justify-content-between align-items-center">
                            <h4>Pending Bazar List</h4>
                            <div>
                                <a href="{{ route('admin.bazar') }}" class="btn py-2 p-3 btn-sm btn-primary">Back</a>
                            </div>
                        </div>
                        <div class="table-wrapper table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            <h6>Date</h6>
                                        </th>
                                        <th class="lead-email">
                                            <h6>Details</h6>
                                        </th>
                                        <th>
                                            <h6>Cost</h6>
                                        </th>
                                        <th>
                                            <h6>Shopper</h6>
                                        </th>
                                        <th>
                                            <h6>Action</h6>
                                        </th>
                                    </tr>
                                    <!-- end table row-->
                                </thead>
                                <tbody>
                                    @foreach ($bazars as $bazar)
                                        <tr id="trrow{{ $bazar->id }}">
                                            <td>
                                                <p>{{ $bazar->date }}</p>
                                            </td>
                                            <td class="min-width">
                                                <p>{!! $bazar->details !!}</p>
                                            </td>
                                            <td class="min-width">
                                                <p>{{ $bazar->amount }}</p>
                                            </td>
                                            <td class="min-width">
                                                <style>
                                                    .shopper li {
                                                        display: inline;
                                                    }

                                                    .shopper li img {
                                                        width: 30px;
                                                        height: 30px;
                                                        border-radius: 50%;
                                                    }
                                                </style>
                                                <ul class="shopper">
                                                    @foreach (json_decode($bazar->shopper, true) as $shopper)
                                                        @php
                                                            $userphoto = \App\Models\User::find($shopper)->photo;
                                                        @endphp
                                                        <li><img src="{{ $userphoto }}" alt="{{ $shopper }}"></li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td>
                                                <div class="action">
                                                    <button class="text-danger" onclick="deletebazar({{ $bazar->id }})">
                                                        <i class="lni lni-trash-can"></i>
                                                    </button>
                                                    <button class="text-success" onclick="acceptBazar({{ $bazar->id }})">
                                                        <i class="lni lni-checkmark"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <!-- end table -->
                        </div>
                        <div class="row">
                            {{ $bazars->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
@endsection
@push('admin_js')
    <script>
        function deletebazar(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send AJAX request to delete the deposit
                    $.ajax({
                        url: "{{ route('admin.deletebazar') }}",
                        type: 'post',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: id,
                        },
                        success: function(response) {
                            if (response.success == true) {
                                Swal.fire(
                                    'Deleted!',
                                    response.msg,
                                    'success'
                                );
                                $("#trrow" + id).hide(500);
                            } else {
                                Swal.fire(
                                    'Error!',
                                    'There was a problem ',
                                    'error'
                                );
                            }
                        },
                        error: function() {
                            Swal.fire(
                                'Error!',
                                'There was a problem deleting ',
                                'error'
                            );
                        }
                    });
                }
            });
        }
        function acceptBazar(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, Accept it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send AJAX request to delete the deposit
                    $.ajax({
                        url: "{{ route('admin.acceptbazar') }}",
                        type: 'post',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: id,
                        },
                        success: function(response) {
                            if (response.success == true) {
                                Swal.fire(
                                    'Accepted!',
                                    response.msg,
                                    'success'
                                );
                                $("#trrow" + id).hide(500);
                            } else {
                                Swal.fire(
                                    'Error!',
                                    'There was a problem ',
                                    'error'
                                );
                            }
                        },
                        error: function() {
                            Swal.fire(
                                'Error!',
                                'There was a problem deleting ',
                                'error'
                            );
                        }
                    });
                }
            });
        }
    </script>
@endpush
