@extends('layout.admin-layout')
@section('title', 'Change Manager')
@section('content')
    <section class="section">
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col-lg-6">
                    <div class="card-style settings-card-1 mb-30">
                        <div class="title mb-30 d-flex justify-content-between align-items-center">
                            <h4>Change Manager</h4>
                        </div>
                        <form action="{{ route('admin.updatemanager') }}" method="POST">
                            @csrf
                            <div class="select-style-1">
                                <label>Select Member</label>
                                <div class="select-position">
                                    <select name="user_id">
                                        <option value="">Select Member</option>
                                        @foreach ($users as $user)
                                            <option @if($user->id == old('user_id')) @selected(true) @endif value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <span class="text-sm text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="main-btn primary-btn btn-hover w-100 text-center">
                               Change Manager
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
