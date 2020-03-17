@extends('layouts.admin')
@section('content')

<h4>@if (isset($user->name))
    @php($title = 'Edit User')
    @else
    @php($title = 'Create User')
    @endif
</h4>
@push('title', yieldTitle($title))

@section('breadcrumb-link')
<li class="breadcrumb-item active" aria-current="page">
    <a href="{{ route('users.index') }}">Users</a>
</li>
<li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
@endsection

<script src="/lib/jquery/jquery.min.js"></script>

{{-- <ul>
    @foreach ($errors->all() as $e)
        <li> {{$e}} </li>
@endforeach
</ul> --}}

<form method="POST" id="user-form"
    action="{{ isset($user) ? route('users.update', ['id' => $user->id]) : route('users.store') }}"
    enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name"><strong>Name : <span class="tx-danger">*</span></strong></label>
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror" required
                                    placeholder="Your name" value="{{isset($user) ? $user->name : old('name') }}">
                                @error('name')
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
                                <label for="email"><strong>Email : <span class="tx-danger">*</span></strong></label>
                                <input type="text" name="email" id="email"
                                    class="form-control @error('email') is-invalid @enderror" required
                                    placeholder="Your email" value="{{isset($user) ? $user->email : old('email') }}">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- @if(isset($user->id))
                    <a action="{{ isset($user) ? route('users.update', ['id' => $user->id]) : route('users.store') }}">
                        @else --}}
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
                    {{-- </a>
                    @endif --}}

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="status"><strong>Status : <span class="tx-danger">*</span></strong></label>
                            <select
                                class="form-control user-status-select{{ $errors->has('status') ? ' is-invalid' : '' }}"
                                id="status" name="status" required>
                                <option disabled selected value>Select Status</option>
                                @foreach($statuses as $status)
                                <option value="{{ $status }}" @if(isset($user) && $user->status == $status) selected
                                    @elseif(!isset($user) && $status == 'Active') selected @else @endif>{{ $status }}
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
                        <div class="col-md-4" style="padding-top:20px;">
                            <div class="form-group">
                                <label for="profile_picture"><strong>Upload your profile : </strong></label>
                                    <input type="file" name="profile_picture" id="profile_picture" class="form-control">
                                <br>
                                @if (isset($user->profile_picture))
                                {{-- <img src="/storage/users/{{ $user->id }}/profile_picture/{{ $user->profile_picture}}"
                                height="120px" width="120px"> --}}
                                @else
                                    <p>No image found</p>
                                @endif
                                    <input type="hidden" id="profile_picture_data64" name="profile_picture_data64">
                                @if (isset($user->profile_picture))
                                    <span>{{ $user->profile_picture }}</span>
                                @else
                                    <p></p>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-4" style="padding-top:20px;">
                            <div class="form-group">
                                <label for="profile_picture"><strong>Your Profile preview : </strong></label>
                                <div id="profile_picture-demo" style="width:350px" class="croppie-container">
                                </div>
                            </div>
                        </div>
                        @if (isset($user->profile_picture))
                        <input id="upload-demo-image" type="hidden"
                            value="/storage/users/{{ $user->id }}/profile_picture/{{ $user->profile_picture}}">
                        @else
                        <p></p>
                        @endif

                    </div>

                    <div class="form-group text-right">
                        <div class="button">
                            <a href="{{route('users.index')}}" class="btn btn-warning mg-r-1">Cancel</a>
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
