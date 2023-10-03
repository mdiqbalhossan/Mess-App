@extends('layouts.frontend.app')

@section('title', 'Meal Info')
@push('css')

@endpush

@section('content')
    {{-- Header Title --}}
    <div class="header-large-title">
        <h1 class="title">Amanullah House</h1>
        <h4 class="subtitle">Welcome to our System. ({{ getSetting('month_name') }} - {{ date('Y') }})</h4>
    </div>


    <div class="section full mt-1 mb-2">

        <div class="content-header mb-05">
            Meal Information
        </div>
        <div class="wide-block p-0">

            <div class="table-responsive table-bordered">
                <table class="table">
                    <thead>
                    <tr>
                        <th class="text-center">Date</th>
                        <th class="text-center">Meal</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                    $meals = getSingleMeal(Auth::guard('member')->user()->index);
                    @endphp
                    @foreach($meals as $key => $meal)
                        <tr>
                            <th class="text-center">{{$key}}</th>
                            <td class="text-center">{{ $meal }}</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </div>


@endsection

@push('js')

@endpush
