@extends('layouts.admin')
@section('title','User Index')
@section('content')

        <div class="row">
            {{-- For searching --}}
            <div class="col-sm-4 form-group pull-left" >
            <form action="/search_user" method="get">
                <div class="input-group">
                <input class="form-control" id="search" value placeholder="Search Name" name="search" type="search">
                <div class="input-group-btn">
                    <button type="submit" class="btn btn-warning"><i class="fa fa-search" aria-hidden="true"></i></button>
                </div>
                </div>
            </form>
            </div>

            {{-- For creating new records --}}
            <div class="col-sm-8 form-group pull-right">
              <a class="btn btn-success" href="{{ route('users.create') }}" > <i class="icon ion-md-add"></i></a>     
            </div>
        </div>
    
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
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->status }}</td> 
                    <td>
                      <img src="/storage/users/{{ $user->id }}/profile_picture/{{ $user->profile_picture}}" height="70px" width="70px" class="rounded-circle">
                    <td>
                      {{-- <a class = "btn" href="{{route('users.show',['id'=>$user->id])}}" >
                        <i class="fa fa-th-list xlarge"  style="color:RoyalBlue;" aria-hidden="true"></i>
                      </a> --}}
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