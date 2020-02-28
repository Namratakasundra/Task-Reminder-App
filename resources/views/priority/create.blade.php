@extends('layouts.admin')
@section('title','Create Priority')
@section('content')
  

    <form  action="{{ isset($priority) ? route('priority.update', ['id' => $priority->id]) : route('priority.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="card">
        <div class="card-body">
        <div class="table-responsive">
        <div class="container-fluid">

                <div class="col-md-6">
                <div class="form-group">
                    <label for="name"><strong>Name : <span class="tx-danger">*</span></strong></label>
                    <input type="text" name = "name" id = "name" class="form-control" required placeholder="Your name" value="{{isset($priority) ? $priority->name : old('name') }}" >

                    {{-- @foreach($priorities as $priority)
                        <label>
                        <input type="checkbox" value="{{$priority}}" name="name[]" class="checkbox">{{$priority}}
                        </label>
                    <br/>
                    @endforeach --}}

                </div>
                </div>

                <div class="form-group col-md-6">
                    <label for="type"><strong>Type : <span class="tx-danger">*</span></strong></label>
                    <select class="form-control priority-type-select{{ $errors->has('type') ? ' is-invalid' : '' }}" id="type" name="type" required>
                        <option disabled selected value>Select Type</option>
                        @foreach($types  as $type)
                            <option value="{{ $type }}" @if(isset($priority) && $priority->type == $type) selected @elseif(!isset($priority) && $type == 'Timebased') selected @else @endif>{{ $type }}
                            </option> 
                        @endforeach
                    </select>
                    @if ($errors->has('type'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('type') }}</strong>
                    </span>
                    @endif
                </div>
                
                <div class="col-md-6">
                <div class="form-group">
                    <label for="time"><strong>Time : <span class="tx-danger">*</span></strong></label>
                    <input type="number" name = "time" id = "time" class="form-control" required placeholder="How long it will take?" value="{{isset($priority) ? $priority->time : old('time') }}" >
                </div>
                </div>
                
                <div class="form-group col-md-6">
                    <label for="status"><strong>Status : <span class="tx-danger">*</span></strong></label>
                    <select class="form-control priority-status-select{{ $errors->has('status') ? ' is-invalid' : '' }}" id="status" name="status" required>
                        <option disabled selected value>Select Status</option>
                        @foreach($statuses  as $status)
                            <option value="{{ $status }}" @if(isset($priority) && $priority->status == $status) selected @elseif(!isset($priority) && $status == 'Active') selected @else @endif>{{ $status }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('status'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('status') }}</strong>
                    </span>
                    @endif
                </div>
                       
                <div class="form-group text-right">
                <div class="button">
                    <a href="/priority" class="btn btn-warning mg-r-1">Cancel</a>
                    <button type="submit" class="btn btn-success">@if (isset($priority->name))       
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

               