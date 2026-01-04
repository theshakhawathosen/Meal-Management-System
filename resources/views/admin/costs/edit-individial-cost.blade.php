@extends('layout.admin-layout')
@section('title', 'Edit Individual Cost')
@section('content')
    <section class="section">
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col-lg-6">
                    <div class="card-style settings-card-1 mb-30">
                        <div class="title mb-30 d-flex justify-content-between align-items-center">
                            <h4>Edit Individual Cost</h4>
                        </div>
                        <form action="{{ route('admin.updatecost') }}" method="POST">
                            @csrf
                            <input type="hidden" value="{{ $cost->id }}" name="id">
                            <div class="input-style-1">
                                <label>Date</label>
                                <input type="date" value="{{ old('date') ?? $cost->date }}" max="{{ date('Y-m-d') }}"
                                    name="date" placeholder="Date">
                                @error('date')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="input-style-1">
                                <label>Amount</label>
                                <input type="number" placeholder="Amount" name="amount" value="{{ old('amount') ?? $cost->amount }}">

                                @error('amount')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="input-style-1">
                                <label>Details</label>
                                <textarea placeholder="Message" name="details" rows="5">{{ old('details') ??  str_replace('<br />', "", $cost->details); }}</textarea>

                                @error('details')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                              </div>

                            <div class="select-style-1">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5>Select Member</h5>
                                    <button type="button" id="checkAllBtn" class="badge bg-primary badge-pill" style="outline: none;border:none">Check All</button>
                                </div>
                                <div class="select-position">
                                    <select name="user">
                                        <option value="">Select Member</option>
                                        @foreach ($users as $user)
                                        <option value="{{ $user->id }}" @if($user->id == $cost->user_id) selected @endif >{{ $user->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('user')
                                        <span class="text-sm text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="select-style-1">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5>Select Shopper</h5>
                                </div>
                                <div class="select-position">
                                    @foreach ($users as $user)
                                        <label for="shopper_{{ $user->id }}">
                                            <input type="checkbox" id="shopper_{{ $user->id }}" name="shopper[]"
                                                value="{{ $user->id }}" @if(in_array($user->id,json_decode($cost->shopper,true))) checked @endif>
                                            {{ $user->name }}
                                        </label>
                                    @endforeach

                                    @error('shopper')
                                        <span class="text-sm text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="main-btn primary-btn btn-hover w-100 text-center">
                                Update
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
