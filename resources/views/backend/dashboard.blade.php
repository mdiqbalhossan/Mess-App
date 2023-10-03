@extends('layouts.backend.app')

@section('title', 'Dashboard')

@section('content')
<div class="alert alert-primary" role="alert">ডাটা গুলা এক্সেল ফাইল থেকে Fetch করে আনা হচ্ছে। তাই
    প্রতিদিন আপডেট ডাটা পাওয়ার জন্য Sync বাটন এ ক্লিক করুন।&nbsp;
    <button type="button" class="btn btn-primary" id="sync_button">
        <span class="tf-icons bx bx-sync"></span>&nbsp; Sync
    </button>
</div>
<div class="row">
    <div class="col-lg-3 col-md-4 order-1">
        <div class="card">
            <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                        <img src="{{ asset('backend/assets/img/icons/unicons/chart-success.png') }}" alt="chart success"
                            class="rounded" />
                    </div>
                </div>
                <span class="fw-semibold d-block mb-1">Meal Rate</span>
                <h3 class="card-title mb-2">৳ {{ round(getMealRate(), 2) }}</h3>
                {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small> --}}
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-4 order-1">
        <div class="card">
            <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                        <img src="{{ asset('backend/assets/img/icons/unicons/wallet-info.png') }}" alt="chart success"
                            class="rounded" />
                    </div>
                </div>
                <span class="fw-semibold d-block mb-1">Total Cash</span>
                <h3 class="card-title mb-2">৳ {{ getTotalCash() }}</h3>
                {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small> --}}
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-4 order-1">
        <div class="card">
            <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                        <img src="{{ asset('backend/assets/img/icons/unicons/paypal.png') }}" alt="chart success"
                            class="rounded" />
                    </div>
                </div>
                <span class="fw-semibold d-block mb-1">Total Minus</span>
                <h3 class="card-title mb-2">{{ getTotalNegative() }}</h3>
                {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small> --}}
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-4 order-1">
        <div class="card">
            <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                        <img src="{{ asset('backend/assets/img/icons/unicons/cc-primary.png') }}" alt="chart success"
                            class="rounded" />
                    </div>
                </div>
                <span class="fw-semibold d-block mb-1">Total Deposit</span>
                <h3 class="card-title mb-2">৳ {{ getTotalDeposit() }}</h3>
                {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small> --}}
            </div>
        </div>
    </div>
</div>
<hr class="my-2" />
<div class="row">
    <div class="col-lg-3 col-md-4 order-1">
        <div class="card">
            <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                        <span class="badge bg-label-primary p-2"><i class="bx bx-user-circle text-primary"></i></span>
                    </div>
                </div>
                <span class="fw-semibold d-block mb-1">Total Member</span>
                <h3 class="card-title mb-2"> {{ getTotalMember() }}</h3>
                {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small> --}}
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-4 order-1">
        <div class="card">
            <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                        <span class="badge bg-label-primary p-2"><i class="bx bx-cart text-primary"></i></span>
                    </div>
                </div>
                <span class="fw-semibold d-block mb-1">Total Bazar</span>
                <h3 class="card-title mb-2">৳ {{ getTotalBazar() }}</h3>
                {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small> --}}
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-4 order-1">
        <div class="card">
            <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                        <span class="badge bg-label-primary p-2"><i class="bx bx-stop-circle text-primary"></i></span>
                    </div>
                </div>
                <span class="fw-semibold d-block mb-1">Total Meal</span>
                <h3 class="card-title mb-2">{{ getTotalMeal() }}</h3>
                {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small> --}}
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-4 order-1">
        <div class="card">
            <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                        <span class="badge bg-label-primary p-2"><i class="bx bx-dollar text-primary"></i></span>
                    </div>
                </div>
                <span class="fw-semibold d-block mb-1">Total Cost</span>
                <h3 class="card-title mb-2">৳ {{ getTotalCost() }}</h3>
                {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small> --}}
            </div>
        </div>
    </div>
</div>
<hr class="my-2" />
{{-- Table --}}
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <h5 class="card-header">Top 5 Minus</h5>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Room</th>
                                <th>Name</th>
                                <th>Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($top5Members as $value)
                            <tr>
                                <td>{{ $value->room_no }}</td>
                                <td>{{ $value->name }}</td>
                                <td><span class="badge bg-label-danger me-1">৳ {{ $value->balance }}</span></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--/ Bordered Table -->
    </div>
    <div class="col-md-6">
        <div class="card">
            <h5 class="card-header">Most 5 Deposit</h5>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Room</th>
                                <th>Name</th>
                                <th>Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($top5Deposit as $value)
                            <tr>
                                <td>{{ $value->member->room_no }}</td>
                                <td>{{ $value->member->name }}</td>
                                <td><span class="badge bg-label-success me-1">৳ {{ $value->amount }}</span></td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--/ Bordered Table -->
    </div>
</div>

<div class="bs-toast toast toast-placement-ex m-2" role="alert" aria-live="assertive" aria-atomic="true"
    data-delay="2000">
    <div class="toast-header">
        <i class="bx bx-bell me-2"></i>
        <div class="me-auto fw-semibold">Bootstrap</div>
        <small>11 mins ago</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">Fruitcake chocolate bar tootsie roll gummies gummies jelly beans cake.</div>
</div>
@endsection

@push('js')
<script src="{{ asset('backend') }}/assets/js/dashboards-analytics.js"></script>
<script src="{{ asset('backend') }}/assets/js/ui-toasts.js"></script>
<script>
    $(function () {
        $("#sync_button").click(function (e) { 
            e.preventDefault();
            $(this).html("Loading...");
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true,
                
            }
            $.ajax({
                type: "GET",
                url: "{{ route('member.import') }}",                
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    if(response.status == "success"){
                        $("#sync_button").html("Sync");                        
                        toastr.success(response.message);
                    }else{
                        toastr.success('Error, Something went wrong!');
                    }                    
                }
            });
            
        });
    });
</script>
@endpush