@extends('layouts.admin')
@section('title','Task Index')
@section('content')

<div class="row-index">
  
  {{-- For searching --}}
  <div class="search" style= "float : left;">
    <form action="/tasks" method="get">
      <div class="input-group">
        <input class="form-control" id="search" value placeholder="Search your task here" name="search" type="search" style="background-color: #f4f7fa;">
        <div class="input-group-btn">
          <button type="submit" class="btn btn-warning"><i class="fa fa-search" aria-hidden="true"></i></button>
        </div>
      </div>
    </form>
  </div>

  {{-- Filtering with category --}}
  <div class="filter">  
  <form action="/tasks" method="GET">
    <select class="form-control" id="category_id" name="category_id">
      <option disabled selected value >By Category</option>
      @foreach($categories as $category)
        <option value="{{ $category->id }}" @if(isset($task) && $task->category_id == $category->id) selected @endif>{{ $category->name }}
        </option>
      @endforeach
    </select>
  </div>

  {{-- For filtering with priority --}}
  <div class="filter">  
  <select class="form-control" id="priority_id" name="priority_id">
    <option disabled selected value >By Priority</option>
    @foreach($priorities as $priority)
      <option value="{{ $priority->id }}" @if(isset($task) && $task->priority_id == $priority->id) selected @endif>{{ $priority->name }}
      </option>
    @endforeach 
  </select>
  </div>

  {{-- Filtering with status --}}
  <div class="filter">  
  <select class="form-control" id="status" name="status">
    <option disabled selected value >By Status</option>
    @foreach($statuses  as $status)
      <option value="{{ $status }}" @if(isset($task) && $task->status == $status) selected @elseif(!isset($task) && $status == 'Active') selected @else @endif>{{ $status }}
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
  </form>

  {{-- For creating new records --}}
  <div class="button">
  <div class="form-group" style= "float : right;">
    <a class="btn btn-success" href="{{ route('tasks.create') }}" > <i class="icon ion-md-add"></i></a>     
  </div>
  </div> 

</div>{{-- Row-index end --}}
    
  <div class="card">
    <div class="card-body">
      <div class="bs-example container-fluid" data-example-id="striped-table">
        <table class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th style="text-align:center;">@sortablelink('id','Id')</th>
              <th style="text-align:center;">@sortablelink('details','Details')</th>
              <th style="text-align:center;">@sortablelink('category_id','Category')</th>
              <th style="text-align:center;">@sortablelink('priority_id','Priority')</th>
              <th style="text-align:center;">@sortablelink('status','Status')</th>
              <th style="text-align:center;color:#0168fa;">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($tasks as $task)
              <tr class = "text-center">
                <td>{{ $task->id }}</td>
                <td style="text-align:left;">{{ $task->details }}</td>
                <td>{{ $task->category->name }}</td>
                <td>{{ $task->priority->name }}</td> 
                <td>{{ $task->status }}</td>
                <td>
                  <a class = "btn" href="{{route('tasks.show',['id'=>$task->id])}}" >
                    <i class="fa fa-th-list xlarge"  style="color:RoyalBlue;" aria-hidden="true"></i>
                  </a>
                  <a class = "btn" href="{{route('tasks.edit',['id'=>$task->id])}}" >
                    <i class="far fa-edit" style="color:Green;" aria-hidden="true"></i>
                  </a>
                  <a class = "btn" href="{{route('tasks.destroy',['id'=>$task->id])}}" >
                    <i class="fa fa-trash" style="color:Red;" aria-hidden="true"></i>
                  </a>
                </td> 
              </tr>
            @endforeach
          </tbody>
        </table>
      </div> <!-- container-fluid -->
    </div><!-- card-body -->
  </div><!-- card -->
  
  <!-- For Pagination -->
  <div class="row">
  <div class="col-sm-12  pull-right">
  <ul class="pagination justify-content-center">
    {!! $tasks->appends(\Request::except('page'))->render() !!}
  </ul>
  </div>
  </div>

@endsection