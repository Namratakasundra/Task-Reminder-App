@extends('layouts.admin')
@section('title','Create User')
@section('content')
  
<script src="/lib/jquery/jquery.min.js"></script>
    <form method="POST" id="user-form" action="{{ isset($user) ? route('users.update', ['id' => $user->id]) : route('users.store') }}" enctype="multipart/form-data">
    @csrf
        <div class="card">
        <div class="card-body">
        <div class="table-responsive">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                    <label for="name"><strong>Name : <span class="tx-danger">*</span></strong></label>
                    <input type="text" name = "name" id = "name" class="form-control" required placeholder="Your name" value="{{isset($user) ? $user->name : old('name') }}" >
                </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                    <label for="email"><strong>Email : <span class="tx-danger">*</span></strong></label>
                    <input type="text" name = "email" id = "email" class="form-control" required placeholder="Your email" value="{{isset($user) ? $user->email : old('email') }}" >
                </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                    <label for="password"><strong>Password : <span class="tx-danger">*</span></strong></label>
                    <input type="password" name = "password" id = "password" class="form-control" required placeholder="Your password" value="{{isset($user) ? $user->password : old('password') }}" >
                </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="status"><strong>Status : <span class="tx-danger">*</span></strong></label>
                        <select class="form-control user-status-select{{ $errors->has('status') ? ' is-invalid' : '' }}" id="status" name="status" required>
                            <option disabled selected value>Select Status</option>
                            @foreach($statuses  as $status)
                                <option value="{{ $status }}" @if(isset($user) && $user->status == $status) selected @elseif(!isset($user) && $status == 'Active') selected @else @endif>{{ $status }}
                            </option>
                            @endforeach
                        </select>
                    @if ($errors->has('status'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('status') }}</strong>
                    </span>
                    @endif
                </div>
            </div>    
            
            <div class="row">
            
                <div class="col-md-4" style="padding-top:30px;">
                <div class="form-group">
                    <label for="profile_picture"><strong>Upload your profile : </strong></label>
                    <input type="file" name="profile_picture" id ="profile_picture" class="form-control" >
                        <br> 
                        @if (isset($user->profile_picture))
                        <img src="/storage/users/{{ $user->id }}/profile_picture/{{ $user->profile_picture}}" height="120px" width="120px">
                        @else
                            <p>No image found</p>
                        @endif 
                        <input type="hidden" id="profile_picture_data64" name="profile_picture_data64">                                 
                </div>
                </div>

                <div class="col-md-4 text-center">
                    <div id="profile_picture-demo" style="width:350px"></div>
                </div>

            </div>
                        
                <div class="form-group text-right">
                <div class="button">
                    <a href="/user" class="btn btn-warning mg-r-1">Cancel</a>
                    <button type="submit" class="btn btn-success">
                        @if (isset($user->name))       
                        Update
                        @else 
                        Save
                        @endif
                    </button>
                </div>
                </div>
        </div><!-- table-responsive -->
        </div><!-- df-example -->
        </div><!-- card-body -->
        </div><!-- card -->
    </form>
@endsection