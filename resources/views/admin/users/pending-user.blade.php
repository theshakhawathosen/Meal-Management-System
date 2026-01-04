@extends('layout.admin-layout')
@section('title', 'Pending Users')
@section('content')
    <section class="section">
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="card-style settings-card-1 mb-30">
                        <div class="title mb-30 d-flex justify-content-between align-items-center">
                            <h4>Pending Users</h4>
                            <div>
                                <a href="{{ route('admin.users') }}" class="btn py-2 p-3 btn-sm btn-primary">Back</a>
                            </div>
                        </div>
                        <div class="table-wrapper table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="lead-info">
                                            <h6>User</h6>
                                        </th>
                                        <th class="lead-emsail">
                                            <h6>Email</h6>
                                        </th>
                                        <th class="lead-phone">
                                            <h6>Phone</h6>
                                        </th>
                                        <th>
                                            <h6>Role</h6>
                                        </th>
                                        <th class="text-right">
                                            <h6>Action</h6>
                                        </th>
                                    </tr>
                                    <!-- end table row-->
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr id="trrow{{ $user->id }}">
                                            <td class="d-flex align-items-center justify-content-start"><img
                                                    style="height: 35px;width:35px;border-radius:50%;margin-right:10px"
                                                    src="{{ $user->photo }}" alt="{{ $user->photo }}">
                                                <div class="ml-2">{{ $user->name }}</div>
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td><span
                                                    class="badge badge-pill bg-{{ $user->role == 'user' ? 'primary' : 'danger' }} badge-primary text-capitalize">{{ $user->role }}</span>
                                            </td>
                                            <td>
                                                @if (Auth::id() !== $user->id)
                                                    <button class="btn text-danger"
                                                        onclick="deleteUser({{ $user->id }})">
                                                        <i class="lni lni-trash-can"></i>
                                                    </button>
                                                @endif
                                                <button class="btn text-success" onclick="activeUser({{ $user->id }})">
                                                    <i class="lni lni-checkmark"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <!-- end table -->
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
        function deleteUser(id) {
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
                        url: "{{ route('admin.deleteuser') }}",
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
                                    'There was a problem',
                                    'error'
                                );
                            }
                        },
                        error: function() {
                            Swal.fire(
                                'Error!',
                                'There was a problem ',
                                'error'
                            );
                        }
                    });
                }
            });
        }
        function activeUser(id) {
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
                        url: "{{ route('admin.acceptuser') }}",
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
                                    'There was a problem',
                                    'error'
                                );
                            }
                        },
                        error: function() {
                            Swal.fire(
                                'Error!',
                                'There was a problem ',
                                'error'
                            );
                        }
                    });
                }
            });
        }
    </script>
@endpush
