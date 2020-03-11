@extends('layouts.admin')
@section('title','Category Index')
@section('content')

        <div class="row">         
            {{-- For searching --}}
            <div class="search" style= "float : left;">
                <form action="/categories" method="GET">
                    <div class="input-group">
                    <input class="form-control" id="search" value placeholder="Search Name" name="search" type="search">
                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-warning"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </div>
                    </div>
                </form>
            </div>

            {{-- For creating new records --}}
            <div class="button">
            <div class="form-group" style= "float : right;">
                <a class="btn btn-success" href="{{ route('categories.create') }}" > <i class="icon ion-md-add"></i></a>     
            </div>
            </div> 
        </div>
    
        <div class="card">
        <div class="card-body">
            <div class="bs-example container-fluid" data-example-id="striped-table">
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th style="text-align:center;">@sortablelink('id','Id')</th>
                <th style="text-align:center;">@sortablelink('name','Category Name')</th>
                <th style="text-align:center;">@sortablelink('status','Status')</th>
                <th style="text-align:center;color:#0168fa;">Actions</th>
              </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                  <tr class = "text-center">
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->status }}</td> 
                    <td>
                      {{-- <a class = "btn" href="{{route('categories.show',['id'=>$category->id])}}" >
                        <i class="fa fa-th-list xlarge"  style="color:RoyalBlue;" aria-hidden="true"></i>
                      </a> --}}
                      <a class = "btn" href="{{route('categories.edit',['id'=>$category->id])}}" >
                        <i class="far fa-edit" style="color:Green;" aria-hidden="true"></i>
                      </a>
                      <a class = "btn" href="{{route('categories.destroy',['id'=>$category->id])}}" >
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
          {!! $categories->appends(\Request::except('page'))->render() !!}
  </ul>
  </div>
  </div>

@endsection