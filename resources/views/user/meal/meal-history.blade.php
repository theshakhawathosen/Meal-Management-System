@extends('layout.user-layout')
@section('title', 'Meal History')
@section('content')
    <section class="section">
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="card-style settings-card-1 mb-30">
                        <div class="title mb-30 d-flex justify-content-between align-items-center">
                            <h4>Meal History</h4>
                        </div>
                        <div class="table-wrapper table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="lead-info">
                                            <h6>Member</h6>
                                        </th>
                                        <th class="lead-email">
                                            <h6>Amount</h6>
                                        </th>
                                        <th class="lead-phone">
                                            <h6>Date</h6>
                                        </th>
                                        <th>
                                            <h6>Status</h6>
                                        </th>
                                    </tr>
                                    <!-- end table row-->
                                </thead>
                                <tbody>
                                    @forelse ($meals as $meal)
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
                                                <span class="badge badge-pill bg-success">Recived</span>
                                            </td>
                                        </tr>
                                    @empty
                                    <tr >
                                        <td colspan="4" class="text-center">No Pending Deposite Found</td>
                                    </tr>
                                    @endforelse

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
        function deleteDeposite(id) {
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
                        url: "{{ route('user.deleteDeposite') }}",
                        type: 'post',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id:id,
                        },
                        success: function(response) {
                            if (response.success == true) {
                                Swal.fire(
                                    'Deleted!',
                                    response.msg,
                                    'success'
                                );
                                $("#trrow"+id).hide(500);
                            } else {
                                Swal.fire(
                                    'Error!',
                                    'There was a problem deleting the deposit.',
                                    'error'
                                );
                            }
                        },
                        error: function() {
                            Swal.fire(
                                'Error!',
                                'There was a problem deleting the deposit.',
                                'error'
                            );
                        }
                    });
                }
            });
        }

    </script>
@endpush
