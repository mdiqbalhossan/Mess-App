<div class="modal fade panelbox panelbox-left" id="sidebarPanel" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">

                <!-- profile box -->
                <div class="profileBox">
                    <div class="image-wrapper">
                        <img src="{{ asset('frontend/assets/img/sample/avatar/user.png') }}" alt="image" class="imaged rounded">
                    </div>
                    <div class="in">
                        <strong>{{Auth::guard('member')->user()->name}}</strong>
                        <div class="text-muted">
                            <ion-icon name="location"></ion-icon>
                            Room:- {{ Auth::guard('member')->user()->room_no }}
                        </div>
                    </div>
                    <a href="javascript:;" class="close-sidebar-button" data-dismiss="modal">
                        <ion-icon name="close"></ion-icon>
                    </a>
                </div>
                <!-- * profile box -->

                <ul class="listview flush transparent no-line image-listview mt-2">
                    <li>
                        <a href="{{route('user.dashboard')}}" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="home-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Home
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('meal.info')}}" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="cube-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Meal Information
                            </div>
                        </a>
                    </li>
{{--                    <li>--}}
{{--                        <a href="app-pages.html" class="item">--}}
{{--                            <div class="icon-box bg-primary">--}}
{{--                                <ion-icon name="card-outline"></ion-icon>--}}
{{--                            </div>--}}
{{--                            <div class="in">--}}
{{--                                <div>Deposit Information</div>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </li>--}}
                    <li>
                        <a href="javascript:;" onclick="toastbox('toast-17', 2000)" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="help-outline"></ion-icon>
                            </div>
                            <div class="in">
                                <div>Complain Box</div>
                            </div>
                        </a>
                    </li>

                </ul>

            </div>

            <!-- sidebar buttons -->
            <div class="sidebar-buttons">
                <a href="javascript:;" class="button">
                    <ion-icon name="person-outline"></ion-icon>
                </a>
                <a href="javascript:;" class="button">
                    <ion-icon name="settings-outline"></ion-icon>
                </a>
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('form').submit();" class="button">
                    <ion-icon name="log-out-outline"></ion-icon>
                </a>

                <form method="POST" id="form" action="{{ route('logout') }}">
                    @csrf

                </form>
            </div>
            <!-- * sidebar buttons -->
        </div>
    </div>
</div>
