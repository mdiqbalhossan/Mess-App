@extends('layouts.backend.app')

@section('title','Setting')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Setting/</span> Update Setting</h4>

<!-- Basic Layout -->
<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Add Member</h5>
                <small class="text-muted float-end">Default label</small>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('setting.post')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="month_name">Month Name</label>
                                <input type="text" name="month_name" class="form-control @error('month_name') is-invalid @enderror"
                                    id="month_name" value="{{ getSetting('month_name') }}" />
                                @error('month_name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="excel_id">Excel Id</label>
                                <input type="text" name="excel_id" class="form-control @error('excel_id') is-invalid @enderror"
                                    id="excel_id" value="{{ getSetting('excel_id') }}"/>
                                @error('excel_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="manager_name">Manager Name</label>
                                <input type="text" name="manager_name" class="form-control @error('manager_name') is-invalid @enderror"
                                    id="manager_name" value="{{ getSetting('manager_name') }}"/>
                                @error('manager_name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="manager_room">Manager Room</label>
                                <input type="text" name="manager_room" class="form-control @error('manager_room') is-invalid @enderror"
                                    id="manager_room" value="{{ getSetting('manager_room') }}"/>
                                @error('manager_room')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>                   
                    
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection