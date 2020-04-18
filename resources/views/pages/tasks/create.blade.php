@extends('layouts.admin')
@section('content')

<h4>@if (isset($task->details))
    @php($title = 'Edit Task')
    @else
    @php($title = 'Create Task')
    @endif
</h4>
@push('title', yieldTitle($title))

@section('breadcrumb-link')
<li class="breadcrumb-item active" aria-current="page">
    <a href="{{ route('tasks.index') }}">Tasks</a>
</li>
<li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
@endsection

{{-- <ul>
    @foreach ($errors->all() as $e)
        <li> {{$e}} </li>
@endforeach
</ul> --}}

<form action="{{ isset($task) ? route('tasks.update', ['id' => $task->id]) : route('tasks.store') }}" method="POST"
    enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="details"><strong>Details : <span class="tx-danger">*</span></strong></label>
                                <input type="text" name="details" id="details" class="form-control" required
                                    placeholder="Your details"
                                    value="{{isset($task) ? $task->details : old('details') }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="category_id"><strong>Category : <span
                                            class="tx-danger">*</span></strong></label>
                                <select class="form-control task-category-select" id="category_id" name="category_id"
                                    required>
                                    <option disabled selected value>Select category</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @if(isset($task) && $task->category_id ==
                                        $category->id) selected @endif>{{ $category->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('category_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('category_id') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="priority_id"><strong>Priority : <span
                                            class="tx-danger">*</span></strong></label>
                                <select class="form-control task-priority-select" id="priority_id" name="priority_id"
                                    required>
                                    <option disabled selected value>Select priority</option>
                                    @foreach($priorities as $priority)
                                    <option value="{{ $priority->id }}" @if(isset($task) && $task->priority_id ==
                                        $priority->id) selected @endif>{{ $priority->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('priority_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('priority_id') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="status"><strong>Status : <span class="tx-danger">*</span></strong></label>
                            <select
                                class="form-control task-status-select{{ $errors->has('status') ? ' is-invalid' : '' }}"
                                id="status" name="status" required>
                                <option disabled selected value>Select Status</option>
                                @foreach($statuses as $status)
                                <option value="{{ $status }}" @if(isset($task) && $task->status == $status) selected
                                    @elseif(!isset($task) && $status == 'Pending') selected @else @endif>{{ $status }}
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

                    <div class="form-group text-right">
                        <div class="button">
                            <a href="{{route('tasks.index')}}" class="btn btn-warning mg-r-1">Cancel</a>
                            <button type="submit" class="btn btn-success">
                                @if (isset($task->details))
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
