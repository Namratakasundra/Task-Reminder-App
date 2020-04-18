@extends('layouts.admin')
@section('content')

<h4>@if (isset($priority->name))
    @php($title = 'Edit Priority')
    @else
    @php($title = 'Create Priority')
    @endif
</h4>
@push('title', yieldTitle($title))

@section('breadcrumb-link')
<li class="breadcrumb-item active" aria-current="page">
    <a href="{{ route('priorities.index') }}">Priorities</a>
</li>
<li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
@endsection


    <form action="{{ isset($priority) ? route('priorities.update', ['id' => $priority->id]) : route('priorities.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name"><strong>Name : <span class="tx-danger">*</span></strong></label>
                                <input type="text" name="name" id="name" class="form-control" required
                                    placeholder="Your name"
                                    value="{{isset($priority) ? $priority->name : old('name') }}">

                                {{-- @foreach($priorities as $priority)
                        <label>
                        <input type="checkbox" value="{{$priority}}" name="name[]" class="checkbox">{{$priority}}
                                </label>
                                <br />
                                @endforeach --}}

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="time"><strong>Time : <span class="tx-danger">*</span></strong></label>
                                <input type="number" name="time" id="time" class="form-control" required
                                    placeholder="How long it will take?"
                                    value="{{isset($priority) ? $priority->time : old('time') }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="status"><strong>Status : <span class="tx-danger">*</span></strong></label>
                            <select
                                class="form-control priority-status-select{{ $errors->has('status') ? ' is-invalid' : '' }}"
                                id="status" name="status" required>
                                <option disabled selected value>Select Status</option>
                                @foreach($statuses as $status)
                                <option value="{{ $status }}" @if(isset($priority) && $priority->status == $status)
                                    selected @elseif(!isset($priority) && $status == 'Active') selected @else
                                    @endif>{{ $status }}
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
                            <a href="{{route('priorities.index')}}" class="btn btn-warning mg-r-1">Cancel</a>
                            <button type="submit" class="btn btn-success">
                                @if (isset($priority->name))
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
