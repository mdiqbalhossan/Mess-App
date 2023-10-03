@extends('layouts.backend.app')

@section('title', 'Today Meal')

@push('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
@endpush

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Meal /</span> Today Meal</h4>

<div class="card my-2">
    <div class="card-body">
        <form action="{{ route('meal.index') }}" method="GET">
            @csrf
        <div class="mb-3 row">
        <label for="html5-datetime-local-input" class="col-md-3 col-form-label">Filter Date Wise Meal</label>
        <div class="col-md-6">
            <input
            class="form-control"
            type="date"
            name="date"
            id="html5-datetime-local-input"
            />
        </div>
        <button type="submit" class="col-md-3 btn btn-primary btn-sm"><i class="tf-icons bx bx-search"></i>&nbsp;Filter</button>
        </div>
        </form>
    </div>
</div>

<!-- Basic Bootstrap Table -->
<div class="card">
    <h5 class="card-header">Today Meal ({{ \Carbon\Carbon::parse($today)->format('j F, Y') }})
    </h5>
    <div class="table-responsive text-nowrap p-2">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th>Room</th>
                    <th>Name</th>
                    <th>Breakfast</th>
                    <th>Launch</th>
                    <th>Dinner</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($data as $key => $meal)
                <tr>
                    <td>
                        {{ $meal->member->room_no }}
                    </td>
                    <td>
                        {{ $meal->member->name }}
                    </td>
                    <td>
                        <div class="form-check">
                            <input type="number" class="form-control form-control-sm" name="readonly" value="{{$meal->breakfast}}" disabled>
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input type="number" class="form-control form-control-sm lunch" id="lunch-{{$meal->id}}" name="lunch" value="{{$meal->lunch}}">
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input type="number" class="form-control form-control-sm dinner" id="dinner-{{$meal->id}}" name="dinner" value="{{$meal->dinner}}">
                        </div>
                    </td>
                    <td>
                        <span class="badge badge-center bg-primary">{{ sumData($meal->breakfast, $meal->lunch, $meal->dinner) }}</span>
                    </td>
                </tr>
                @endforeach


            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">Total Meal</td>
                    <td>{{ countTotal($data)['breakfast'] }}</td>
                    <td>{{ countTotal($data)['lunch'] }}</td>
                    <td>{{ countTotal($data)['dinner'] }}</td>
                    <td>{{ countTotal($data)['total'] }}</td>
                </tr>
            </tfoot>
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

    function ajaxRequest(data){
        $.ajax({
            type: 'POST',
            url: "{{route('meal.update')}}", // Replace with your Laravel route URL
            data: data,
            success: function(response) {
                toastr.success(response.message);
            },
            error: function(xhr) {
                toastr.error("Something went wrong!");
            }
        });
    }
</script>
@endpush
