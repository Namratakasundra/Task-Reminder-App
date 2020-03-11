@extends('layouts.admin')
@section('title','Show User')
@section('content')

<div class="card">
<div class="card-body">
<div class="table-responsive">
<div class="container-fluid">
                    
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
        <strong>Profile Picture : </strong>
        <br>    
            @if ($user->profile_picture)
                <img src="/storage/users/{{ $user->id }}/profile_picture/{{ $user->profile_picture}}" height="120px" width="120px" class="rounded-circle">
            @else
                <p>No image found</p>
            @endif
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name  : </strong>
            {{$user->name}}                    
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Email  : </strong>
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
        <a href="/user" class="btn btn-warning mg-r-1">Okay</a>
    </div>
    </div>

</div><!-- table-responsive -->
</div><!-- df-example -->
</div><!-- card-body -->
</div><!-- card -->

@endsection