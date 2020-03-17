@extends('layouts.admin')
@section('content')

<h4>@if (isset($category->name))
    @php($title = 'Edit Category')
    @else
    @php($title = 'Create Category')
    @endif
</h4>
@push('title', yieldTitle($title))

@section('breadcrumb-link')
		<li class="breadcrumb-item active" aria-current="page">
			<a href="{{ route('categories.index') }}">Categories</a>
		</li>    
		<li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
@endsection
  
    <form  action="{{ isset($category) ? route('categories.update', ['id' => $category->id]) : route('categories.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="card">
        <div class="card-body">
        <div class="table-responsive">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-4">
                <div class="form-group">
                    <label for="name"><strong>Name : <span class="tx-danger">*</span></strong></label>
                    <input type="text" name = "name" id = "name" class="form-control" required placeholder="Your name" value="{{isset($category) ? $category->name : old('name') }}" >
                </div>
                </div>
 
                <div class="form-group col-md-4">
                    <label for="status"><strong>Status : <span class="tx-danger">*</span></strong></label>
                        <select class="form-control category-status-select{{ $errors->has('status') ? ' is-invalid' : '' }}" id="status" name="status" required>
                            <option disabled selected value>Select Status</option>
                            @foreach($statuses  as $status)
                                <option value="{{ $status }}" @if(isset($category) && $category->status == $status) selected @elseif(!isset($category) && $status == 'Active') selected @else @endif>{{ $status }}
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
                    <a href="{{route('categories.index')}}" class="btn btn-warning mg-r-1">Cancel</a>
                    <button type="submit" class="btn btn-success">@if(isset($category->name))       
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

               