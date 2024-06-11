@extends('backend.partials.app')
@push('css')
<style>
     .card{
        transition: 1.5s;
     }
     .card h3 h4{
        color: grey;
     }
     .card h3:hover{
        color: white;
     }
     .card h4:hover{
        color: white;
     }
    .card:hover {
        background: rgb(136, 166, 212);
        box-shadow: 0 4px 8px rgba(212, 185, 185, 0.1)0.1);

        transition: box-shadow 0.3s ease, transform 0.3s ease;

    }
    .size{
        font-size: 20px;
    }

</style>
@endpush
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class=" col-xl-12 col-lg-12 col-md-12 col-12 order-1">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="text-center size">Total Event</h4>
                                <h3 class="card-title mb-2 text-center">{{ $events }}</h3>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="text-center size">Total Memeber</h4>
                                <h3 class="card-title mb-2 text-center">{{ $user }}</h3>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="text-center size">Pending Member</h4>
                                <h3 class="card-title mb-2 text-center">{{ $pendingUser }}</h3>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="text-center size">Approved Member</h4>
                                <h3 class="card-title mb-2 text-center">{{ $approvedUser }}</h3>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="text-center size">Upcoming Event</h4>
                                <h3 class="card-title mb-2 text-center">{{ $upcomingEvents }}</h3>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="text-center size">Previous Event</h4>
                                <h3 class="card-title mb-2 text-center">{{ $previewEvents }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="text-center size">Revenew(Upcoming)</h4>
                                <h3 class="card-title mb-2 text-center">${{ $totalRevenue }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="text-center size">Monthly Revenew</h4>
                                <h3 class="card-title mb-2 text-center">${{ $monthlyIncome }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
@endsection
