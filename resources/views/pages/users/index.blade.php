@extends('layouts.admin')
@section('breadcrumb-link','Users')
@section('content')


<div class="row-index">       
  {{-- For searching --}}
  <div class="search" style= "float : left;">
    <form action="/user" method="get">
      <div class="input-group">
        <input class="form-control" id="search" value placeholder="Search Name" name="search" type="search">
        <div class="input-group-btn">
          <button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i></button>
        </div>
      </div>
    </form>
  </div>

  {{-- Filtering with status --}}
  <div class="filter">  
    <form action="/user" method="GET">
      <select class="form-control" id="status" name="status">
        <option disabled selected value >By Status</option>
        @foreach($statuses as $status)
          <option value="{{ $status }}" @if(isset($request_status) && $request_status == $status) selected
            @endif>{{ $status }}
          </option>
        @endforeach
      </select>
  </div>
      {{-- To show Filter icon --}}
      <div class="filter-icon">
      <div class="form-group">
        <button class="btn btn-secondary" id="filter" name="filter" type="submit" style="float : left;" aria-hidden="true"><i class="fas fa-filter"></i>
        </button>
      </div>
      </div>
      {{-- To show Reset icon --}}
      <div class="filter-icon">
        <div class="form-group">
            <a class="btn btn-secondary" href="{{ route('users.index') }}"> <i class="fas fa-redo"></i></a>
        </div>
      </div>
    </form>
  

  {{-- For creating new records --}}
  <div class="button">
  <div class="form-group" style= "float : right;">
    <a class="btn btn-primary" href="{{ route('users.create') }}" > <i class="icon ion-md-add"></i></a>     
  </div>
  </div>
</div>{{-- row-index end --}}
      
        <div class="card">
        <div class="card-body">
          <div class="bs-example container-fluid" data-example-id="striped-table">
          <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th style="text-align:center;color:#0168fa;">Id</th>
                  <th style="text-align:center;">@sortablelink('name','Name')</th>
                  <th style="text-align:center;color:#0168fa;">Email</th>
                  <th style="text-align:center;">@sortablelink('status','Status')</th>
                  <th style="text-align:center;color:#0168fa;">Profile Picture</th>
                  <th style="text-align:center;color:#0168fa;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                  <tr class = "text-center">
                    <td>{{ $user->id }}</td>
                    <td style="text-align:left;">{{ $user->name }}</td>
                    <td style="text-align:left;">{{ $user->email }}</td>
                    <td>{{ $user->status }}</td> 
                    <td>
                      <img src="/storage/users/{{ $user->id }}/profile_picture/{{ $user->profile_picture}}" height="60px" width="60px" class="rounded-circle">
                    <td>
                      <a class = "btn" href="{{route('users.show',['id'=>$user->id])}}" >
                        <i class="fa fa-th-list xlarge"  style="color:RoyalBlue;" aria-hidden="true"></i>
                      </a>
                      <a class = "btn" href="{{route('users.edit',['id'=>$user->id])}}" >
                        <i class="far fa-edit" style="color:Green;" aria-hidden="true"></i>
                      </a>
                      <a class = "btn" onclick="return confirm('Are you sure?')" href="{{route('users.destroy',['id'=>$user->id])}}" >
                        <i class="fa fa-trash" style="color:Red;" aria-hidden="true"></i>
                      </a>
                    </td> 
                  </tr>
                @endforeach
            </tbody>
            
          </table>
        </div>
      </div><!-- card-body -->
      </div><!-- card -->
  
  </div>

  <!-- For Pagination -->
  <div class="row">
  <div class="col-sm-12  pull-right">
  <ul class="pagination justify-content-center">
          {!! $users->appends(\Request::except('page'))->render() !!}
  </ul>
  </div>
  </div>

@endsection