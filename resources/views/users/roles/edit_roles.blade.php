@extends('layouts.master')
@section('title')
    SWS - Beneficiaries List
@stop
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <style>
        .toggler {
            
           
        }

        .toggler input {
            display: none;
        }

        .toggler label {
            display: block;
            position: relative;
            width: 72px;
            height: 36px;
            border: 1px solid #d6d6d6;
            border-radius: 36px;
            background: #e4e8e8;
            cursor: pointer;
        }

        .toggler label::after {
            display: block;
            border-radius: 100%;
            background-color: #d7062a;
            content: '';
            animation-name: toggler-size;
            animation-duration: 0.15s;
            animation-timing-function: ease-out;
            animation-direction: forwards;
            animation-iteration-count: 1;
            animation-play-state: running;
        }

        .toggler label::after,
        .toggler label .toggler-on,
        .toggler label .toggler-off {
            position: absolute;
            top: 50%;
            left: 25%;
            width: 26px;
            height: 26px;
            transform: translateY(-50%) translateX(-50%);
            transition: left 0.15s ease-in-out, background-color 0.2s ease-out, width 0.15s ease-in-out, height 0.15s ease-in-out, opacity 0.15s ease-in-out;
        }

        .toggler input:checked+label::after,
        .toggler input:checked+label .toggler-on,
        .toggler input:checked+label .toggler-off {
            left: 75%;
        }

        .toggler input:checked+label::after {
            background-color: #50ac5d;
            animation-name: toggler-size2;
        }

        .toggler .toggler-on,
        .toggler .toggler-off {
            opacity: 1;
            z-index: 2;
        }

        .toggler input:checked+label .toggler-off,
        .toggler input:not(:checked)+label .toggler-on {
            width: 0;
            height: 0;
            opacity: 0;
        }

        .toggler .path {
            fill: none;
            stroke: #fefefe;
            stroke-width: 7px;
            stroke-linecap: round;
            stroke-miterlimit: 10;
        }

        @keyframes toggler-size {

            0%,
            100% {
                width: 26px;
                height: 26px;
            }

            50% {
                width: 20px;
                height: 20px;
            }
        }

        @keyframes toggler-size2 {

            0%,
            100% {
                width: 26px;
                height: 26px;
            }

            50% {
                width: 20px;
                height: 20px;
            }
        }
    </style>
 
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Beneficiaries</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    Beneficiaries List</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">

        <div class="col-xl-12">
            <div class="card">
                <form action="{{ route('roles.perimissions.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="role_id" value="{{ $role->id }}">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mg-b-0"><span style="color:blue">{{ $role->name }}</span> ROLE TABLE
                            </h4>

                            <div class="btn-icon-list"><button type="submit" class="btn btn-success btn-with-icon "><i
                                        class="typcn typcn-edit"></i> Save</button></div>

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive userlist-table">
                            <table class="table card-table table-striped table-vcenter text-nowrap mb-0" id="example1">
                                <thead>
                                    <tr>
                                        <th class="wd-5p border-bottom-0"><span>#</span></th>
                                        <th class="wd-15p border-bottom-0"><span>Perimission</span></th>
                                        <th class="wd-15p border-bottom-0"><span>Note</span></th>
                                        <th class="wd-15p border-bottom-0"><span>Action</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($perimission as $per)
                                        <tr>
                                            <td>{{ $per->id }}</td>
                                            <td>{{ $per->name }}</td>
                                            <td>{{ $per->note }}</td>
                                            <td>
                                                <div class="toggler">
                                                    <input id="toggler-{{ $per->id }}" name="permissions[]" type="checkbox" value="{{ $per->id }}"  @if (count($role->permissions->where('id', $per->id))) checked @endif>
                                                    <label for="toggler-{{ $per->id }}">
                                                        <svg class="toggler-on" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                                                            <polyline class="path check" points="100.2,40.2 51.5,88.8 29.8,67.5"></polyline>
                                                        </svg>
                                                        <svg class="toggler-off" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                                                            <line class="path line" x1="34.4" y1="34.4" x2="95.8" y2="95.8"></line>
                                                            <line class="path line" x1="95.8" y1="34.4" x2="34.4" y2="95.8"></line>
                                                        </svg>
                                                    </label>
                                                </div>
                                                {{-- <div class="col-lg-3 mg-t-20 mg-lg-t-0">
                                                    <label class="ckbox"><input type="checkbox" name="permissions[]"
                                                            value="{{ $per->id }}"
                                                            @if (count($role->permissions->where('id', $per->id))) checked @endif><span></span></label>
                                                </div> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--/div-->

    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>

    <!-- Internal Select2.min js -->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>
@endsection
