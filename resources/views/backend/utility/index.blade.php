@extends('layouts.backend.app')

@section('title', 'Utility Bill')

@push('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
@endpush

@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Utility Bill</span></h4>

    <div class="card my-2">
        <div class="card-body">
            <form action="{{ route('utility.generate') }}" method="POST">
                @csrf
                <div class="mb-3 row">
                    <label for="html5-datetime-local-input" class="col-md-3 col-form-label">Generate Bill</label>
                    <div class='col-md-6'>
                        <div class="row">
                            <div class="col-md-6">
                                <select class="form-select" name="month" aria-label="Default select example">
                                    <option selected>Select Month</option>
                                    @foreach (getMonthName() as $key => $name)
                                        <option value="{{ $key }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="amount" placeholder="Enter Amount" class="form-control">
                            </div>
                        </div>

                    </div>
                    <button type="submit" class="col-md-3 btn btn-primary btn-sm"><i
                            class="tf-icons bx bx-search"></i>&nbsp;Generate</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Basic Bootstrap Table -->
    <div class="card">
        <input type="hidden" name="month_name" id="month_name" value="{{ $monthNameAndYear }}">
        <h5 class="card-header">Utility Bill ({{ $monthNameAndYear }})
            <span class="badge bg-dark">Total Bill: ৳{{ $totalBill }}</span>
            <span class="badge bg-dark">Collect Bill: ৳{{ $paidBill }}</span>
            <span class="badge bg-dark">Unpaid Bill: ৳{{ $unpaidBill }}</span>
            <button class="btn btn-dark btn-sm" id="collect_adjust">Collect Adjust</button>
        </h5>
        <div class="table-responsive text-nowrap p-2">
            <table class="table" id="myTable">
                <thead>
                    <tr>
                        <th>Room</th>
                        <th>Name</th>
                        <th>Month</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($utilities as $utility)
                        <tr>
                            <td>{{ $utility->member->room_no ?? '' }}</td>
                            <td>{{ $utility->member->name ?? '' }}</td>
                            <td>{{ $utility->month }}</td>
                            <td>{{ $utility->amount }}</td>
                            <td>
                                @if ($utility->status == 'unpaid')
                                    <span class="badge bg-danger">Unpaid</span>
                                @else
                                    <span class="badge bg-success">Paid</span>
                                @endif
                            </td>
                            <td>
                                @if ($utility->status == 'unpaid')                                    
                                    <a href="{{ route('utility.payBill', $utility->id) }}" class="btn btn-dark btn-sm" title="Received Amount">
                                        <i class='bx bx-checkbox-checked'></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!--/ Basic Bootstrap Table -->
@endsection

@push('js')
    <script src="//cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script>
        let table = new DataTable('#myTable');
        $('.lunch').on('change', function() {
            var mealId = $(this).attr('id').split('-')[1]; // Extract the meal ID
            var newValue = $(this).val(); // Get the new value
            ajaxRequest({
                id: mealId,
                lunch: newValue,
                _token: '{{ csrf_token() }}',
            });
        })

        $('.dinner').on('change', function() {
            var mealId = $(this).attr('id').split('-')[1]; // Extract the meal ID
            var newValue = $(this).val(); // Get the new value
            ajaxRequest({
                id: mealId,
                dinner: newValue,
                _token: '{{ csrf_token() }}',
            });
        })

        function ajaxRequest(data) {
            $.ajax({
                type: 'POST',
                url: "{{ route('meal.update') }}", // Replace with your Laravel route URL
                data: data,
                success: function(response) {
                    toastr.success(response.message);
                },
                error: function(xhr) {
                    toastr.error("Something went wrong!");
                }
            });
        }

        // Collect Adjust
        $(document).on("click", "#collect_adjust", function() {
            $(this).text('Collecting...');
            let month = $('#month_name').val();
            $.ajax({
                url: "{{ route('utility.collectAdjust') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "month": month
                },
                success: function(response) {
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true
                    }
                    toastr.success(response.message);
                    $('#check_for_adjust_button').text('Collect Adjust');
                },
                error: function(response) {
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true
                    }
                    toastr.error(response.responseJSON.message);
                    $('#check_for_adjust_button').text('Collect Adjust');
                }
            })
        })
    </script>
@endpush
