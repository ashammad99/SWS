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

	<div class="col-lg-8">
		<div class="card">
			<div class="card-body">
				<div class="tabs-menu ">
					<!-- Tabs -->
					<ul class="nav nav-tabs profile navtab-custom panel-tabs">
						<li class="active">
							<a href="#settings" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="mdi mdi-account-plus k tx-16 mr-1"></i></span> <span class="hidden-xs">Create User</span> </a>
						</li>
					</ul>
				</div>
				<div class="tab-content border-left border-bottom border-right border-top-0 p-4">
					<div class="tab-pane active" id="settings">
						<form action="{{route('users.store')}}" method="post" enctype="multipart/form-data">
							@csrf
							<div class="form-group">
								<label for="Email">Email</label>
								<input type="email"  id="Email" name="email" class="form-control" placeholder="Enter Email Address">
							</div>
							<div class="form-group">
								<label for="Username">English Name</label>
								<input type="text"  id="Username" name="name_en" class="form-control" placeholder="Enter English Name">
								@if($errors->has('name_en'))
								<div class="error" style="color: red;">{{ $errors->first('name_en') }}</div>
								@endif
							</div>
                            <div class="form-group">
                                <label for="Username">Arabic Name</label>
                                <input type="text"  id="Username" name="name_ar" class="form-control" placeholder="Enter Arabic Name">
                                @if($errors->has('name_ar'))
                                    <div class="error" style="color: red;">{{ $errors->first('name_ar') }}</div>
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
                                <label>Select Governorate:</label>
                                <select class="form-control select2-no-search" name="governorate_id"
                                        style="width: 100%">
                                    <option disabled selected value>-- select an option --</option>
                                    @foreach($govs as $governorate)
                                        <option
                                            value="{{$governorate->id}}">{{$governorate->gov_name_en}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('governorate_id'))
                                    <div class="error"
                                         style="color: red;">{{ $errors->first('governorate_id') }}</div>
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
											<option value="{{$role->id}}">
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
							<button class="btn btn-primary waves-effect waves-light w-md" type="submit">Create</button>
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
