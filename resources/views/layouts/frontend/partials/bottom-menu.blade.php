<div class="appBottomMenu">
    <a href="{{ route('user.dashboard') }}" class="item">
        <div class="col">
            <ion-icon name="home-outline"></ion-icon>
            <strong>Home</strong>
        </div>
    </a>
    <a href="#" class="item" data-toggle="modal" data-target="#PanelRight">
        <div class="col">
            <div class="action-button">
                <ion-icon name="add-outline"></ion-icon>
            </div>
        </div>
    </a>
    <a href="{{ route('dashboard') }}" class="item">
        <div class="col">
            <ion-icon name="people-outline"></ion-icon>
            <strong>Admin</strong>
        </div>
    </a>
</div>

@php
    $months = [
        'January' => 31,
        'February' => 28,
        'March' => 31,
        'April' => 30,
        'May' => 31,
        'June' => 30,
        'July' => 31,
        'August' => 31,
        'September' => 30,
        'October' => 31,
        'November' => 30,
        'December' => 31
    ];

    $currentMonth = date('F');

    if (isset($months[$currentMonth])) {
        $loop = $months[$currentMonth];

    } else {
        $loop = 0;
    }

@endphp

<!-- Panel Right -->
<div class="modal fade panelbox panelbox-right" id="PanelRight" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Meal Sheet ({{ date('F, Y') }})</h4>
                <a href="javascript:;" data-dismiss="modal" class="panel-close">
                    <ion-icon name="close-outline"></ion-icon>
                </a>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Lunch</th>
                                <th scope="col">Dinner</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 1; $i<=$loop; $i++)
                                @php
                                $date = date('Y-m-d', strtotime(date('Y-m') . '-' . $i));
                                $today = date('Y-m-d');
                                @endphp
                            <tr>
                                <th scope="row">{{ $i }}</th>
                                {{-- <input type="hidden" class="date" name="date" value="{{ date('Y-m-d', strtotime(date('Y-m') . '-' . $i)) }}">                                --}}
                                <td>
                                    <div class="stepper stepper-sm">
                                        <button class="stepper-button stepper-down lunch" data-date="{{$date}}" @if ($date < $today) disabled @endif>-</button>
                                        <input type="hidden" id="lunch_{{$i}}" name="lunch" value="{{ getMealByDate($date)->lunch ?? 0 }}">
                                        <input type="text" name="lunch" id="lunch_{{$i}}" class="form-control" value="{{ getMealByDate($date)->lunch ?? 0 }}" disabled />
                                        <button class="stepper-button stepper-up lunch" data-date="{{$date}}" data-id="{{$i}}" @if ($date < $today) disabled @endif>+</button>
                                    </div>
                                </td>
                                <td>
                                    <div class="stepper stepper-sm">
                                        <button class="stepper-button stepper-down dinner" data-date="{{$date}}" @if ($date < $today) disabled @endif>-</button>
                                        <input type="hidden" id="dinner_{{$i}}" name="dinner" value="{{ getMealByDate($date)->lunch ?? 0 }}">
                                        <input type="text" name="dinner" id="dinner_{{$i}}" class="form-control" value="{{getMealByDate($date)->dinner ?? 0}}" disabled />
                                        <button class="stepper-button stepper-up dinner" data-date="{{$date}}" data-id="{{$i}}" @if ($date < $today) disabled @endif>+</button>
                                    </div>
                                </td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- * Panel Right -->
