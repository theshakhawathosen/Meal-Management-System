@extends('layout.admin-layout')
@section('title', 'Edit Meal')
@section('content')
    <section class="section">
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col-lg-6">
                    <div class="card-style settings-card-1 mb-30">
                        <div class="title mb-30 d-flex justify-content-between align-items-center">
                            <h4>Edit Meal</h4>
                        </div>
                        <form action="{{ route('admin.updatemeal') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $meal->id }}">
                            <div class="input-style-1">
                                <label>Date</label>
                                <input type="date" value="{{ old('date') ?? $meal->date }}" max="{{ date('Y-m-d') }}"
                                    name="date" placeholder="Date">
                                @error('date')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="input-style-1">
                                <label>Amount</label>
                                <input type="number" placeholder="Amount" name="amount" value="{{ old('amount') ?? $meal->amount }}">

                                @error('amount')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="select-style-1">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label>Select Member</label>
                                </div>
                                <div class="select-position">
                                    <select name="user">
                                        @foreach ($users as $user)
                                        <option @if($user->id == $meal->user_id) @selected(true) @endif value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('user')
                                        <span class="text-sm text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="main-btn primary-btn btn-hover w-100 text-center">
                                Update Meal
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

