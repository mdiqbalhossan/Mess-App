@extends('layouts.frontend.app')

@section('title', 'Dashboard')
@push('css')
<style>
    .card-text span {
        font-size: 25px;
        font-weight: 400;
    }
    .toast-box.toast-bottom.show {
        bottom: 0px !important;
    }
</style>
@endpush

@section('content')
{{-- Header Title --}}
<div class="header-large-title">
    <h1 class="title">Amanullah House</h1>
    <h4 class="subtitle">Welcome to our System. ({{ getSetting('month_name') }} - {{ date('Y') }})</h4>
</div>

{{-- Notice Section --}}
<div class="section full mt-3 mb-3">
    <div class="carousel-multiple owl-carousel owl-theme">
        @foreach(notice() as $notice)
            <div class="item">
                <div class="card text-center">
                    <div class="card-header">
                        {{Str::ucfirst($notice->type)}}
                    </div>
                    <div class="card-body">

                        <p class="card-text text-left">{{$notice->title}}</p>
                        <a href="#" class="btn btn-primary viewData" data-toggle="modal" data-target="#actionSheetContent" data-title="{{$notice->title}}" data-description="{{$notice->description}}">View</a>
                    </div>
                    <div class="card-footer text-muted">
                        {{$notice->created_at->diffForHumans()}}
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>

{{-- Action Sheet Content --}}
<div class="modal fade action-sheet" id="actionSheetContent" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Action Sheet Content</h5>
            </div>
            <div class="modal-body">
                <div class="action-sheet-content">
                    <p id="description">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fermentum, urna eget
                        finibus fermentum, velit metus maximus erat, nec sodales elit justo vitae sapien. Sed
                        fermentum varius erat, et dictum lorem. Cras pulvinar vestibulum purus sed hendrerit.
                        Praesent et auctor dolor. Ut sed ultrices justo. Fusce tortor erat, scelerisque sit amet
                        diam rhoncus, cursus dictum lorem. Ut vitae arcu egestas, congue nulla at, gravida
                        purus.
                    </p>
                    <a href="#" class="btn btn-secondary btn-block btn-lg" data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- Meal Information Section --}}
<div class="section full mt-3 mb-3">

    <div class="card bg-light mb-2">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h3>Manager- </h3>
                <h3>{{ getSetting('manager_name') }} ({{ getSetting('manager_room') }})</h3>
            </div>
        </div>
        <div class="card-body">
            <h5 class="card-title">Meal Information</h5>
            <p class="card-text">
            <ul class="listview image-listview">
                <li>
                    <div class="item">
                        <div class="icon-box bg-primary">
                            <ion-icon name="analytics-outline"></ion-icon>
                        </div>
                        <div class="in">
                            <div>Meal Rate</div>
                            <span class="text-muted">{{ number_format(getMealRate(), 2) }}</span>

                        </div>
                    </div>
                </li>
                <li>
                    <div class="item">
                        <div class="icon-box bg-primary">
                            <ion-icon name="person-circle-outline"></ion-icon>
                        </div>
                        <div class="in">
                            <div>Name</div>
                            <span class="text-muted">{{Auth::guard('member')->user()->name}}</span>

                        </div>
                    </div>
                </li>
                <li>
                    <div class="item">
                        <div class="icon-box bg-info">
                            <ion-icon name="business-outline"></ion-icon>
                        </div>
                        <div class="in">
                            <div>Room No</div>
                            <span class="text-muted">{{Auth::guard('member')->user()->room_no}}</span>

                        </div>
                    </div>
                </li>
                <li>
                    <div class="item">
                        <div class="icon-box bg-secondary">
                            <ion-icon name="cube-outline"></ion-icon>
                        </div>
                        <div class="in">
                            <div>Total Meal</div>
                            <span class="badge badge-primary">{{ getSingleTotalMeal(Auth::guard('member')->user()->index) }}</span>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="item">
                        <div class="icon-box bg-success">
                            <ion-icon name="card-outline"></ion-icon>
                        </div>
                        <div class="in">
                            <div>Total Deposit</div>
                            <span class="badge badge-info">{{ getSingleTotalDeposit(Auth::guard('member')->user()->index) }}</span>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="item">
                        <div class="icon-box bg-danger">
                            <ion-icon name="cart-outline"></ion-icon>
                        </div>
                        <div class="in">
                            <div>Total Cost</div>
                            <span class="badge badge-secondary">{{ getSingleTotalCost(Auth::guard('member')->user()->index) }}</span>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="item">
                        <div class="icon-box bg-warning">
                            <ion-icon name="wallet-outline"></ion-icon>
                        </div>
                        <div class="in">
                            <div>Balance</div>
                            <span class="badge {{ Auth::guard('member')->user()->balance > 0 ? 'badge-success' : 'badge-danger' }}">{{ Auth::guard('member')->user()->balance }}</span>
                        </div>
                    </div>
                </li>

            </ul>
            </p>
        </div>
    </div>
</div>

<!-- toast success -->
<div id="toast-15" class="toast-box toast-bottom bg-success" style="z-index:1052;">
    <div class="in">
        <div class="text" id="successText">
            Success Color
        </div>
    </div>
    <button type="button" class="btn btn-sm btn-text-light close-button">OK</button>
</div>
<!-- * toast success -->
@endsection

@push('js')
    <script>
        $(function () {
            // View Data
            $(".viewData").click(function (e) {
                e.preventDefault();
                var title = $(this).data('title');
                var description = $(this).data('description');

                $(".modal-title").html(title);
                $("#description").html(description);

            })


            $(".stepper-button").click(function (e) {
                e.preventDefault();
                var button = $(this);
                var date = button.attr("data-date");
                var id = button.attr("data-id");
                var mealType = button.hasClass('lunch') ? 'lunch' : 'dinner';
                var inputField = $('#'+mealType+'_'+id);
                var currentValue = parseInt(inputField.val()) || 0;
                var newValue = $(this).hasClass('stepper-up') ? currentValue + 1 : currentValue - 1;
                inputField.val(newValue);
                console.log(newValue);
                console.log(currentValue);
                $.ajax({
                    type: "POST",
                    url: "{{ route('save.meal') }}",
                    data: {
                        date: date,
                        mealType: mealType,
                        value: newValue
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: "json",
                    success: function (response) {
                        if(response.status == 'success'){
                            toastbox('toast-15', 2000);
                            $("#successText").html(response.message);
                        }
                    },
                    error: function (error) {
                        console.log("Error: " + error.responseText);
                    }
                });
            });
        });
    </script>
@endpush
