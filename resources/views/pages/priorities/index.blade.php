@extends('layouts.admin')
@section('title','Priority Index')
@section('content')

<div class="row-index">
    {{-- For searching --}}
    <div class="search" style="float : left;">
        <form action="/priorities" method="get">
            <div class="input-group">
                <input class="form-control" id="search" value placeholder="Search Name" name="search" type="search">
                <div class="input-group-btn">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"
                            aria-hidden="true"></i></button>
                </div>
            </div>
        </form>
    </div>

    {{-- Filtering with status --}}
    <div class="filter">
        <form action="/priorities" method="GET">
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
        <button class="btn btn-secondary" id="filter" name="filter" type="submit" style="float : left;"
            aria-hidden="true"><i class="fas fa-filter"></i>
        </button>
    </div>
    </div>
    {{-- To show Reset icon --}}
    <div class="filter-icon">
        <div class="form-group">
            <button class="btn btn-secondary" action="/priorities"><i class="fas fa-redo"></i>
            </button>
        </div>
    </div>
    </form>

    {{-- For creating new records --}}
    <div class="button">
        <div class="form-group" style="float : right;">
            <a class="btn btn-success" href="{{ route('priorities.create') }}"> <i class="icon ion-md-add"></i></a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="bs-example container-fluid" data-example-id="striped-table">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th style="text-align:center;color:#0168fa;">Id</th>
                        <th style="text-align:center;">@sortablelink('name','Priority Name')</th>
                        <th style="text-align:center;">@sortablelink('type','Type')</th>
                        <th style="text-align:center;">@sortablelink('time','Time')</th>
                        <th style="text-align:center;">@sortablelink('status','Status')</th>
                        <th style="text-align:center;color:#0168fa;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($priorities as $priority)
                    <tr class="text-center">
                        <td>{{ $priority->id }}</td>
                        <td>{{ $priority->name }}</td>
                        <td>{{ $priority->type }}</td>
                        <td>{{ $priority->time }}</td>
                        <td>{{ $priority->status }}</td>
                        <td>
                            {{-- <a class = "btn" href="{{route('priorities.show',['id'=>$priority->id])}}" >
                            <i class="fa fa-th-list xlarge" style="color:RoyalBlue;" aria-hidden="true"></i>
                            </a> --}}
                            <a class="btn" href="{{route('priorities.edit',['id'=>$priority->id])}}">
                                <i class="far fa-edit" style="color:Green;" aria-hidden="true"></i>
                            </a>
                            <a class="btn" href="{{route('priorities.destroy',['id'=>$priority->id])}}">
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
            {!! $priorities->appends(\Request::except('page'))->render() !!}
        </ul>
    </div>
</div>

@endsection
