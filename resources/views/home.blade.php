@extends('layouts.admin')
@section('content')

@section('breadcrumb-link')
		<li class="breadcrumb-item active" aria-current="page">
			Home
		</li>    
@endsection

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Welcome {{ Auth::user()->name }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are successfully logged in!
                    <br>
                    Now you can add your task to remind.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
