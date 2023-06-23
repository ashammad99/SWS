@extends('layouts.master')
@section('title')
SWS - Perimissions Create
@stop
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Users</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Perimissions /
                    Create Perimission</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
            <div class="card  box-shadow-0 ">
                <div class="card-header">
                    <h4 class="card-title mb-1">Create Perimission</h4>
                </div>
                <div class="card-body pt-0">
                    <form method="post" action="{{route('perimissions.store')}}">
						@csrf
                        <div class="">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Perimission Name</label>
                                <input type="text" class="form-control" name="name"
                                    placeholder="Enter Perimission">
									@if($errors->has('name'))
									<div class="error" style="color: red;">{{ $errors->first('name') }}</div>
									@endif
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Perimission Note</label>
                                <textarea placeholder="Define Permission" name="note" class="form-control" cols="30" rows="10"></textarea>
									@if($errors->has('note'))
									<div class="error" style="color: red;">{{ $errors->first('note') }}</div>
									@endif
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3 mb-0">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
@endsection
