@extends('layout.user-layout')
@section('content')
    <div class="notification-wrapper">
        <div class="container-fluid">
            <!-- ========== title-wrapper start ========== -->
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="title">
                            <h2>Notifications</h2>
                        </div>
                    </div>
                <!-- end col -->
                    <div class="col-md-6">
                        <div class="breadcrumb-wrapper">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('user.dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Notifications
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

            <div class="card-style">
                <div class="d-flex justify-content-end">
                    <button class="btn btn-danger mb-3 mx-2" onclick="deleteall()">Delete All</button>
                    <button class="btn btn-primary mb-3" onclick="markallread()">Mark All as read</button>
                </div>
                @forelse ($notifications as $notification)
                    <div id="noti{{ $notification->id }}"
                        class="single-notification p-3 rounded-md mb-2 {{ $notification->read_at != null ? 'readed' : 'unreaded' }}">
                        <div class="notification">
                            <div class="image primary-bg">
                                @isset($notification['data'][0]['newuser'])
                                    <img src="{{ $notification['data'][0]['newuser']['photo'] }}" alt="">
                                @else
                                    <span>{{ Str::limit($notification['data'][0]['title'], 1, '') }}</span>
                                @endisset
                            </div>
                            <a href="{{ route('user.readandredirect',['id'=> $notification->id,'redirect' => base64_encode($notification['data'][0]['userurl'])]) }}" class="content">
                                <h6>{{ $notification['data'][0]['title'] }}</h6>
                                <p class="text-sm text-gray">{{ $notification['data'][0]['messege'] }}</p>
                                <span
                                    class="text-sm text-medium text-gray">{{ $notification->created_at->diffForHumans() }}</span>
                            </a>
                        </div>
                        <div class="action">
                            <button class="delete-btn" onclick="deleteNotification('{{ $notification->id }}')">
                                <i class="lni lni-trash-can"></i>
                            </button>
                            <button class="more-btn dropdown-toggle" id="moreAction" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="lni lni-more-alt"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="moreAction">
                                <li class="dropdown-item">
                                    @if ($notification->read_at == null)
                                        <a href="{{ route('user.readnotification', $notification->id) }}"
                                            class="text-gray">Mark as Read</a>
                                    @else
                                        <a href="{{ route('user.unreadnotification', $notification->id) }}"
                                            class="text-gray">Mark as Unread</a>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                @empty
                    <p>No Notification Found!</p>
                @endforelse
                <div class="row mt-4">

                {{ $notifications->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
        <!-- end container -->
    </div>
@endsection
@push('user_js')
    <script>
        function deleteNotification(id) {
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
                        type: "post",
                        url: "{{ route('user.deletenotification') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: id,
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Notification has been deleted!.",
                                    icon: "success"
                                });
                                $("#noti" + id).hide(500);
                            } else {
                                Swal.fire({
                                    title: "Failed!",
                                    text: "Something went wrong!",
                                    icon: "error"
                                });
                            }
                        }
                    });


                }
            });
        }

        function deleteall() {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete all!"
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        type: "post",
                        url: "{{ route('user.deleteallnotification') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "All Notification deleted!.",
                                    icon: "success"
                                });
                                setTimeout(() => {
                                window.location.reload();
                                }, 1000);
                            } else {
                                Swal.fire({
                                    title: "Failed!",
                                    text: "Something went wrong!",
                                    icon: "error"
                                });
                            }
                        }
                    });


                }
            });
        }

        function markallread() {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, read all!"
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        type: "post",
                        url: "{{ route('user.readallnotification') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    title: "Success!",
                                    text: "All Notification Mark as read!.",
                                    icon: "success"
                                });
                                setTimeout(() => {
                                window.location.reload();
                                }, 1000);
                            } else {
                                Swal.fire({
                                    title: "Failed!",
                                    text: "Something went wrong!",
                                    icon: "error"
                                });
                            }
                        }
                    });


                }
            });
        }
    </script>
@endpush
