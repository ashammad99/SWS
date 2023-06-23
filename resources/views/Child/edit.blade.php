@extends('layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
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
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('beneficiaries.update',$beneficary->NO_ORPHAN_CODE)}}" method="post"
                          id="wizard1">
                        @csrf
                        @method('put')
                        <h3>Personal Information</h3>
                        <section>
                            <br>
                            <div class="row row-xs">
                                <div class="form-group">
                                    <label for="NO_ORPHAN_CODE" class="">Beneficary Code</label>
                                    <input type="number" readonly id="NO_ORPHAN_CODE"
                                           value="{{$beneficary->NO_ORPHAN_CODE}}" name="NO_ORPHAN_CODE"
                                           placeholder="Orphan Code"
                                           class="form-control  @error('NO_ORPHAN_CODE') is-invalid @enderror">
                                    @if($errors->has('NO_ORPHAN_CODE'))
                                        <div class="error"
                                             style="color: red;">{{ $errors->first('NO_ORPHAN_CODE') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="childGovNum" class="">Orphan ID</label>
                                    <input type="number" id="childGovNum" name="childGovNum"
                                           value="{{$beneficary->childGovNum}}"
                                           class="form-control  @error('childGovNum') is-invalid @enderror">
                                    @if($errors->has('childGovNum'))
                                        <div class="error" style="color: red;">{{ $errors->first('childGovNum') }}</div>
                                    @endif
                                </div>
                                <div class="form-check form-check-inline" style="margin-left: 10%">
                                    <h5 class="form-check-label" for="is_vip">is vip&nbsp;&nbsp;&nbsp;</h5>
                                    <input class="form-check-input" type="checkbox"
                                           @if($beneficary->is_vip == true) checked @endif id="is_vip" name="is_vip"
                                           value="1">
                                </div>
                            </div>
                            <div class="row row-xs">
                                <div class="col-md-5">
                                    <label for="Orphan_Name_En">Orphan English Name</label>
                                    <input type="text" id="Orphan_Name_En" name="Orphan_Name_En"
                                           value="{{$beneficary->Orphan_Name_En}}"
                                           placeholder="Orphan English Name"
                                           class="form-control @error('Orphan_Name_En') is-invalid @enderror">
                                    @if($errors->has('Orphan_Name_En'))
                                        <div class="error"
                                             style="color: red;">{{ $errors->first('Orphan_Name_En') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-5 mg-t-10 mg-md-t-0">
                                    <label for="Orphan_Name_Ar">Orphan Arabic Name</label>
                                    <input type="text" id="Orphan_Name_Ar" name="Orphan_Name_Ar"
                                           value="{{$beneficary->Orphanc_Name_Ar}}"
                                           placeholder="Orphan Arabic Name"
                                           class="form-control @error('Orphan_Name_Ar') is-invalid @enderror">
                                    @if($errors->has('Father_ID'))
                                        <div class="error"
                                             style="color: red;">{{ $errors->first('Orphan_Name_Ar') }}</div>
                                    @endif
                                </div>
                            </div>
                            <br>
                            <div class="row row-xs">
                                <div class="col-md-5">
                                    <h6>Gender: </h6>
                                    <div class="form-group" style="margin-left: 10%">
                                        <input type="radio" id="male" name="gender" value="MALE"
                                               @if($beneficary->Gender == "MALE") checked @endif>
                                        <label for="male">Male</label>
                                        <br>
                                        <input type="radio" id="female" name="gender" value="FEMALE"
                                               @if($beneficary->Gender == "FEMALE") checked @endif>
                                        <label for="female">Female</label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <p class="mg-b-10">Select Scale Of Poverty: </p><select
                                        class="form-control select2-no-search" name="Scale_Of_poverty">
                                        <option disabled selected value> -- select an option --</option>
                                        @foreach($scales as $scale)
                                            <option @if($beneficary->Scale_Of_poverty == $scale) selected
                                                    @endif value="{{$scale}}">{{$scale}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('Scale_Of_poverty'))
                                        <div class="error"
                                             style="color: red;">{{ $errors->first('Scale_Of_poverty') }}</div>
                                    @endif
                                </div><!-- col-4 -->
                            </div>
                            <div class="row row-xs">
                                <div class="col-lg-5">
                                    <p class="mg-b-10">&nbsp;</p>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                Orphan DoB:
                                            </div>
                                        </div>
                                        <input class="form-control" name="ORPHAN_DOB" id="dateMask"
                                               value="{{$beneficary->ORPHAN_DOB->format('d-m-Y')}}"
                                               type="text"
                                               placeholder="MM/DD/YYYY">
                                    </div><!-- input-group -->
                                </div><!-- col-4 -->
                                <div class="col-lg-5">
                                    <p class="mg-b-10">Select Category</p>
                                    <select class="form-control select2-no-search" name="Category">
                                        <option disabled selected value> -- select an option --</option>
                                        @foreach($categories as $category)
                                            <option @if($beneficary->Category == $category) selected
                                                    @endif value="{{$category}}">{{$category}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('Category'))
                                        <div class="error" style="color: red;">{{ $errors->first('Category') }}</div>
                                    @endif
                                </div>
                            </div>
                            <br>
                            <div class="row row-xs">
                                <div class="col-lg-5">
                                    <p class="mg-b-10">&nbsp;</p>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                No. Sponsored
                                            </div>
                                        </div>
                                        <input class="form-control" name="NO_SPONSORED" id="dateMask"
                                               type="number" value="{{$beneficary->NO_SPONSORED}}">
                                    </div><!-- input-group -->
                                </div><!-- col-4 -->
                                <div class="col-lg-5">
                                    <p class="mg-b-10">Select CAT</p>
                                    <select class="form-control select2-no-search" name="Category">
                                        <option disabled selected value> -- select an option --</option>
                                        @foreach($CATs as $CAT)
                                            <option @if($beneficary->CAT == $CAT) selected
                                                    @endif value="{{$CAT}}">{{$CAT}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('Category'))
                                        <div class="error" style="color: red;">{{ $errors->first('Category') }}</div>
                                    @endif
                                </div>

                            </div>
                            <br>
                            <div class="row row-xs">
                                <div class="form-check form-check-inline" style="">
                                    <b><label class="form-check-label"
                                              for="Disability">Disability&nbsp;&nbsp;&nbsp;</label></b>
                                    <input class="form-check-input" name="Disability" type="checkbox" id="Disability"
                                           @if($beneficary->Disability == "TRUE") checked @endif
                                           value="1">
                                </div>
                                <div class="col-md-8">
                                    <label for="Disability_type">Disability Type</label>
                                    <input type="text" id="Disability_type" name="Disability_type"
                                           placeholder="Type Disability type here.."
                                           value="{{$beneficary->Disability_type}}"
                                           class="form-control @error('Disability_type') is-invalid @enderror">
                                    @if($errors->has('Disability_type'))
                                        <div class="error"
                                             style="color: red;">{{ $errors->first('Disability_type') }}</div>
                                    @endif
                                </div>

                            </div>
                            <br>
                            <div class="row row-xs">
                                <div class="col-md-5">
                                    <label for="Father_Name_EN">Father Name English</label>
                                    <input type="text" id="Father_Name_EN" name="Father_Name_EN"
                                           placeholder="Father English Name"
                                           value="{{$beneficary->Father_Name_EN}}"
                                           class="form-control @error('Father_Name_EN') is-invalid @enderror">
                                    @if($errors->has('Father_Name_EN'))
                                        <div class="error"
                                             style="color: red;">{{ $errors->first('Father_Name_EN') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-5 mg-t-10 mg-md-t-0">
                                    <label for="Orphan_Name_Ar">Father Name Arabic</label>
                                    <input type="text" id="Father_Name_AR" name="Father_Name_AR"
                                           placeholder="Father Name Arabic"
                                           value="{{$beneficary->Father_Name_AR}}"
                                           class="form-control @error('Father_Name_AR') is-invalid @enderror">
                                    @if($errors->has('Father_Name_AR'))
                                        <div class="error"
                                             style="color: red;">{{ $errors->first('Father_Name_AR') }}</div>
                                    @endif
                                </div>
                            </div>

                            <br>
                            <div class="row row-xs">
                                <div class="form-group col-lg-3">
                                    <label for="Father_ID" class="">Father ID</label>
                                    <input type="number" id="Father_ID" name="Father_ID"
                                           value="{{$beneficary->Father_ID}}"
                                           class="form-control  @error('Father_ID') is-invalid @enderror">
                                    @if($errors->has('Father_ID'))
                                        <div class="error" style="color: red;">{{ $errors->first('Father_ID') }}</div>
                                    @endif
                                </div>&emsp;&emsp;&emsp;
                                <div class="col-lg-5">
                                    <p class="mg-b-10">&nbsp;</p>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                father death date
                                            </div>
                                        </div>
                                        <input class="form-control" name="father_death_date" id="dateMask"
                                               value="{{$beneficary->father_death_date ?  $beneficary->father_death_date->format('d-m-Y'):""}}"
                                               placeholder="MM/DD/YYYY" type="text">
                                    </div><!-- input-group -->
                                </div><!-- col-4 -->
                            </div>
                        </section>
                        <h3>Address Information</h3>
                        <section>
                            <br>
                            <div class="row-xs">
                                <div class="row row-xs">
                                    <div class="col-md-5 mb-3">
                                        <label>Select Governorate: </label>
                                        <select class="form-control select2-no-search" name="governate"
                                                style="width: 150px">
                                            <option disabled selected value> -- select an option --</option>
                                            @foreach($governates as $governorate)
                                                <option @if($beneficary->gov_id == $governorate->gov_id) selected @endif
                                                value="{{$governorate->gov_id }}">{{$governorate->gov_name_en}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('governate'))
                                            <div class="error"
                                                 style="color: red;">{{ $errors->first('governate') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-5 mg-t-10 mg-md-t-0">
                                        <label>Select Camp: </label>
                                        <select
                                            class="form-control select2"
                                            name="camp"
                                        >
                                            <option disabled selected value> -- select an option --</option>
                                            @foreach($camps as $camp)
                                                <option
                                                    @if($beneficary->camp_id == $camp->camp_id) selected @endif
                                                value="{{$camp->camp_id}}">{{$camp->camp_name_en}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('camp'))
                                            <div class="error" style="color: red;">{{ $errors->first('camp') }}</div>
                                        @endif
                                    </div>

                                </div>
                            </div>
                            <br>
                            <div class="control-group form-group mb-0">
                                <label class="form-label">Address</label>
                                <input type="text" id="Address" name="Address" class="form-control required"
                                       value="{{$beneficary->address}}"
                                       placeholder="Address">
                                @if($errors->has('Address'))
                                    <div class="error" style="color: red;">{{ $errors->first('Address') }}</div>
                                @endif
                            </div>
                            <br>
                            <div class="row row-xs">
                                <div class="col-md-2">
                                    <label for="MAIL_CODE" class="">MAIL CODE</label>
                                    <input type="number" id="MAIL_CODE" name="MAIL_CODE"
                                           class="form-control  @error('MAIL_CODE') is-invalid @enderror"
                                           value="{{$beneficary->MAIL_CODE}}"
                                    >
                                    @if($errors->has('MAIL_CODE'))
                                        <div class="error" style="color: red;">{{ $errors->first('MAIL_CODE') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-2">
                                    <label for="AREA_CODE" class="">AREA CODE</label>
                                    <input type="number" id="AREA_CODE" name="AREA_CODE"
                                           class="form-control  @error('AREA_CODE') is-invalid @enderror"
                                           value="{{$beneficary->AREA_CODE}}"
                                    >
                                    @if($errors->has('AREA_CODE'))
                                        <div class="error" style="color: red;">{{ $errors->first('AREA_CODE') }}</div>
                                    @endif
                                </div>
                            </div>
                        </section>
                        <h3>Banking Information</h3>
                        <section>
                            <div class="row row-xs">
                                <div class="col-md-3">
                                    <label for="ACCOUNT_NO_BOP" class="">ACCOUNT NO BOP</label>
                                    <input type="number" id="ACCOUNT_NO_BOP" name="ACCOUNT_NO_BOP"
                                           value="{{$beneficary->Guardian->BankInfo->ACCOUNT_NO_BOP}}"
                                           class="form-control  @error('ACCOUNT_NO_BOP') is-invalid @enderror">
                                    @if($errors->has('ACCOUNT_NO_BOP'))
                                        <div class="error"
                                             style="color: red;">{{ $errors->first('ACCOUNT_NO_BOP') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-3">
                                    <label for="Branch_No" class="">Branch No</label>
                                    <input type="number" id="Branch_No" name="Branch_No"
                                           value="{{$beneficary->Guardian->BankInfo->Branch_No}}"
                                           class="form-control  @error('Branch_No') is-invalid @enderror">
                                    @if($errors->has('Branch_No'))
                                        <div class="error" style="color: red;">{{ $errors->first('Branch_No') }}</div>
                                    @endif
                                </div>
                            </div>
                            <br>
                            <div class="row row-xs">
                                <div class="col-md-5">
                                    <label class="form-label">IBAN</label>
                                    <input type="text" id="IBAN" name="IBAN" class="form-control required"
                                           value="{{$beneficary->Guardian->BankInfo->IBAN}}"
                                           placeholder="IBAN">
                                </div>
                                @if($errors->has('IBAN'))
                                    <div class="error" style="color: red;">{{ $errors->first('IBAN') }}</div>
                                @endif
                            </div>
                        </section>
                        <h3>Guardian Information</h3>
                        <section>
                            <br>
                            <div class="row row-xs">
                                <div class="col-md-5">
                                    <label for="Guardian_En">Guardian Name English</label>
                                    <input type="text" id="Guardian_En" name="Guardian_En"
                                           placeholder="Guardian English Name"
                                           value="{{$beneficary->Guardian->Guardian_En}}"
                                           class="form-control @error('Guardian_En') is-invalid @enderror">
                                    @if($errors->has('Guardian_En'))
                                        <div class="error" style="color: red;">{{ $errors->first('Guardian_En') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-5 mg-t-10 mg-md-t-0">
                                    <label for="Guardian_Ar">Guardian Name Arabic</label>
                                    <input type="text" id="Guardian_Ar" name="Guardian_Ar"
                                           placeholder="Guardian Name Arabic"
                                           value="{{$beneficary->Guardian->Guardian_Ar}}"
                                           class="form-control @error('Guardian_Ar') is-invalid @enderror">
                                    @if($errors->has('Guardian_Ar'))
                                        <div class="error" style="color: red;">{{ $errors->first('Guardian_Ar') }}</div>
                                    @endif
                                </div>
                            </div>
                            <br>
                            <div class="row row-xs">
                                <div class="col-md-5 mb-3">
                                    <p class="mg-b-10">Relation of Guardian to child En:</p><select
                                        style="width: 150px"
                                        name="relation_en"
                                        class="form-control select2 ">
                                        <option disabled selected value> -- select an option --</option>
                                        @foreach($relationsEN as $relation)
                                            <option @if($beneficary->Guardian->REL_TO_CHILD_EN == $relation) selected
                                                    @endif value="{{$relation}}">{{$relation}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('relation_en'))
                                        <div class="error" style="color: red;">{{ $errors->first('relation_en') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-5 mb-3">
                                    <p class="mg-b-10">Relation of Guardian to child Ar:</p>
                                    <select
                                        style="width: 150px"
                                        name="relation_ar"
                                        class="form-control select2 ">
                                        <option disabled selected value> -- select an option --</option>
                                        @foreach($relationsAr as $relation)
                                            <option @if($beneficary->Guardian->REL_TO_CHILD_AR == $relation) selected
                                                    @endif value="{{$relation}}">{{$relation}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('relation_ar'))
                                        <div class="error" style="color: red;">{{ $errors->first('relation_ar') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="row row-xs">
                                <div class="form-group col-lg-3">
                                    <label for="GuardianPhoneNum" class="">Guardian Phone Number 1:</label>
                                    <input type="number" id="GuardianPhoneNum" name="GuardianPhoneNum"
                                           value="{{$beneficary->Guardian->GuardianPhoneNum}}"
                                           class="form-control  @error('GuardianPhoneNum') is-invalid @enderror">
                                    @if($errors->has('GuardianPhoneNum'))
                                        <div class="error"
                                             style="color: red;">{{ $errors->first('GuardianPhoneNum') }}</div>
                                    @endif

                                </div>&emsp;&emsp;&emsp;
                                <div class="form-group col-lg-3">
                                    <label for="GuardianPhoneNum2" class="">Guardian Phone Number 2:</label>
                                    <input type="number" id="GuardianPhoneNum2" name="GuardianPhoneNum2"
                                           <?php
                                               function countDigits($MyNum)
                                               {
                                                   $MyNum = (int)$MyNum;
                                                   $count = 0;
                                                   while ($MyNum != 0) {
                                                       $MyNum = (int)($MyNum / 10);
                                                       $count++;
                                                   }
                                                   return $count;
                                               }
                                               ?>
                                           value="{{($beneficary->Guardian->GuardianPhoneNum2)}}"
                                           class="form-control  @error('GuardianPhoneNum2') is-invalid @enderror">
                                    @if($errors->has('GuardianPhoneNum2'))
                                        <div class="error"
                                             style="color: red;">{{ $errors->first('GuardianPhoneNum2') }}</div>
                                    @endif
                                </div>&emsp;&emsp;&emsp;
                                <div class="form-group col-lg-3">
                                    <label for="GuardianTelephoneNum" class="">Guardian Telephone No:</label>
                                    <input type="number" id="GuardianTelephoneNum" name="GuardianTelephoneNum"
                                           value="{{$beneficary->Guardian->GuardianTelephoneNum}}"
                                           class="form-control  @error('GuardianTelephoneNum') is-invalid @enderror">
                                    @if($errors->has('GuardianTelephoneNum'))
                                        <div class="error"
                                             style="color: red;">{{ $errors->first('GuardianTelephoneNum') }}</div>
                                    @endif
                                </div>&emsp;&emsp;&emsp;

                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>

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
@endsection
