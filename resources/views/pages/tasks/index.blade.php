@extends('layouts.admin')
@section('title','Task Index')
@section('content')

        <div class="row-index">
            {{-- For searching --}}
            <div class="search" style= "float : left;">
            <form action="/tasks" method="get">
                <div class="input-group">
                <input class="form-control" id="search" value placeholder="Search your task here" name="search" type="search">
                <div class="input-group-btn">
                    <button type="submit" class="btn btn-warning"><i class="fa fa-search" aria-hidden="true"></i></button>
                </div>
                </div>
            </form>
            </div>

            {{-- For filtering with yajra --}}
            
            {{-- <div class="col-sm-4 form-group pull-center">  
              <select class="form-control" onchange="form.submit()" name="priority">
                <option disabled selected value >Select Priority</option>
                <option value="Urgent">Urgent</option>
                <option value="High">High</option>
                <option value="Medium">Medium</option>
                <option value="Low">Low</option>
              </select>
            </div> --}}
            

            {{-- For creating new records --}}
            <div class="button">
            <div class="form-group" style= "float : right;">
              <a class="btn btn-success" href="{{ route('tasks.create') }}" > <i class="icon ion-md-add"></i></a>     
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
                    <td>{{ $task->details }}</td>
                    <td>{{ $task->category_name->name }}</td>
                    <td>{{ $task->priority_name->name }}</td> 
                    <td>{{ $task->status }}</td>
                    
                    <td>
                      {{-- <a class = "btn" href="{{route('tasks.show',['id'=>$task->id])}}" >
                        <i class="fa fa-th-list xlarge"  style="color:RoyalBlue;" aria-hidden="true"></i>
                      </a> --}}
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
        </div>
      </div><!-- card-body -->
      </div><!-- card -->
  
  </div>

  <!-- For Pagination -->
  <div class="row">
  <div class="col-sm-12  pull-right">
  <ul class="pagination justify-content-center">
          {!! $tasks->appends(\Request::except('page'))->render() !!}
  </ul>
  </div>
  </div>

@endsection