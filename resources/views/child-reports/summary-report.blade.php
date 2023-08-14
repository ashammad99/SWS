@extends('layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('title')
    Child Profile
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Reports</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Summary Report -Child</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('reports.child-summary-store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <br>
                        <div class="row row-xs">
                            <div class="form-group">

                                <input type="hidden" id="child_id"  name="child_id" value="{{$child->id}}"
                                >
                            </div>
                            <div class="form-group">
                                <label for="child_code" class="">Child Code</label>
                                <input type="number" id="child_code" readonly name="child_code"
                                       placeholder="Child Code" value="{{$child->child_code}}"
                                       class="form-control border-dark"
                                >
                            </div>
                        </div>
                        <div class="row row-xs">
                            <div class="col-md-5">
                                <label for="child_fullName_en">Child English Name</label>
                                <input type="text" id="child_fullName_en" name="child_fullName_en"
                                       placeholder="Child English Name"
                                       value="{{$child->child_fullName_en}}"
                                       readonly
                                       class="form-control border-dark">
                            </div>
                            <div class="col-md-5 mg-t-10 mg-md-t-0">
                                <label for="child_fullName_ar">Child Arabic Name</label>
                                <input type="text" id="child_fullName_ar" name="child_fullName_ar"
                                       placeholder="Child Arabic Name"
                                       readonly
                                       value="{{$child->child_fullName_ar}}"
                                       class="form-control border-dark">
                            </div>
                        </div>
                        <br>
                        <div class="row row-xs">
                            <div class="form-group">
                                <label for="family_situation">Family Situation</label>
                                <textarea class="txtarea form-control" cols="117" rows="8" name="family_situation"
                                          Id="Text" @error('family_situation') is-invalid @enderror"></textarea>
                                @if($errors->has('family_situation'))
                                    <div class="error"
                                         style="color: red;">{{ $errors->first('family_situation') }}</div>
                                @endif
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">Print</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
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
    <script
        src="{{URL::asset('assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js')}}"></script>
    <!-- Ionicons js -->
    <script
        src="{{URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js')}}"></script>
    <!--Internal  pickerjs js -->
    <script src="{{URL::asset('assets/plugins/pickerjs/picker.min.js')}}"></script>
    <!-- Internal form-elements js -->
    <script src="{{URL::asset('assets/js/form-elements.js')}}"></script>
@endsection
