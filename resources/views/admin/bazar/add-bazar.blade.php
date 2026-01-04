@extends('layout.admin-layout')
@section('title', 'Add Bazar')
@section('content')
    <section class="section">
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col-lg-6">
                    <div class="card-style settings-card-1 mb-30">
                        <div class="title mb-30 d-flex justify-content-between align-items-center">
                            <h4>Add Bazar</h4>
                        </div>
                        <form action="{{ route('admin.storebazar') }}" method="POST">
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

                            <div class="input-style-1">
                                <label>Details</label>
                                <textarea placeholder="Message" name="details" rows="5">{{ old('details') }}</textarea>

                                @error('details')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                              </div>

                            <div class="select-style-1">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5>Select Shopper</h5>
                                </div>
                                <div class="select-position">
                                    @foreach ($users as $user)
                                        <label for="shopper_{{ $user->id }}">
                                            <input type="checkbox" id="shopper_{{ $user->id }}" name="shopper[]"
                                                value="{{ $user->id }}">
                                            {{ $user->name }}
                                        </label>
                                    @endforeach

                                    @error('shopper')
                                        <span class="text-sm text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="main-btn primary-btn btn-hover w-100 text-center">
                                Add Bazar
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
