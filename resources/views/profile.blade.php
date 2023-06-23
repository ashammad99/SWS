@extends('layouts.master')
@section('css')
@endsection
@section('title')
    SWS - Profile
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Users</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Profile</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">
        <div class="col-lg-4">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="pl-0">
                        <div class="main-profile-overview">
                            <div class="main-img-user profile-user">
                                <img alt="" src="{{URL::asset('assets/profile/'.Auth::user()->photo)}}">
                            </div>
                            <div class="d-flex justify-content-between mg-b-20">
                                <div>
                                    <h5 class="main-profile-name">{{Auth::user()->sr_name_en}}</h5>
                                    <p class="main-profile-name-text">Social Researcher</p>
                                    <hr>
                                    <h6 class="main-profile-name-text">Number of the Beneficiaries: </h6>
                                    <h5 class="main-profile-name">{{$beneficiaries->count()}}</h5>
                                </div>
                            </div>
                        </div><!-- main-profile-overview -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="tabs-menu ">
                        <!-- Tabs -->
                        <ul class="nav nav-tabs profile navtab-custom panel-tabs">
                            <li class="active">
                                <a href="#settings" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="las la-cog tx-16 mr-1"></i></span> <span class="hidden-xs">SETTINGS</span> </a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content border-left border-bottom border-right border-top-0 p-4">
                        <div class="tab-pane active" id="settings">
                            <form action="{{route('profile.update',['id'=> Auth::user()->sr_id])}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="Email">Email</label>
                                    <input type="email"  id="Email" name="email" class="form-control" value="{{$user->email}}" placeholder="Enter Email Address" >
                                    @if($errors->has('email'))
                                        <div class="error" style="color: red;">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="name_en">User Arabic Name</label>
                                    <input type="text"  id="name_en" name="name_ar" class="form-control" placeholder="Enter English Name" value="{{$user->sr_name_ar}}">
                                    @if($errors->has('name_en'))
                                        <div class="error" style="color: red;">{{ $errors->first('name_en') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="name_ar">User English Name</label>
                                    <input type="text"  id="name_ar" name="name_en" class="form-control" placeholder="Enter Arabic Name" value="{{$user->sr_name_en}}">
                                    @if($errors->has('name_ar'))
                                        <div class="error" style="color: red;">{{ $errors->first('name_ar') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="Username">Username</label>
                                    <input  readonly type="text"  id="Username" name="username" class="form-control" placeholder="Enter Username" value="{{$user->username}}">
                                    @if($errors->has('username'))
                                        <div class="error" style="color: red;">{{ $errors->first('username') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="Password">Password</label>
                                    <input type="password" placeholder="at least 8 Characters" name="password" id="Password" class="form-control">
                                    @if($errors->has('password'))
                                        <div class="error" style="color: red;">{{ $errors->first('password') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="RePassword">Photo</label>
                                    <input type="file" id="photo" name="photo" class="form-control">
                                    @if($errors->has('photo'))
                                        <div class="error" style="color: red;">{{ $errors->first('photo') }}</div>
                                    @endif
                                </div>
                                <button class="btn btn-primary waves-effect waves-light w-md" type="submit">Save</button>
                            </form>
                        </div>
                    </div>
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
