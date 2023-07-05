@extends('layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('title')
    Create Child
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Forms</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Form-wizards</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-info btn-icon ml-2"><i class="mdi mdi-filter-variant"></i></button>
            </div>
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-danger btn-icon ml-2"><i class="mdi mdi-star"></i></button>
            </div>
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-warning  btn-icon ml-2"><i class="mdi mdi-refresh"></i></button>
            </div>
            <div class="mb-3 mb-xl-0">
                <div class="btn-group dropdown">
                    <button type="button" class="btn btn-primary">14 Aug 2019</button>
                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                            id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuDate"
                         data-x-placement="bottom-end">
                        <a class="dropdown-item" href="#">2015</a>
                        <a class="dropdown-item" href="#">2016</a>
                        <a class="dropdown-item" href="#">2017</a>
                        <a class="dropdown-item" href="#">2018</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @php

        do {
   $generated_code = rand(350000, 1000000);
} while (\App\Models\ChildIdentification::where("child_code", "=", $generated_code)->first());

    @endphp
        <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('child.store')}}" method="post" id="wizard1" enctype="multipart/form-data">
                        @csrf
                        <h3></h3>
                        <section href="#child_identification">
                            <h2 style="background: #dde2ef;padding:7px">Child Identification</h2>
                            <br>
                            <div class="row row-xs">
                                <div class="form-group">
                                    <label for="child_code" class="">Child Code</label>
                                    <input type="number" id="child_code"  readonly name="child_code"

                                           placeholder="Child Code" value="{{$generated_code}}"
                                           class="form-control border-dark @error('child_code') is-invalid @enderror"
                                    >
                                    @if($errors->has('child_code'))
                                        <div class="error"
                                             style="color: red;">{{ $errors->first('child_code') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="child_id_no" class="">Child ID</label>
                                    <input type="number" id="child_id_no" name="child_id_no"
                                           class="form-control border-dark  @error('child_id_no') is-invalid @enderror">
                                    @if($errors->has('child_id_no'))
                                        <div class="error" style="color: red;">{{ $errors->first('child_id_no') }}</div>
                                    @endif
                                </div>
                                <!-- div class="form-check form-check-inline" style="margin-left: 10%">
                                    <h5 class="form-check-label" for="is_vip">is vip&nbsp;&nbsp;&nbsp;</h5>
                                    <input class="form-check-input" type="checkbox" name="is_vip" id="is_vip" value="1">
                                </div-->
                                <div class="col-lg-5">
                                    <p class="mg-b-10">Select Category</p>
                                    <select class="form-control select2-no-search"
                                            name="category">
                                        <option disabled selected value> -- select an option --</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category}}">{{$category}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('category'))
                                        <div class="error" style="color: red;">{{ $errors->first('category') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="row row-xs">
                                <div class="col-md-5">
                                    <label for="child_fullName_en">Child English Name</label>
                                    <input type="text" id="child_fullName_en" name="child_fullName_en"
                                           placeholder="Child English Name"
                                           class="form-control border-dark @error('child_fullName_en') is-invalid @enderror">
                                    @if($errors->has('child_fullName_en'))
                                        <div class="error"
                                             style="color: red;">{{ $errors->first('child_fullName_en') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-5 mg-t-10 mg-md-t-0">
                                    <label for="child_fullName_ar">Child Arabic Name</label>
                                    <input type="text" id="child_fullName_ar" name="child_fullName_ar"
                                           placeholder="Child Arabic Name"
                                           class="form-control border-dark @error('child_fullName_ar') is-invalid @enderror">
                                    @if($errors->has('child_fullName_ar'))
                                        <div class="error"
                                             style="color: red;">{{ $errors->first('child_fullName_ar') }}</div>
                                    @endif
                                </div>
                            </div>
                            <br>
                            <div class="row row-xs">
                                <div class="col-md-5">
                                    <h6>Gender: </h6>
                                    <div class="form-group" style="margin-left: 10%">
                                        <input type="radio" id="male" name="gender" value="Male">
                                        <label for="male">Male</label>
                                        <br>
                                        <input type="radio" id="female" name="gender" value="Female">
                                        <label for="female">Female</label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <p class="mg-b-10">Select Scale Of Poverty: </p><select
                                        class="form-control select2-no-search" name="scale_of_poverty">
                                        <option disabled selected value> -- select an option --</option>
                                        @foreach($scales as $scale)
                                            <option value="{{$scale}}">{{$scale}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('scale_of_poverty'))
                                        <div class="error"
                                             style="color: red;">{{ $errors->first('scale_of_poverty') }}</div>
                                    @endif
                                </div><!-- col-4 -->
                            </div>
                            <div class="row row-xs">
                                <div class="col-lg-5">
                                    <p class="mg-b-10">&nbsp;</p>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                Child DoB:
                                            </div>
                                        </div>
                                        <input class="form-control " name="birth_date" id="dateMask2"
                                               type="date"
                                               @error('birth_date') is-invalid @enderror">
                                        @if($errors->has('birth_date'))
                                            <div class="error"
                                                 style="color: red;">{{ $errors->first('birth_date') }}</div>
                                        @endif
                                    </div><!-- input-group -->

                                </div><!-- col-4 -->
                                <div class="col-md-5 mg-t-10 mg-md-t-0">
                                    <label for="sponsorship_category">Sponsorship Category</label>
                                    <input type="text" id="sponsorship_category" name="sponsorship_category"
                                           placeholder="Sponsorship Category"
                                           class="form-control border-dark @error('sponsorship_category') is-invalid @enderror">
                                    @if($errors->has('sponsorship_category'))
                                        <div class="error"
                                             style="color: red;">{{ $errors->first('sponsorship_category') }}</div>
                                    @endif
                                </div>
                                <div class="col-lg-5">
                                    <p class="mg-b-10">&nbsp;</p>
                                    <!--div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                No. Siblings
                                            </div>
                                        </div>
                                        <input class="form-control" name="NO_SPONSORED" id="dateMask"
                                               type="number">
                                    </div-->
                                </div>
                                <br>
                                <div class="row row-xs">
                                    <!-- input-group -->
                                </div><!-- col-4 -->
                            </div>
                            <br>
                            <div class="row row-xs">
                                <div class="form-check form-check-inline" style="">
                                    <b><label class="form-check-label"
                                              for="has_disability">has Disability?&nbsp;&nbsp;&nbsp;</label></b>
                                    <input type="checkbox" id="has_disability" name="has_disability" value="1" onclick="showDisabilityTypeInput()"
                                           @error('has_disability') is-invalid @enderror">
                                    @if($errors->has('has_disability'))
                                        <div class="error"
                                             style="color: red;">{{ $errors->first('has_disability') }}</div>
                                    @endif
                                </div>
                                <div id="disability_div" style="display: none" class="col-md-8">
                                    <label for="disability_type">Disability Type</label>
                                    <input type="text" id="disability_type" name="disability_type"
                                           placeholder="Type Disability type here.."
                                           class="form-control border-dark @error('disability_type') is-invalid @enderror">
                                    @if($errors->has('disability_type'))
                                        <div class="error"
                                             style="color: red;">{{ $errors->first('disability_type') }}</div>
                                    @endif
                                </div>
                            </div>
                            <br>
                            <br>
                            <h2 style="background: #dde2ef;padding:7px">Father Information</h2>
                            <br>
                            <div class="row row-xs">
                                <div class="col-md-5">
                                    <label for="father_fullName_en">Father Name English</label>
                                    <input type="text" id="father_fullName_en" name="father_fullName_en"
                                           placeholder="Father English Name"
                                           class="form-control border-dark @error('father_fullName_en') is-invalid @enderror">
                                    @if($errors->has('father_fullName_en'))
                                        <div class="error"
                                             style="color: red;">{{ $errors->first('father_fullName_en') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-5 mg-t-10 mg-md-t-0">
                                    <label for="father_fullName_ar">Father Name Arabic</label>
                                    <input type="text" id="father_fullName_ar" name="father_fullName_ar"
                                           placeholder="Father Name Arabic"
                                           class="form-control border-dark @error('father_fullName_ar') is-invalid @enderror">
                                    @if($errors->has('father_fullName_ar'))
                                        <div class="error"
                                             style="color: red;">{{ $errors->first('father_fullName_ar') }}</div>
                                    @endif
                                </div>
                            </div>

                            <br>
                            <div class="row row-xs">
                                <div class="form-group col-lg-3">
                                    <label for="father_id_no" class="">Father ID</label>
                                    <input type="number" id="father_id_no" name="father_id_no"
                                           class="form-control border-dark  @error('father_id_no') is-invalid @enderror">
                                    @if($errors->has('father_id_no'))
                                        <div class="error"
                                             style="color: red;">{{ $errors->first('father_id_no') }}</div>
                                    @endif
                                </div>&emsp;&emsp;&emsp;
                                <div id="father_death_div" class="col-lg-5">
                                    <p class="mg-b-10">&nbsp;</p>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                father death date
                                            </div>
                                        </div>
                                        <input class="form-control" name="death_date" id="dateMask1"
                                               placeholder="DD/MM/YYYY" type="date">

                                    </div><!-- input-group -->
                                </div><!-- col-4 -->
                            </div>
                            <br>
                            <br>
                            <h2 style="background: #dde2ef;padding:7px">Mother Information</h2>
                            <div class="row row-xs">
                                <div class="col-md-5">
                                    <label for="mother_fullName_en">Mother Name English</label>
                                    <input type="text" id="mother_fullName_en" name="mother_fullName_en"
                                           placeholder="Mother English Name"
                                           class="form-control border-dark @error('mother_fullName_en') is-invalid @enderror">
                                    @if($errors->has('mother_fullName_en'))
                                        <div class="error"
                                             style="color: red;">{{ $errors->first('mother_fullName_en') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-5 mg-t-10 mg-md-t-0">
                                    <label for="mother_fullName_ar">Mother Name Arabic</label>
                                    <input type="text" id="mother_fullName_ar" name="mother_fullName_ar"
                                           placeholder="Mother Name Arabic"
                                           class="form-control border-dark @error('mother_fullName_ar') is-invalid @enderror">
                                    @if($errors->has('mother_fullName_ar'))
                                        <div class="error"
                                             style="color: red;">{{ $errors->first('father_fullName_ar') }}</div>
                                    @endif
                                </div>
                            </div>
                            <br>
                            <div class="row row-xs">
                                <div class="form-group col-lg-3">
                                    <label for="mother_id_no" class="">Mother ID</label>
                                    <input type="number" id="mother_id_no" name="mother_id_no"
                                           class="form-control border-dark @error('mother_id_no') is-invalid @enderror">
                                    @if($errors->has('mother_id_no'))
                                        <div class="error"
                                             style="color: red;">{{ $errors->first('mother_id_no') }}</div>
                                    @endif
                                </div>&emsp;&emsp;&emsp;
                                <br>
                                <div class="col-md-5 mb-3">
                                    <br>
                                    <label>Select Marital Status:&emsp;</label>
                                    <select class="form-control select2-no-search" name="mother_martial_status"
                                            style="width: 150px">
                                        <option disabled selected value> -- select an option --</option>
                                        @foreach($mother_martial_status as $status)
                                            <option
                                                value="{{$status}}">{{$status}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('mother_martial_status'))
                                        <div class="error"
                                             style="color: red;">{{ $errors->first('mother_martial_status') }}</div>
                                    @endif
                                </div>
                            </div>

                        </section>

                        <h3></h3>
                        {{--
                        <section>
                            <br>
                            <h2 style="background: #dde2ef;padding:7px">Guardian Information</h2>
                            <br>
                            <div class="row row-xs">
                                <div class="col-md-5">
                                    <label for="guardian_fullName_en">Guardian Name English</label>
                                    <input type="text" id="guardian_fullName_en" name="guardian_fullName_en"
                                           placeholder="Guardian English Name"
                                           class="form-control @error('guardian_fullName_en') is-invalid @enderror">
                                    @if($errors->has('guardian_fullName_en'))
                                        <div class="error"
                                             style="color: red;">{{ $errors->first('guardian_fullName_en') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-5 mg-t-10 mg-md-t-0">
                                    <label for="guardian_fullName_ar">Guardian Name Arabic</label>
                                    <input type="text" id="guardian_fullName_ar" name="guardian_fullName_ar"
                                           placeholder="Guardian Name Arabic"
                                           class="form-control @error('guardian_fullName_ar') is-invalid @enderror">
                                    @if($errors->has('guardian_fullName_ar'))
                                        <div class="error"
                                             style="color: red;">{{ $errors->first('guardian_fullName_ar') }}</div>
                                    @endif
                                </div>
                            </div>
                            <br>
                            <div class="row row-xs">
                                <div class="col-md-5 mb-4">
                                    <p class="mg-b-10">Relation of Guardian to child En:</p><select
                                        style="width: 150px"
                                        class="form-control select2"
                                        name="rel_to_en"
                                    >
                                        <option disabled selected value> -- select an option --</option>
                                        @foreach($relationsEN as $relation)
                                            <option value="{{$relation}}">{{$relation}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('rel_to_en'))
                                        <div class="error" style="color: red;">{{ $errors->first('rel_to_en') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-5 mb-4">
                                    <p class="mg-b-10">Relation of Guardian to child Ar:</p>
                                    <select
                                        name="rel_to_ar"
                                        style="width: 150px"
                                        class="form-control select2 ">
                                        <option disabled selected value> -- select an option --</option>
                                        @foreach($relationsAr as $relation)
                                            <option value="{{$relation}}">{{$relation}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('rel_to_ar'))
                                        <div class="error" style="color: red;">{{ $errors->first('rel_to_ar') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="row row-xs">
                                <div class="form-group col-lg-3">
                                    <label for="guardian_id_no" class="">Guardian ID</label>
                                    <input type="number" id="guardian_id_no" name="guardian_id_no"
                                           class="form-control  @error('guardian_id_no') is-invalid @enderror">
                                    @if($errors->has('guardian_id_no'))
                                        <div class="error"
                                             style="color: red;">{{ $errors->first('guardian_id_no') }}</div>
                                    @endif
                                </div>&emsp;&emsp;
                                <div class="form-group col-lg-3">
                                    <p class="mg-b-10">Select Martial Status</p>
                                    <select
                                        name="guardian_martial_status"
                                        style="width: 150px"
                                        class="form-control select2 ">
                                        <option disabled selected value> -- select an option --</option>
                                        @foreach($guardian_martial_status as $status)
                                            <option value="{{$status}}">{{$status}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('guardian_martial_status'))
                                        <div class="error"
                                             style="color: red;">{{ $errors->first('guardian_martial_status') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-lg-3">
                                    <p class="mg-b-10">Select Work</p>
                                    <select
                                        name="work"
                                        style="width: 150px"
                                        class="form-control select2 ">
                                        <option disabled selected value> -- select an option --</option>
                                        @foreach($works as $work)
                                            <option value="{{$work}}">{{$work}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('work'))
                                        <div class="error" style="color: red;">{{ $errors->first('work') }}</div>
                                    @endif
                                </div>
                            </div>
                            <br>
                            <div class="row row-xs">
                                <div class="form-group col-lg-3">
                                    <p class="mg-b-10">Select Education Level</p>
                                    <select
                                        name="edu_level"
                                        style="width: 150px"
                                        class="form-control select2 ">
                                        <option disabled selected value> -- select an option --</option>
                                        @foreach($edu_levels as $edu_level)
                                            <option value="{{$edu_level}}">{{$edu_level}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('edu_level'))
                                        <div class="error" style="color: red;">{{ $errors->first('edu_level') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-lg-3">
                                    <p class="mg-b-10">Select Monthly Salary</p>
                                    <select
                                        name="monthly_salary"
                                        style="width: 150px"
                                        class="form-control select2 ">
                                        <option disabled selected value> -- select an option --</option>
                                        @foreach($monthly_salary as $salary)
                                            <option value="{{$salary}}">{{$salary}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('monthly_salary'))
                                        <div class="error"
                                             style="color: red;">{{ $errors->first('monthly_salary') }}</div>
                                    @endif
                                </div>
                            </div>
                            <br>
                            <div class="row-xs">
                                <br>
                                <div class="row row-xs">
                                    <div class="form-group col-lg-3">
                                        <label for="mobile_1" class="">Phone Number 1:</label>
                                        <input type="number" id="mobile_1" name="mobile_1"
                                               class="form-control  @error('mobile_1') is-invalid @enderror">
                                        @if($errors->has('mobile_1'))
                                            <div class="error"
                                                 style="color: red;">{{ $errors->first('mobile_1') }}</div>
                                        @endif
                                    </div>&emsp;&emsp;&emsp;
                                    <div class="form-group col-lg-3">
                                        <label for="mobile_2" class="">Phone Number 2:</label>
                                        <input type="number" id="mobile_2" name="mobile_2"
                                               class="form-control  @error('mobile_2') is-invalid @enderror">
                                        @if($errors->has('mobile_2'))
                                            <div class="error"
                                                 style="color: red;">{{ $errors->first('mobile_2') }}</div>
                                        @endif
                                    </div>&emsp;&emsp;&emsp;
                                    <div class="form-group col-lg-3">
                                        <label for="phone_no" class="">Telephone No:</label>
                                        <input type="number" id="phone_no" name="phone_no"
                                               class="form-control  @error('phone_no') is-invalid @enderror">
                                        @if($errors->has('phone_no'))
                                            <div class="error"
                                                 style="color: red;">{{ $errors->first('phone_no') }}</div>
                                        @endif
                                    </div>&emsp;&emsp;&emsp;
                                    <div class="row row-xs">
                                        <div class="col-md-12 mb-3">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label>Select Governorate:</label>
                                                    <select class="form-control select2-no-search" name="governorate_id"
                                                            style="width: 100%">
                                                        <option disabled selected value>-- select an option --</option>
                                                        @foreach($governates as $governorate)
                                                            <option
                                                                value="{{$governorate->id}}">{{$governorate->gov_name_en}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('governorate_id'))
                                                        <div class="error"
                                                             style="color: red;">{{ $errors->first('governorate_id') }}</div>
                                                    @endif
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label>Select Area:</label>
                                                    <select class="form-control select2" name="area_id"
                                                            style="width: 100%">
                                                        <option disabled selected value>-- select an option --</option>
                                                        @foreach($areas as $area)
                                                            <option
                                                                value="{{$area->id}}">{{$area->area_name_en}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('area_id'))
                                                        <div class="error"
                                                             style="color: red;">{{ $errors->first('area_id') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row row-xs">
                                    <div class="form-group col-lg-6">
                                        <label for="email" class="">Email Address</label>
                                        <input type="email" id="email" name="email"
                                               class="form-control  @error('email') is-invalid @enderror">
                                        @if($errors->has('email'))
                                            <div class="error"
                                                 style="color: red;">{{ $errors->first('email') }}</div>
                                        @endif
                                    </div>&emsp;&emsp;&emsp;
                                </div>
                                <div class="control-group form-group mb-0">
                                    <label class="form-label">Address</label>
                                    <input type="text" id="address_details" name="address_details"
                                           class="form-control required"
                                           placeholder="Address">
                                    @if($errors->has('address_details'))
                                        <div class="error"
                                             style="color: red;">{{ $errors->first('address_details') }}</div>
                                    @endif
                                </div>
                            </div>

                        </section>

                        <h3></h3>
                        <section>
                            <br>
                            <h2 style="background: #dde2ef;padding:7px">Family Configuration</h2>
                            <div class="row row-xs">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="members_count" class="col-form-label col-md-6">Number of
                                                Family's Members</label>
                                            <div class="col-md-6">
                                                <input type="number" id="members_count" name="members_count"
                                                       class="form-control @error('members_count') is-invalid @enderror">
                                                @if($errors->has('members_count'))
                                                    <div class="invalid-feedback"
                                                         style="color: red;">{{ $errors->first('members_count') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row row-xs">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="members_university" class="col-form-label col-md-6">Members in
                                                Universities</label>
                                            <div class="col-md-6">
                                                <input type="number" id="members_university" name="members_university"
                                                       class="form-control @error('members_university') is-invalid @enderror">
                                                @if($errors->has('members_university'))
                                                    <div class="invalid-feedback"
                                                         style="color: red;">{{ $errors->first('members_university') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row row-xs">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="members_school" class="col-form-label col-md-6">Members in
                                                Schools</label>
                                            <div class="col-md-6">
                                                <input type="number" id="members_school" name="members_school"
                                                       class="form-control @error('members_school') is-invalid @enderror">
                                                @if($errors->has('members_school'))
                                                    <div class="invalid-feedback"
                                                         style="color: red;">{{ $errors->first('members_school') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row row-xs">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="members_worker" class="col-form-label col-md-6">Workers
                                                Members</label>
                                            <div class="col-md-6">
                                                <input type="number" id="members_worker" name="members_worker"
                                                       class="form-control @error('members_worker') is-invalid @enderror">
                                                @if($errors->has('members_worker'))
                                                    <div class="invalid-feedback"
                                                         style="color: red;">{{ $errors->first('members_worker') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <h2 style="background: #dde2ef;padding:7px">Family Members</h2>

                            <span>in the table Start by the Guardian, Mother, Children, from the oldest to the youngest and other dependents.</span>
                            <table class="table w-auto table-responsive">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>First Name</th>
                                    <th>Sex</th>
                                    <th>Relation</th>
                                    <th>Date of Birth</th>
                                    <th>Educational Level</th>
                                    <th class="col-1">Fees(BGP)</th>
                                    <th>Health Status</th>
                                    <th>Type of Work</th>
                                    <th>Income(BGP)</th>
                                </tr>
                                </thead>
                                <tbody>
                                @for ($i = 1; $i <= 15; $i++)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td><input type="text" name="relatives[{{ $i }}][name]"
                                                   placeholder="First Name"/></td>
                                        <td>
                                            <select name="relatives[{{ $i }}][sex]">
                                                <option disabled selected value>-- select an option --</option>
                                                <option value="M">Male</option>
                                                <option value="F">Female</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="relatives[{{ $i }}][relation]">
                                                <option disabled selected value>-- select an option --</option>
                                                <option value="Mother">Mother</option>
                                                <option value="Brother">Brother</option>
                                                <option value="Sister">Sister</option>
                                                <option value="Son">Son</option>
                                                <option value="Daughter">Daughter</option>
                                                <option value="Grandfather">Grandfather</option>
                                                <option value="Grandmother">Grandmother</option>
                                            </select>
                                        </td>
                                        <td><input type="date" name="relatives[{{ $i }}][dob]"/></td>
                                        <td>
                                            <select name="relatives[{{ $i }}][edu_level]">
                                                <option disabled selected value>-- select an option --</option>
                                                <option value="KinderGarten">KinderGarten</option>
                                                <option value="Primary">Primary</option>
                                                <option value="Preparator">Preparator</option>
                                                <option value="Secondary">Secondary</option>
                                                <option value="Diploma">Diploma</option>
                                                <option value="University">University</option>
                                                <option value="HigherDegrees">HigherDegrees</option>
                                                <option value="Vocational">Vocational</option>
                                                <option value="illiterate">illiterate</option>
                                            </select>
                                        </td>
                                        <td><input type="number" name="relatives[{{ $i }}][fees]"/></td>
                                        <td>
                                            <select name="relatives[{{ $i }}][health_status]">
                                                <option disabled selected value>-- select an option --</option>
                                                <option value="Healthy">Healthy</option>
                                                <option value="Unhealthy">Unhealthy</option>
                                                <option value="special_need">Special Need</option>
                                            </select>
                                        </td>
                                        <td><input type="text" name="relatives[{{ $i }}][work_type]"/></td>
                                        <td><input type="number" name="relatives[{{ $i }}][income]"/></td>
                                    </tr>
                                @endfor
                                </tbody>
                            </table>

                        </section>

                        <h3></h3>
                        <section>
                            <br>
                            <h2 style="background: #dde2ef;padding:7px">Educational Status</h2>
                            <div class="row row-xs">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="child_edu_level" class="col-form-label col-md-6">Select the
                                                Educational Level</label>
                                            <div class="col-md-6">
                                                <select id="child_edu_level" name="child_edu_level"
                                                        class="form-control border-dark @error('child_edu_level') is-invalid @enderror">
                                                    <option disabled selected value> -- select an option --</option>
                                                    @foreach($child_edu_level as $level)
                                                        <option value="{{$level}}">{{$level}}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('child_edu_level'))
                                                    <div class="invalid-feedback"
                                                         style="color: red;">{{ $errors->first('child_edu_level') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="school_name" class="col-form-label col-md-6">School Name</label>
                                            <div class="col-md-6">
                                                <input type="text" id="school_name" name="school_name"
                                                       class="form-control border-dark @error('school_name') is-invalid @enderror">
                                                @if($errors->has('school_name'))
                                                    <div class="invalid-feedback"
                                                         style="color: red;">{{ $errors->first('school_name') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="edu_level" class="col-form-label col-md-6">
                                                Does the Child need intensive lessons?
                                            </label>
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input type="radio" id="need_yes" name="need_lessons" value="1"
                                                           class="form-check-input">
                                                    <label for="need_yes" class="form-check-label">Yes</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" id="need_no" name="need_lessons" value="0"
                                                           class="form-check-input">
                                                    <label for="need_no" class="form-check-label">No</label>
                                                </div>
                                                @if($errors->has('need_lessons'))
                                                    <div class="invalid-feedback"
                                                         style="color: red;">{{ $errors->first('need_lessons') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row row-xs" id="intensive_lessons_container">
                                <label class="col-form-label col-md-2"><b>Intensive Lessons:</b></label>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" id="english_lesson" name="intensive_lessons[]"
                                           value="English" class="form-check-input">
                                    <label for="english_lesson" class="form-check-label">English</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" id="arabic_lesson" name="intensive_lessons[]" value="Arabic"
                                           class="form-check-input">
                                    <label for="arabic_lesson" class="form-check-label">Arabic</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" id="mathematics_lesson" name="intensive_lessons[]"
                                           value="Mathematics" class="form-check-input">
                                    <label for="mathematics_lesson" class="form-check-label">Mathematics</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" id="science_lesson" name="intensive_lessons[]"
                                           value="Science" class="form-check-input">
                                    <label for="science_lesson" class="form-check-label">Science</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" id="custom_lesson_checkbox" name="intensive_lessons[]" value="Other"
                                           class="form-check-input">
                                    <label for="custom_lesson" class="form-check-label">Other</label>&nbsp;&nbsp;
                                    <input type="text" id="custom_lesson" name="custom_lesson"
                                           placeholder="Enter custom Lesson" class="form-control border-dark">
                                </div>
                            </div>
                            <br>
                            <div class="row row-xs" id="lessons_cost">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="cost_lesson" class="col-form-label col-md-6">Cost Required to
                                                improve Child Education(GBP)</label>
                                            <div class="col-md-6">
                                                <input type="number" id="cost_lesson" name="cost_lesson"
                                                       class="form-control border-dark @error('members_count') is-invalid @enderror">
                                                @if($errors->has('cost_lesson'))
                                                    <div class="invalid-feedback"
                                                         style="color: red;">{{ $errors->first('members_count') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row row-xs">
                                <label class="col-form-label col-md-2"><b>Child Hobbies:</b></label>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" id="football_hobbie" name="hobbies[]"
                                           value="Football" class="form-check-input">
                                    <label for="football_hobbie" class="form-check-label">Football</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" id="swimming_hobbie" name="hobbies[]" value="Swimming"
                                           class="form-check-input">
                                    <label for="swimming_hobbie" class="form-check-label">Swimming</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" id="fishing_hobbie" name="hobbies[]"
                                           value="Fishing" class="form-check-input">
                                    <label for="fishing_hobbie" class="form-check-label">Fishing</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" id="drawing_hobbie" name="hobbies[]"
                                           value="Drawing" class="form-check-input">
                                    <label for="drawing_hobbie" class="form-check-label">Drawing</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" id="reading_hobbie" name="hobbies[]"
                                           value="Reading" class="form-check-input">
                                    <label for="reading_hobbie" class="form-check-label">Reading</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" id="singing_hobbie" name="hobbies[]"
                                           value="Singing" class="form-check-input">
                                    <label for="singing_hobbie" class="form-check-label">Singing</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" id="custom_hobbie_checkbox" name="hobbies[]" value="Other"
                                           class="form-check-input">
                                    <label for="custom_hobbie" class="form-check-label">Other</label>&nbsp;&nbsp;
                                    <input type="text" id="custom_hobbie" name="custom_hobbie"
                                           placeholder="Enter custom Hobbie" class="form-control border-dark">
                                </div>
                            </div>

                        </section>

                        <h3></h3>
                        <section>
                            <br>
                            <h2 style="background: #dde2ef;padding:7px">Health Situation for Child and Their family</h2>
                            <br>
                            <div class="row row-xs">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <div class="row align-items-center">
                                            <label for="members_count" class="col-form-label col-md-6">The child in Good
                                                Health?</label>
                                            <div class="col-md-6">
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" id="good_health_yes" name="good_health"
                                                           value="1" class="form-check-input">
                                                    <label for="good_health_yes" class="form-check-label">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" id="good_health_no" name="good_health"
                                                           value="0" class="form-check-input">
                                                    <label for="good_health_no" class="form-check-label">No</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row row-xs">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <div class="row align-items-center">
                                            <label for="members_count" class="col-form-label col-md-6">The Child or a
                                                family member suffering from a disease?</label>
                                            <div class="col-md-6">
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" id="has_disease_yes" name="has_disease"
                                                           value="1" class="form-check-input">
                                                    <label for="has_disease_yes" class="form-check-label">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" id="has_disease_no" name="has_disease"
                                                           value="0" class="form-check-input">
                                                    <label for="has_disease_no" class="form-check-label">No</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row row-xs">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="medicines" class="col-form-label col-md-6">Medications</label>
                                            <div class="col-md-6">
                                                    <textarea id="medications" name="medications"
                                                              class="form-control border-dark @error('medications') is-invalid @enderror"></textarea>
                                                @if($errors->has('medications'))
                                                    <div class="invalid-feedback"
                                                         style="color: red;">{{ $errors->first('medications') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <table class="table w-auto table-responsive">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Patient Name</th>
                                    <th>Disease</th>
                                    <th>Treatment Cost BGP</th>
                                    <th>Special Needs Devices</th>
                                    <th>Notes</th>
                                </tr>
                                </thead>
                                <tbody>
                                @for ($i = 1; $i <= 7; $i++)
                                    <tr>
                                        <td>{{$i}}</td>

                                        <td><input type="text" name="patients[{{ $i }}][patient_name]"
                                                   placeholder="First Name"/></td>
                                        <td><input type="text" name="patients[{{ $i }}][disease]"
                                                   placeholder="Disease"/></td>
                                        <td><input type="text" name="patients[{{ $i }}][treatment_cost]"
                                                   placeholder=""/></td>
                                        <td><input type="text" name="patients[{{ $i }}][special_needs]"
                                                   placeholder=""/></td>
                                        <td><input type="text" name="patients[{{ $i }}][notes]"
                                                   placeholder=""/></td>

                                    </tr>
                                @endfor
                                </tbody>
                            </table>
                        </section>
                        <h3></h3>
                        <section>
                            <br>
                            <h2 style="background: #dde2ef;padding:7px">Economic Status of the Family</h2>
                            <br>
                            <div class="row row-xs">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="jobs_members" class="col-form-label col-md-6">Jobs for family
                                                members</label>
                                            <div class="col-md-6">
                                                <select id="jobs_members" name="jobs_members"
                                                        class="form-control border-dark @error('jobs_members') is-invalid @enderror">
                                                    <option disabled selected value> -- select an option --</option>
                                                    @foreach($jobs_members as $member)
                                                        <option value="{{$member}}">{{$member}}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('jobs_members'))
                                                    <div class="invalid-feedback"
                                                         style="color: red;">{{ $errors->first('jobs_members') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row row-xs">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="periodic_sponsorships" class="col-form-label col-md-6">Periodic
                                                Sponsorships</label>
                                            <div class="col-md-6">
                                                <select id="periodic_sponsorships" name="periodic_sponsorships"
                                                        class="form-control border-dark @error('periodic_sponsorships') is-invalid @enderror">
                                                    <option disabled selected value> -- select an option --</option>
                                                    @foreach($periodic_sponsorships as $per_spons)
                                                        <option value="{{$per_spons}}">{{$per_spons}}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('periodic_sponsorships'))
                                                    <div class="invalid-feedback"
                                                         style="color: red;">{{ $errors->first('periodic_sponsorships') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row row-xs">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="irregular_aids" class="col-form-label col-md-6">Irregular
                                                Aids</label>
                                            <div class="col-md-6">
                                                <select id="irregular_aids" name="irregular_aids"
                                                        class="form-control border-dark @error('irregular_aids') is-invalid @enderror">
                                                    <option disabled selected value> -- select an option --</option>
                                                    @foreach($irregular_aids as $aid)
                                                        <option value="{{$aid}}">{{$aid}}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('irregular_aids'))
                                                    <div class="invalid-feedback"
                                                         style="color: red;">{{ $errors->first('irregular_aids') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row row-xs">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="house_fees" class="col-form-label col-md-6">House and Food
                                                Fees(BGP)</label>
                                            <div class="col-md-6">
                                                <input type="number" id="house_fees" name="house_fees"
                                                       class="form-control border-dark @error('house_fees') is-invalid @enderror">
                                                @if($errors->has('house_fees'))
                                                    <div class="invalid-feedback"
                                                         style="color: red;">{{ $errors->first('house_fees') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row row-xs">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="edu_fees" class="col-form-label col-md-6">Educational
                                                Fees(BGP)</label>
                                            <div class="col-md-6">
                                                <input type="number" id="edu_fees" name="edu_fees"
                                                       class="form-control border-dark @error('edu_fees') is-invalid @enderror">
                                                @if($errors->has('edu_fees'))
                                                    <div class="invalid-feedback"
                                                         style="color: red;">{{ $errors->first('edu_fees') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row row-xs">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="rents" class="col-form-label col-md-6">Rents(BGP)</label>
                                            <div class="col-md-6">
                                                <input type="number" id="rents" name="rents"
                                                       class="form-control border-dark @error('rents') is-invalid @enderror">
                                                @if($errors->has('rents'))
                                                    <div class="invalid-feedback"
                                                         style="color: red;">{{ $errors->first('rents') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row row-xs">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="medical_fees" class="col-form-label col-md-6">Medical
                                                Fees(BGP)</label>
                                            <div class="col-md-6">
                                                <input type="number" id="medical_fees" name="medical_fees"
                                                       class="form-control border-dark @error('medical_fees') is-invalid @enderror">
                                                @if($errors->has('medical_fees'))
                                                    <div class="invalid-feedback"
                                                         style="color: red;">{{ $errors->first('medical_fees') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="label"><b>In-Kind Support</b></label><br>
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" id="fridge_need" name="family_needs[]" value="Fridge"
                                                   class="form-check-input">
                                            <label for="fridge_need" class="form-check-label">Fridge</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" id="oven_need" name="family_needs[]" value="Oven"
                                                   class="form-check-input">
                                            <label for="oven_need" class="form-check-label">Oven</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" id="gaz_cylinder_need" name="family_needs[]"
                                                   value="Gaz Cylinder" class="form-check-input">
                                            <label for="gaz_cylinder_need" class="form-check-label">Gaz Cylinder</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" id="computer_need" name="family_needs[]"
                                                   value="Computer" class="form-check-input">
                                            <label for="computer_need" class="form-check-label">Computer</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" id="water_tank_need" name="family_needs[]"
                                                   value="Water Tank" class="form-check-input">
                                            <label for="water_tank_need" class="form-check-label">Water Tank</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-2">
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" id="washing_machine_need" name="family_needs[]"
                                                   value="Washing machine" class="form-check-input">
                                            <label for="washing_machine_need" class="form-check-label">Washing
                                                machine</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" id="stove_need" name="family_needs[]" value="Stove"
                                                   class="form-check-input">
                                            <label for="stove_need" class="form-check-label">Stove</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" id="furniture_need" name="family_needs[]"
                                                   value="Furniture" class="form-check-input">
                                            <label for="furniture_need" class="form-check-label">Furniture</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" id="laptop_need" name="family_needs[]" value="Laptop"
                                                   class="form-check-input">
                                            <label for="laptop_need" class="form-check-label">Laptop</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" id="custom_need_checkbox" name="family_needs[]" value="Other"
                                                   class="form-check-input">
                                            <label for="custom_need_checkbox" class="form-check-label">Other</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="text" id="custom_need" name="custom_need"
                                                   placeholder="Enter custom Need" class="form-control border-dark">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <h5>Small Project that May Benefit The Family</h5>
                            <br>
                            <div class="row row-xs">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="project_type" class="col-form-label col-md-6">Project
                                                Type</label>
                                            <div class="col-md-6">
                                                <input type="text" id="project_type" name="project_type"
                                                       class="form-control border-dark @error('house_fees') is-invalid @enderror">
                                                @if($errors->has('project_type'))
                                                    <div class="invalid-feedback"
                                                         style="color: red;">{{ $errors->first('project_type') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row row-xs">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="project_type" class="col-form-label col-md-6">Project
                                                Cost</label>
                                            <div class="col-md-6">
                                                <input type="number" id="project_cost" name="project_cost"
                                                       class="form-control border-dark @error('project_cost') is-invalid @enderror">
                                                @if($errors->has('project_cost'))
                                                    <div class="invalid-feedback"
                                                         style="color: red;">{{ $errors->first('project_cost') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <h5>Final Notes and Recommendation</h5>
                            <br>
                            <div class="row row-xs">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                    <textarea id="notes" name="notes" cols="30" rows="5"
                                                              class="form-control border-dark @error('notes') is-invalid @enderror"></textarea>
                                                @if($errors->has('notes'))
                                                    <div class="invalid-feedback"
                                                         style="color: red;">{{ $errors->first('notes') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </section>
                      <h3></h3>
                      <section>
                          <h2 style="background: #dde2ef;padding:7px">Resident Status of The Family</h2> <br>
                          <div class="row row-xs">
                              <div class="col-md-7">
                                  <div class="form-group">
                                      <div class="row">
                                          <label for="resident_status" class="col-form-label col-md-6">Resident
                                              Status</label>
                                          <div class="col-md-6">
                                              <select id="resident_status" name="resident_status"
                                                      class="form-control border-dark @error('resident_status') is-invalid @enderror">
                                                  <option disabled selected value> -- select an option --</option>
                                                  @foreach($resident_statuses as $status)
                                                      <option value="{{$status}}">{{$status}}</option>
                                                  @endforeach
                                              </select>
                                              @if($errors->has('resident_status'))
                                                  <div class="invalid-feedback"
                                                       style="color: red;">{{ $errors->first('jobs_members') }}</div>
                                              @endif
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="row row-xs">
                              <div class="col-md-7">
                                  <div class="form-group">
                                      <div class="row">
                                          <label for="resident_type" class="col-form-label col-md-6">Resident
                                              Type</label>
                                          <div class="col-md-6">
                                              <select id="resident_type" name="resident_type"
                                                      class="form-control border-dark @error('resident_type') is-invalid @enderror">
                                                  <option disabled selected value> -- select an option --</option>
                                                  @foreach($resident_types as $type)
                                                      <option value="{{$type}}">{{$type}}</option>
                                                  @endforeach
                                              </select>
                                              @if($errors->has('resident_type'))
                                                  <div class="invalid-feedback"
                                                       style="color: red;">{{ $errors->first('resident_type') }}</div>
                                              @endif
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="row row-xs">
                              <div class="col-md-7">
                                  <div class="form-group">
                                      <div class="row">
                                          <label for="resident_description" class="col-form-label col-md-6">Resident
                                              Description</label>
                                          <div class="col-md-6">
                                              <select id="resident_description" name="resident_description"
                                                      class="form-control border-dark @error('resident_type') is-invalid @enderror">
                                                  <option disabled selected value> -- select an option --</option>
                                                  @foreach($resident_descriptions as $desc)
                                                      <option value="{{$desc}}">{{$desc}}</option>
                                                  @endforeach
                                              </select>
                                              @if($errors->has('resident_description'))
                                                  <div class="invalid-feedback"
                                                       style="color: red;">{{ $errors->first('resident_description') }}</div>
                                              @endif
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="container">
                              <div class="row">
                                  <div class="col-md-6">
                                      <label class="label"><b>Resident Needs</b></label><br>
                                      <div class="form-check form-check-inline">
                                          <input type="checkbox" id="paints_need" name="resident_needs[]"
                                                 value="Paints" class="form-check-input">
                                          <label for="paints_need" class="form-check-label">Paints</label>
                                      </div>
                                      <div class="form-check form-check-inline">
                                          <input type="checkbox" id="doors_need" name="resident_needs[]" value="Doors"
                                                 class="form-check-input">
                                          <label for="doors_need" class="form-check-label">Doors</label>
                                      </div>
                                      <div class="form-check form-check-inline">
                                          <input type="checkbox" id="sewerage_network_need" name="resident_needs[]"
                                                 value="Sewerage Network" class="form-check-input">
                                          <label for="sewerage_network_need" class="form-check-label">Sewerage
                                              Network</label>
                                      </div>
                                      <div class="form-check form-check-inline">
                                          <input type="checkbox" id="asbestos_need" name="resident_needs[]"
                                                 value="Asbestos" class="form-check-input">
                                          <label for="asbestos_need" class="form-check-label">Asbestos</label>
                                      </div>
                                      <div class="form-check form-check-inline">
                                          <input type="checkbox" id="electricity_need" name="resident_needs[]"
                                                 value="Electricity" class="form-check-input">
                                          <label for="electricity_need" class="form-check-label">Electricity</label>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-12 mb-2">
                                      <div class="form-check form-check-inline">
                                          <input type="checkbox" id="plaster_need" name="resident_needs[]"
                                                 value="Plaster" class="form-check-input">
                                          <label for="plaster_need" class="form-check-label">Plaster</label>
                                      </div>
                                      <div class="form-check form-check-inline">
                                          <input type="checkbox" id="windows_need" name="resident_needs[]"
                                                 value="Windows" class="form-check-input">
                                          <label for="windows_need" class="form-check-label">Windows</label>
                                      </div>
                                      <div class="form-check form-check-inline">
                                          <input type="checkbox" id="general_maintenance_need" name="resident_needs[]"
                                                 value="General Maintenance" class="form-check-input">
                                          <label for="general_maintenance_need" class="form-check-label">General
                                              Maintenance</label>
                                      </div>
                                      <div class="form-check form-check-inline">
                                          <input type="checkbox" id="roof_need" name="resident_needs[]" value="Roof"
                                                 class="form-check-input">
                                          <label for="roof_need" class="form-check-label">Roof</label>
                                      </div>
                                      <div class="form-check form-check-inline">
                                          <input type="checkbox" id="new_room_need" name="resident_needs[]"
                                                 value="New Room" class="form-check-input">
                                          <label for="new_room_need" class="form-check-label">New Room</label>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="row row-xs">
                              <div class="col-md-7">
                                  <div class="form-group">
                                      <div class="row">
                                          <label for="rent_cost" class="col-form-label col-md-6">Rent Cost(Monthly in
                                              BGP)</label>
                                          <div class="col-md-6">
                                              <input type="number" id="rent_cost" name="rent_cost"
                                                     class="form-control border-dark @error('rent_cost') is-invalid @enderror">
                                              @if($errors->has('rent_cost'))
                                                  <div class="invalid-feedback"
                                                       style="color: red;">{{ $errors->first('no_rooms') }}
                                                  </div>
                                              @endif
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="row row-xs">
                              <div class="col-md-7">
                                  <div class="form-group">
                                      <div class="row">
                                          <label for="no_rooms" class="col-form-label col-md-6">No. of Rooms</label>
                                          <div class="col-md-6">
                                              <input type="number" id="no_rooms" name="no_rooms"
                                                     class="form-control border-dark @error('no_rooms') is-invalid @enderror">
                                              @if($errors->has('no_rooms'))
                                                  <div class="invalid-feedback"
                                                       style="color: red;">{{ $errors->first('no_rooms') }}
                                                  </div>
                                              @endif
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="row row-xs">
                              <div class="col-md-7">
                                  <div class="form-group">
                                      <div class="row">
                                          <label for="house_area" class="col-form-label col-md-6">House
                                              Area(m^2)</label>
                                          <div class="col-md-6">
                                              <input type="number" id="house_area" name="house_area"
                                                     class="form-control border-dark @error('house_area') is-invalid @enderror">
                                              @if($errors->has('house_area'))
                                                  <div class="invalid-feedback"
                                                       style="color: red;">{{ $errors->first('house_area') }}
                                                  </div>
                                              @endif
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                        </section>
                        <h3></h3>
                         --}}
                        <section>

                            <h2 style="background: #dde2ef;padding:7px">Attachments</h2> <br>
                            <div class="container">
                                <div class="form-group">
                                    <label for="child_personal_photo"><strong>Child Personal Photo:</strong></label>
                                    <input type="file" class="form-control-file" id="child_personal_photo"
                                           name="child_personal_photo">
                                </div>
                                <div class="form-group">
                                    <label for="birth_certificate"><strong>Last Birth Certificate (Photo Copy):</strong></label>
                                    <input type="file" class="form-control-file" id="birth_certificate"
                                           name="birth_certificate">
                                </div>

                                <div class="form-group">
                                    <label for="medical_report"><strong>Medical Report (if there is a patient in the
                                            family):</strong></label>
                                    <input type="file" class="form-control-file" id="medical_report"
                                           name="medical_report">
                                </div>

                                <div class="form-group">
                                    <label for="education_certificate"><strong>Last Education Certificate of the Child
                                            (Photo Copy):</strong></label>
                                    <input type="file" class="form-control-file" id="education_certificate"
                                           name="education_certificate">
                                </div>

                                <div class="form-group">
                                    <label for="guardian_id_card"><strong>Guardian ID Card (Photo
                                            Copy):</strong></label>
                                    <input type="file" class="form-control-file" id="guardian_id_card"
                                           name="guardian_id_card">
                                </div>

                                <div class="form-group">
                                    <label for="various_photos"><strong>Various Photos Including Surrounding
                                            Environment:</strong></label>
                                    <input type="file" class="form-control-file" id="various_photos"
                                           name="various_photos[]" multiple>
                                </div>

                                <div class="form-group">
                                    <label for="mother_id_card"><strong>Mother ID Card (Photo Copy):</strong></label>
                                    <input type="file" class="form-control-file" id="mother_id_card"
                                           name="mother_id_card">
                                </div>

                                <div class="form-group">
                                    <label for="father_id_card"><strong>Father ID Card (Photo Copy):</strong></label>
                                    <input type="file" class="form-control-file" id="father_id_card"
                                           name="father_id_card">
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </section>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- /row -->

    <!-- row -->
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->

@endsection
@section('js')
    <script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
    <!--Internal  Select2 js -->
    <script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
    <!-- Internal Jquery.steps js -->
    <script src="{{URL::asset('assets/plugins/jquery-steps/jquery.steps.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script>
    <!--Internal  Form-wizard js -->
    <script src="{{URL::asset('assets/js/form-wizard.js')}}"></script>
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
    {{--
    <script>
        $(document).ready(function() {
            const input = document.getElementById("father_death_div");
            $("#category_dropdown").change(function() {
                console.log("Option selected:", $(this).val());
                // Perform some action based on the selected option
                if ($(this).val() === "ORPHAN") {
                    input.style.display = "block";
                } else {
                    input.style.display = "none";
                }
            });
        });
    </script>
    --}}
    <script>
        function showDisabilityTypeInput() {
            var checkbox = document.getElementById("has_disability");
            var disabilityTypeInput = document.getElementById("disability_div");

            if (checkbox.checked) {
                disabilityTypeInput.style.display = "block";
            } else if(!(checkbox.checked)) {
                disabilityTypeInput.style.display = "none";
            }
        }


        $(document).ready(function() {
            // Initially hide the Intensive Lessons and Cost fields
            $('#intensive_lessons_container').hide();
            $('#lessons_cost').hide();
            $("#custom_lesson").prop("disabled", true);
            $("#custom_hobbie").prop("disabled", true);
            $("#custom_need").prop("disabled", true);

            // Event listener for the radio buttons
            $('input[name="need_lessons"]').on('change', function() {
                if ($(this).val() === '1') {
                    // Show the Intensive Lessons and Cost fields
                    $('#intensive_lessons_container').show();
                    $('#lessons_cost').show();
                } else {
                    // Hide the Intensive Lessons and Cost fields
                    $('#intensive_lessons_container').hide();
                    $('#lessons_cost').hide();
                }
            });
        });
        $(document).ready(function() {
            $('#custom_lesson_checkbox').change(function() {
                if ($(this).is(':checked')) {
                    $('#custom_lesson').prop('disabled', false);
                } else {
                    $('#custom_lesson').prop('disabled', true);
                }
            });
            $('#custom_hobbie_checkbox').change(function() {
                if ($(this).is(':checked')) {
                    $('#custom_hobbie').prop('disabled', false);
                } else {
                    $('#custom_hobbie').prop('disabled', true);
                }
            });
            $('#custom_need_checkbox').change(function() {
                if ($(this).is(':checked')) {
                    $('#custom_need').prop('disabled', false);
                } else {
                    $('#custom_need').prop('disabled', true);
                }
            });
        });
    </script>
@endsection
