@extends('layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Tables</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Data Tables</span>
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
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">Children TABLE</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table card-table table-striped table-vcenter text-nowrap mb-0" id="example1">
                            <thead>
                            <tr>
                                <th class="wd-10p border-bottom-0">Code</th>
                                <th class="wd-15p border-bottom-0">Beneficiary Name</th>
                                <th class="wd-15p border-bottom-0">Is VIP</th>
                                <th class="wd-15p border-bottom-0">Category</th>
                                <th class="wd-15p border-bottom-0">Gender</th>
                                <th class="wd-15p border-bottom-0">Orphan DOB</th>
                                <th class="wd-20p border-bottom-0">Guardian Name</th>
                                <th class="wd-15p border-bottom-0">Relation To Child</th>
                                <th class="wd-10p border-bottom-0">Scale Of Poverty</th>
                                <th class="wd-25p border-bottom-0">Category</th>
                                <th class="wd-25p border-bottom-0">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orphans as $orphan)
                                <tr>
                                    <td>{{$orphan->NO_ORPHAN_CODE}}</td>
                                    <td>{{$orphan->Orphan_Name_En}}</td>
                                    <td>@if($orphan->is_vip) True @else False @endif</td>
                                    <td>{{$orphan->Category}}</td>
                                    <td>{{$orphan->Gender}}</td>
                                    <td>{{$orphan->ORPHAN_DOB}}</td>
                                    <td>{{$orphan->Guardian->Guardian_En}}</td>
                                    <td>{{$orphan->Guardian->REL_TO_CHILD_EN}}</td>
                                    <td>{{$orphan->Scale_Of_poverty}}</td>
                                    <td>{{$orphan->CAT}}</td>
                                <td>
                                    <a href="{{route('child.edit',$orphan->NO_ORPHAN_CODE)}}" class="btn btn-sm btn-primary">
                                        <i class="las la-cog"></i>
                                    </a>
                                    <a href="" data-id=""
                                       data-name="" data-target="#modaldemo1"
                                       data-toggle="modal" class="btn btn-sm btn-danger">
                                        <i class="las la-trash"></i>
                                    </a>
                                </td>
                               {{--  <td>
                                     <td>
                                     <a href="{{route('beneficiaries.edit',['$Child',$orphan->NO_ORPHAN_CODE])}}" class="btn btn-sm btn-dark">Edit</a>

                                    </td>
                                <td>
                                        <form action="{{route('beneficiaries.destroy',['$Child',$orphan->NO_ORPHAN_CODE])}}" method="post">
                                         @csrf --}}{{-- csrf_field()--}}{{--
                                         @method('delete')
                                         <!--input type="hidden" name="_method" value="delete"-->
                                         <button class="btn btn-sm btn-danger">Delete<i class="las la-trash"></i></button>
                                     </form>
                                </td>
                                 </td>--}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->
    </div>
    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
    <!--Internal  Datatable js -->
    <script src="{{URL::asset('assets/js/table-data.js')}}"></script>
@endsection
