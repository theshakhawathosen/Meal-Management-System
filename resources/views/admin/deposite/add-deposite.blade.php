@extends('layout.admin-layout')
@section('title', 'Add Deposite')
@section('content')
    <section class="section">
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col-lg-6">
                    <div class="card-style settings-card-1 mb-30">
                        <div class="title mb-30 d-flex justify-content-between align-items-center">
                            <h4>Add Deposite</h4>
                            <a href="{{ route('admin.deposite') }}" class="btn p-2 btn-sm btn-primary">Back</a>
                        </div>
                        <form action="{{ route('admin.Storedeposite') }}" method="POST">
                            @csrf
                            <div class="select-style-1">
                                <label>Select Member</label>
                                <div class="select-position">
                                    <select name="user_id">
                                        <option value="">Select Member</option>
                                        @foreach ($users as $user)
                                            <option @if ($user->id == old('user_id')) @selected(true) @endif
                                                value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <span class="text-sm text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
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
                                Add Deposite
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
