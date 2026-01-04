@extends('layout.user-layout')
@section('title', 'Add Deposite')
@section('content')
    <section class="section">
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col-lg-6">
                    <div class="card-style settings-card-1 mb-30">
                        <div class="title mb-30 d-flex justify-content-between align-items-center">
                            <h4>Meal Deposite</h4>
                        </div>
                        <form action="{{ route('user.storemeal') }}" method="POST">
                            @csrf
                            <div class="input-style-1">
                                <label>Date</label>
                                <input type="date" value="{{ old('date') ?? date('Y-m-d') }}" max="{{ date('Y-m-d') }}"
                                    name="date" placeholder="Date">
                                @error('date')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="input-style-1">
                                <label>Amount</label>
                                <input type="number" placeholder="Amount" name="amount" value="{{ old('amount') }}">

                                @error('amount')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="main-btn primary-btn btn-hover w-100 text-center">
                                Request
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
