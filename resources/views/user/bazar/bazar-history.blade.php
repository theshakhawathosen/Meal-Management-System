@extends('layout.user-layout')
@section('title', 'Bazar Cost')
@section('content')
    <section class="section">
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="card-style settings-card-1 mb-30">
                        <div class="title mb-30 d-flex justify-content-between align-items-center">
                            <h4>Bazar List</h4>
                        </div>
                        <div class="table-wrapper table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            <h6>Date</h6>
                                        </th>
                                        <th class="lead-email">
                                            <h6>Details</h6>
                                        </th>
                                        <th class="lead-email">
                                            <h6>Cost</h6>
                                        </th>
                                        <th class="lead-email">
                                            <h6>Shopper</h6>
                                        </th>
                                    </tr>
                                    <!-- end table row-->
                                </thead>
                                <tbody>
                                    @foreach ($bazars as $bazar)
                                        <tr id="trrow{{ $bazar->id }}">
                                            <td>
                                                <p>{{ $bazar->date }}</p>
                                            </td>
                                            <td class="min-width">
                                                <p>{!! $bazar->details !!}</p>
                                            </td>
                                            <td class="min-width">
                                                <p>{{ $bazar->amount }}</p>
                                            </td>
                                            <td class="min-width">
                                                <style>
                                                    .shopper li {
                                                        display: inline;
                                                    }

                                                    .shopper li img {
                                                        width: 30px;
                                                        height: 30px;
                                                        border-radius: 50%;
                                                    }
                                                </style>
                                                <ul class="shopper">
                                                    @foreach (json_decode($bazar->shopper, true) as $shopper)
                                                        @php
                                                            $userphoto = \App\Models\User::find($shopper)->photo;
                                                        @endphp
                                                        <li><img src="{{ $userphoto }}" alt="{{ $shopper }}"></li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <!-- end table -->
                        </div>
                        <div class="row">
                            {{ $bazars->links('pagination::bootstrap-5') }}
                        </div>
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
