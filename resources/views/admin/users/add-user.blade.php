@extends('layout.admin-layout')
@section('title', 'Add User')
@section('content')
    <section class="section">
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col-lg-6">
                    <div class="card-style settings-card-1 mb-30">
                        <div class="title mb-30 d-flex justify-content-between align-items-center">
                            <h4>Add User</h4>
                            <a href="{{ route('admin.users') }}" class="btn p-2 btn-sm btn-primary">Back</a>
                        </div>
                        <form action="{{ route('admin.storeuser') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="input-style-1">
                                <label>Full Name</label>
                                <input type="text" value="{{ old('name') }}" name="name" placeholder="Full Name">
                                @error('name')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="input-style-1">
                                <label>Email Address</label>
                                <input type="text" value="{{ old('email') }}" name="email"
                                    placeholder="Example:mygmail@gmail.com">
                                @error('email')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="input-style-1">
                                <label>Phone Number</label>
                                <input type="text" max="11" placeholder="Phone Number" name="phone"
                                    value="{{ old('phone') }}">

                                @error('phone')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="input-style-1">
                                <label>Profile Picture</label>
                                <input type="file" name="photo" />
                                @error('photo')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="select-style-1">
                                <label>Select Role</label>
                                <div class="select-position">
                                    <select name="role">
                                        <option value="">Select Role</option>
                                        <option @if ('user' == old('role')) @selected(true) @endif
                                            value="user">User</option>
                                        <option @if ('admin' == old('role')) @selected(true) @endif
                                            value="admin">Admin</option>
                                    </select>
                                    @error('role')
                                        <span class="text-sm text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-check form-switch toggle-switch mb-30">
                                <input class="form-check-input" type="checkbox" id="toggleSwitch1" name="status" @if(old('status')) checked @endif>
                                <label class="form-check-label" for="toggleSwitch1"> Active</label>
                              </div>
                            <button type="submit" class="main-btn primary-btn btn-hover w-100 text-center">
                                Add User
                            </button>
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
