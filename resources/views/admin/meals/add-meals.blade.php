@extends('layout.admin-layout')
@section('title', 'Add Meals')
@section('content')
    <section class="section">
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col-lg-6">
                    <div class="card-style settings-card-1 mb-30">
                        <div class="title mb-30 d-flex justify-content-between align-items-center">
                            <h4>Add Meals</h4>
                        </div>
                        <form action="{{ route('admin.storemeal') }}" method="POST">
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
                                <label>Total Meal - (Per Person)</label>
                                <input type="number" placeholder="Amount" name="amount" value="{{ old('amount') }}">

                                @error('amount')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="select-style-1">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label>Select Member</label>
                                    <button type="button" id="checkAllBtn" class="badge bg-primary badge-pill" style="outline: none;border:none">Uncheck All</button>
                                </div>
                                <div class="select-position">
                                    @foreach ($users as $user)
                                        <label for="user_{{ $user->id }}">
                                            <input type="checkbox" id="user_{{ $user->id }}" name="users[]"
                                                value="{{ $user->id }}" checked>
                                            {{ $user->name }}
                                        </label>
                                    @endforeach

                                    @error('users')
                                        <span class="text-sm text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="main-btn primary-btn btn-hover w-100 text-center">
                                Add Meal
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
@push('admin_js')
<script>
    document.getElementById('checkAllBtn').addEventListener('click', function () {
        // Get all checkboxes with name 'user[]'
        let checkboxes = document.querySelectorAll('input[name="users[]"]');
        // Toggle check/uncheck state
        let allChecked = Array.from(checkboxes).every(checkbox => checkbox.checked);

        checkboxes.forEach(checkbox => {
            checkbox.checked = !allChecked;
        });

        // Change button text based on the state
        this.textContent = allChecked ? 'Check All' : 'Uncheck All';
    });
</script>
@endpush
