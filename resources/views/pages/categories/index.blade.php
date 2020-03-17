@extends('layouts.admin')
@section('content')

@section('breadcrumb-link')
		<li class="breadcrumb-item active" aria-current="page">
			Categories
		</li>    
@endsection

<div class="row-index">
    {{-- For searching --}}
    <div class="search" style="float : left;">
        <form action="{{route('categories.index')}}" method="GET">
            <div class="input-group">
                <input class="form-control" id="search" value placeholder="Search Name" name="search" type="search">
                <div class="search-button">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-search"
                            aria-hidden="true"></i></button>
                </div>
            </div>
        </form>
    </div>

    {{-- Filtering with status --}}
    <div class="filter">
      <form action="{{route('categories.index')}}" method="GET">
        <select class="form-control" id="status" name="status">
            <option disabled selected value>By Status</option>
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
            <a class="btn btn-secondary" href="{{ route('categories.index') }}"> <i class="fas fa-redo"></i></a>
        </div>
    </div>
    </form>

    {{-- For creating new records --}}
    <div class="button">
        <div class="form-group" style="float : right;">
            <a class="btn btn-primary" href="{{ route('categories.create') }}"> <i class="icon ion-md-add"></i></a>
        </div>
    </div>
</div>

        <div class="bs-example container-fluid-1" data-example-id="striped-table">
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
                    <tr class="text-center">
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->status }}</td>
                        <td>
                            {{-- <a class = "btn" href="{{route('categories.show',['id'=>$category->id])}}" >
                            <i class="fa fa-th-list xlarge" style="color:RoyalBlue;" aria-hidden="true"></i>
                            </a> --}}
                            <a class="btn" href="{{route('categories.edit',['id'=>$category->id])}}">
                                <i class="far fa-edit" style="color:Green;" aria-hidden="true"></i>
                            </a>
                            <a class="btn" href="{{route('categories.destroy',['id'=>$category->id])}}">
                                <i class="fa fa-trash" style="color:Red;" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div> {{-- container-fluid-1 --}}

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
