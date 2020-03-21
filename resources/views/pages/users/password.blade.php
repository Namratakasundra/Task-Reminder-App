@extends('layouts.admin')
@section('content')

@php($title = 'Change Password')
@push('title', yieldTitle($title))

@section('breadcrumb-link')
<li class="breadcrumb-item active" aria-current="page">
    <a href="{{ route('users.index') }}">Users</a>
</li>
<li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
@endsection

@section('breadcrumb-title')
<li class="breadcrumb-item active" aria-current="page">
    Change your password
</li>
@endsection

<form action="{{route('users.store')}}" method = "post">
    @csrf
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password"><strong>Password : <span
                                            class="tx-danger">*</span></strong></label>
                                <input type="password" name="password" id="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Your password" value="">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="confirm_password"><strong>Confirm  Password : <span
                                            class="tx-danger">*</span></strong></label>
                                <input type="password" name="confirm_password" id="confirm_password"
                                    class="form-control @error('confirm_password') is-invalid @enderror"
                                    placeholder="Rewrite Your password" value="">

                                @error('confirm_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group text-right">
                        <div class="button">
                            <a href="{{route('users.index')}}" class="btn btn-warning mg-r-1">Cancel</a>
                            <button type="submit" class="btn btn-success">
                                Save
                            </button>
                        </div>
                    </div>
                </div><!-- table-responsive -->
            </div><!-- df-example -->
        </div><!-- card-body -->
    </div><!-- card -->
</form>
@endsection
