@extends('layouts.admin')
@section('content')

@php($title = 'Show User')
@push('title', yieldTitle($title))

@section('breadcrumb-link')
<li class="breadcrumb-item active" aria-current="page">
    <a href="{{ route('users.index') }}">Users</a>
</li>
<li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
@endsection

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <div class="container-fluid">

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Profile Picture : </strong>
                        <br>
                        @if(isset($user->profile_picture))
                            <img src="/storage/users/{{ $user->id }}/profile_picture/{{ $user->profile_picture}}" class="rounded-circle profile-show" alt="">
                        @else
                            <img src="/assets/img/blank_profile.png" class="rounded-circle profile-show" alt="">
                        @endif
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name : </strong>
                        {{$user->name}}
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Email : </strong>
                        {{$user->email}}
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Status : </strong>
                        <label for="status" class="badge badge-success">{{$user->status}}</label>
                    </div>
                </div>

                <div class="form-group text-right">
                    <div class="button">
                        <a href="{{route('users.index')}}" class="btn btn-warning mg-r-1">Okay</a>
                    </div>
                </div>

            </div><!-- table-responsive -->
        </div><!-- df-example -->
    </div><!-- card-body -->
</div><!-- card -->

@endsection
