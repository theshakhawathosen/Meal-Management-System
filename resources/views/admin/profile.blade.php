@extends('layout.admin-layout')
@section('title', 'Admin Profile')
@section('content')
    <section class="section">
        <div class="container-fluid">
            <!-- ========== title-wrapper start ========== -->
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="title">
                            <h2>Profile</h2>
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
                                        Profile
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
                <div class="col-lg-6">
                    <div class="card-style settings-card-1 mb-30">
                        <div class="title mb-30 d-flex justify-content-between align-items-center">
                            <h6>My Profile</h6>
                        </div>
                        <div class="profile-info">
                            <div class="d-flex align-items-center mb-30">
                                <div class="profile-image">
                                    <img src="{{ Auth::user()->photo }}" alt="{{ Auth::user()->name }} photo" />
                                </div>
                                <div class="profile-meta">
                                    <h5 class="text-bold text-dark mb-10">{{ Auth::user()->name }}</h5>
                                    <p class="text-sm text-gray">{{ Str::ucfirst(Auth::user()->role) }}</p>
                                </div>
                            </div>

                            <table class="table">
                                <tr class="">
                                    <td class="p-2 border">Email</td>
                                    <td class="p-2 border">{{ Auth::user()->email }}</td>
                                </tr>
                                <tr>
                                    <td class="p-2 border">Phone</td>
                                    <td class="p-2 border">{{ Auth::user()->phone }}</td>
                                </tr>
                                <tr>
                                    <td class="p-2 border">Join At</td>
                                    <td class="p-2 border">{{ \Carbon\Carbon::parse(Auth::user()->created_at)->format('d F, Y') }}</td>
                                </tr>
                                <tr>
                                    <td class="p-2 border">Role</td>
                                    <td class="p-2 border"><span
                                            class="badge badge-pill bg-primary badge-primary text-capitalize">{{ Auth::user()->role }}</span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->

                <div class="col-lg-6">
                    <div class="card-style settings-card-2 mb-30">
                        <div class="title mb-30">
                            <h6>Update Profile</h6>
                        </div>
                        <form action="{{ route('admin.Updateprofile') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Full Name</label>
                                        <input type="text" name="name" placeholder="Full Name"
                                            value="{{ Auth::user()->name }}" />
                                            @error('name')
                                                <span class="text-danger text-sm">{{ $message }}</span>
                                            @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Email</label>
                                        <input type="email" name="email" placeholder="Email"
                                            value="{{ Auth::user()->email }}" />
                                        @error('email')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xxl-4">
                                    <div class="input-style-1">
                                        <label>Phone</label>
                                        <input type="text" placeholder="Phone Number" name="phone" maxlength="11"
                                            value="{{ Auth::user()->phone }}" />
                                        @error('phone')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-xxl-4">
                                    <div class="input-style-1">
                                        <label>Profile Picture</label>
                                        <input type="file" accept=".png,.jpg,.webp" name="photo" />
                                        @error('photo')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="main-btn primary-btn btn-hover">
                                        Update Profile
                                    </button>
                                </div>
                            </div>
                        </form>
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
