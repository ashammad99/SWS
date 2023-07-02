@extends('layouts.master')
@section('css')
<!-- Internal Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<!--Internal  Datetimepicker-slider css -->
<link href="{{URL::asset('assets/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/pickerjs/picker.min.css')}}" rel="stylesheet">
<!-- Internal Spectrum-colorpicker css -->
<link href="{{URL::asset('assets/plugins/spectrum-colorpicker/spectrum.css')}}" rel="stylesheet">
@endsection
@section('title')
SWS - Users - Create
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
	<div class="my-auto">
		<div class="d-flex">
			<h4 class="content-title mb-0 my-auto">Users</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Create</span>
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
							<img alt="" src="{{URL::asset('assets/profile/'. $user->photo)}}">
						</div>
						<div class="d-flex justify-content-between mg-b-20">
							<div>
								<h5 class="main-profile-name">{{$user->name}}</h5>
								<p class="main-profile-name-text">Social Researcher</p>
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
							<a href="#settings" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="mdi mdi-account-plus k tx-16 mr-1"></i></span> <span class="hidden-xs">Edit User</span> </a>
						</li>
					</ul>
				</div>
				<div class="tab-content border-left border-bottom border-right border-top-0 p-4">
					<div class="tab-pane active" id="settings">
						<form action="{{route('users.updateRole',$user->id)}}" method="post" enctype="multipart/form-data">
							@csrf

                            <div class="form-group">
                                <label for="name_en">User Arabic Name</label>
                                <input type="text"  id="name_ar" name="name_ar" class="form-control" placeholder="Enter English Name" value="{{$user->name_ar}}">
                                @if($errors->has('name_ar'))
                                    <div class="error" style="color: red;">{{ $errors->first('name_ar') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="name_ar">User English Name</label>
                                <input type="text"  id="name_en" name="name_en" class="form-control" placeholder="Enter Arabic Name" value="{{$user->name_en}}">
                                @if($errors->has('name_en'))
                                    <div class="error" style="color: red;">{{ $errors->first('name_en') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="Email">Email</label>
                                <input type="email"  id="Email" name="email" class="form-control" value="{{$user->email}}" placeholder="Enter Email Address" >
                                @if($errors->has('email'))
                                    <div class="error" style="color: red;">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
							<div class="form-group">
								<label for="Username">Username</label>
								<input type="text"  id="Username" name="username" class="form-control" placeholder="Enter Username" value="{{$user->username}}">
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
							<div class="form-group">
								<div class="row row-sm">
									<div class="col-lg-4 mg-t-20 mg-lg-t-0">
										<p class="mg-b-10">Select User Role</p><select name="role" class="form-control select2">
											<option label="Choose one">
											</option>
											@foreach ($roles as $role)
											<option value="{{$role->id}}" @if($user->getRoleNames()->contains($role->name)) selected @endif>
												{{$role->name}}
											</option>
											@endforeach
										</select>
									</div><!-- col-4 -->
								</div>
								@if($errors->has('role'))
								<div class="error" style="color: red;">{{ $errors->first('role') }}</div>
								@endif
							</div>
							<div class="form-group">
								<label for="account">Account Status</label>
								<div class="col-lg-3 mg-t-20 mg-lg-t-0">
									<label class="ckbox"><input @if($user->status == 0) checked  @endif type="checkbox" name="status"><span>Disable</span></label>
								</div>
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
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!--Internal  jquery.maskedinput js -->
<script src="{{URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js')}}"></script>
<!--Internal  spectrum-colorpicker js -->
<script src="{{URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js')}}"></script>
<!-- Internal Select2.min js -->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!--Internal Ion.rangeSlider.min js -->
<script src="{{URL::asset('assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>
<!--Internal  jquery-simple-datetimepicker js -->
<script src="{{URL::asset('assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js')}}"></script>
<!-- Ionicons js -->
<script src="{{URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js')}}"></script>
<!--Internal  pickerjs js -->
<script src="{{URL::asset('assets/plugins/pickerjs/picker.min.js')}}"></script>
<!-- Internal form-elements js -->
<script src="{{URL::asset('assets/js/form-elements.js')}}"></script>
@endsection
