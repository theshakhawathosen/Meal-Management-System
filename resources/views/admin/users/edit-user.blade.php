@extends('layout.admin-layout')
@section('title', 'Edit User')
@section('content')
    <section class="section">
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col-lg-6">
                    <div class="card-style settings-card-1 mb-30">
                        <div class="title mb-30 d-flex justify-content-between align-items-center">
                            <h4>Edit User</h4>
                            <a href="{{ route('admin.users') }}" class="btn p-2 btn-sm btn-primary">Back</a>
                        </div>
                        <form action="{{ route('admin.updateuser') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $user->id }}" name="id">
                            <div class="input-style-1">
                                <label>Full Name</label>
                                <input type="text" value="{{ old('name') ?? $user->name }}" name="name"
                                    placeholder="Full Name">
                                @error('name')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="input-style-1">
                                <label>Email Address</label>
                                <input type="text" value="{{ old('email') ?? $user->email }}" name="email"
                                    placeholder="Example:mygmail@gmail.com">
                                @error('email')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="input-style-1">
                                <label>Phone Number</label>
                                <input type="text" max="11" placeholder="Phone Number" name="phone"
                                    value="{{ old('phone') ?? $user->phone }}">

                                @error('phone')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="input-style-1">
                                <label>Profile Picture</label>
                                <input type="file" name="photo" />
                                <small class="my-3">Preview:</small>
                                <img style="height: 50px;width:50px;display:block" src="{{ $user->photo }}"
                                    alt="{{ $user->name }}">
                                @error('photo')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="select-style-1">
                                <label>Select Role</label>
                                <div class="select-position">
                                    <select name="role">
                                        <option value="">Select Role</option>
                                        @if ($user->id == Auth::id())
                                            <option @if ('admin' == $user->role) @selected(true) @endif
                                                value="admin">Admin</option>
                                        @else
                                            <option @if ('user' == $user->role) @selected(true) @endif
                                                value="user">User</option>
                                            <option @if ('admin' == $user->role) @selected(true) @endif
                                                value="admin">Admin</option>
                                        @endif
                                    </select>
                                    @error('role')
                                        <span class="text-sm text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            @if($user->id !== Auth::id())
                            <div class="form-check form-switch toggle-switch mb-30">
                                <input class="form-check-input" type="checkbox" id="toggleSwitch1" name="status"
                                    @if ($user->status == 1) checked @endif>
                                <label class="form-check-label" for="toggleSwitch1"> Active</label>
                            </div>
                            @endif
                            <button type="submit" class="main-btn primary-btn btn-hover w-100 text-center">
                                Update User
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
