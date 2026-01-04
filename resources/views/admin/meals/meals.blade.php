@extends('layout.admin-layout')
@section('title', 'Meals')
@section('content')
    <section class="section">
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="card-style settings-card-1 mb-30">
                        <div class="title mb-30 d-flex justify-content-between align-items-center">
                            <h4>All Meals</h4>
                            <div>
                                <a href="{{ route('admin.addmeal') }}" class="btn py-2 p-3 btn-sm btn-primary"><i class="lni lni-plus"></i></a>
                                <a href="{{ route('admin.pendingmeal') }}" class="btn py-2 p-3 btn-sm btn-danger "><i class="lni lni-hourglass"></i></a>
                            </div>
                        </div>
                        <div class="table-wrapper table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="lead-info">
                                            <h6>Member</h6>
                                        </th>
                                        <th class="lead-email">
                                            <h6>Meals</h6>
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
                                    @foreach ($meals as $meal)
                                        <tr id="trrow{{ $meal->id }}">
                                            <td class="min-width">
                                                <div class="lead">
                                                    <div class="lead-image">
                                                        <img src="{{ $meal->user->photo }}"
                                                            alt="{{ $meal->user->name }}">
                                                    </div>
                                                    <div class="lead-text">
                                                        <p>{{ $meal->user->name }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="min-width">
                                                <p><a href="#0">{{ $meal->amount }}</a></p>
                                            </td>
                                            <td class="min-width">
                                                <p>{{ $meal->date }}</p>
                                            </td>
                                            <td>
                                                <div class="action">
                                                    <button class="text-danger"
                                                        onclick="deleteMeal({{ $meal->id }})">
                                                        <i class="lni lni-trash-can"></i>
                                                    </button>
                                                    <a href="{{ route('admin.editmeal',$meal->id) }}"><i class="lni lni-pencil-alt"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <!-- end table -->
                        </div>
                        <div class="row">
                            {{ $meals->links('pagination::bootstrap-5') }}
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
        function deleteMeal(id) {
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
                        url: "{{ route('admin.deletemeal') }}",
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
