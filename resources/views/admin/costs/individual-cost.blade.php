@extends('layout.admin-layout')
@section('title', 'Individual Cost')
@section('content')
    <section class="section">
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="card-style settings-card-1 mb-30">
                        <div class="title mb-30 d-flex justify-content-between align-items-center">
                            <h4>Individual Costs</h4>
                            <div>
                                <a href="{{ route('admin.addindividualcost') }}" class="btn py-2 p-3 btn-sm btn-primary"><i
                                        class="lni lni-plus"></i></a>
                                {{-- <a href="{{ route('admin.pendingcost') }}" class="btn py-2 p-3 btn-sm btn-danger "><i class="lni lni-hourglass"></i></a> --}}
                            </div>
                        </div>
                        <div class="table-wrapper table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="lead-info">
                                            <h6>Member</h6>
                                        </th>
                                        <th>
                                            <h6>Type</h6>
                                        </th>
                                        <th>
                                            <h6>Cost</h6>
                                        </th>
                                        <th class="lead-email">
                                            <h6>Details</h6>
                                        </th>
                                        <th class="">
                                            <h6>Shopper</h6>
                                        </th>
                                        <th class="lead-phone">
                                            <h6>Date</h6>
                                        </th>
                                        <th>
                                            <h6>Action</h6>
                                        </th>
                                    </tr>
                                    <!-- end table row-->
                                </thead>
                                <tbody>
                                    @foreach ($costs as $cost)
                                        <tr id="trrow{{ $cost->id }}">
                                            <td class="min-width">
                                                <div class="lead">
                                                    <div class="lead-image">
                                                        <img src="{{ $cost->user->photo }}" alt="{{ $cost->user->name }}">
                                                    </div>
                                                    <div class="lead-text">
                                                        <p>{{ $cost->user->name }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="min-width">
                                                <p><a href="#0" class="text-capitalize"><span
                                                            class="badge bg-primary">{{ $cost->type }}</span></a></p>
                                            </td>
                                            <td class="min-width">
                                                <p>{{ $cost->amount }}</p>
                                            </td>
                                            <td class="min-width">
                                                <p>{!! $cost->details !!}</p>
                                            </td>
                                            <td class="min-width">
                                                <style>
                                                     .shopper li{
                                                        display: inline;
                                                     }
                                                    .shopper li img{
                                                        width: 30px;
                                                        height: 30px;
                                                        border-radius: 50%;
                                                    }
                                                </style>
                                                <ul class="shopper">
                                                    @foreach (json_decode($cost->shopper, true) as $shopper)
                                                        @php
                                                            $userphoto = \App\Models\User::find($shopper)->photo;
                                                        @endphp
                                                        <li><img src="{{ $userphoto }}" alt="{{ $shopper }}"></li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td>
                                                <p>{{ $cost->date }}</p>
                                            </td>
                                            <td>
                                                <div class="action">
                                                    <button class="text-danger" onclick="deletecost({{ $cost->id }})">
                                                        <i class="lni lni-trash-can"></i>
                                                    </button>
                                                    <a href="{{ route('admin.editcost',$cost->id) }}"><i class="lni lni-pencil-alt"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <!-- end table -->
                        </div>
                        <div class="row">
                            {{ $costs->links('pagination::bootstrap-5') }}
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
        function deletecost(id) {
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
                        url: "{{ route('admin.deletecost') }}",
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
    </script>
@endpush
