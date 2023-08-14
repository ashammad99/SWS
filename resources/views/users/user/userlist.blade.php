@extends('layouts.master')
@section('title')
    SWS - Users List
@stop
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
                <h4 class="content-title mb-0 my-auto">Users</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Users List</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!--Row-->
    <div class="row row-sm">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">USERS TABLE</h4>
                        <div class="btn-icon-list">
                            <form action="{{route('users.create')}}" method="get">
                                <button class="btn btn-success btn-icon"><i class="typcn typcn-document-add"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive userlist-table">
                        <table class="table card-table table-striped table-vcenter text-nowrap mb-0" id="example1">
                            <thead>
                            <tr>
                                <th class="wd-lg-8p"><span>User</span></th>
                                <th class="wd-lg-20p"><span></span></th>
                                <th class="wd-lg-20p"><span>Roles</span></th>
                                {{-- <th class="wd-lg-20p"><span>Permisions</span></th> --}}
                                <th class="wd-lg-20p"><span>Status</span></th>
                                <th class="wd-lg-20p"><span>Email</span></th>
                                <th class="wd-lg-20p"><span>Trash Status</span></th>
                                <th class="wd-lg-20p">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>
                                        <img alt="avatar" class="rounded-circle avatar-md mr-2"
                                             src="{{URL::asset('assets/profile/'.$user->photo)}}">
                                    </td>
                                    <td>{{$user->name_en}}</td>
                                    <td>@foreach($user->roles as $role)

                                            {{$role->name}}

                                        @endforeach
                                    </td>
                                    {{-- <td>@foreach($user->permissions as $per)

                                        {{$per->name}}

                                        @endforeach
                                    </td> --}}
                                    <td class="text-center">
                                        @if($user->status == 1)
                                            <span class="label text-success d-flex"><div
                                                    class="dot-label bg-success ml-1"></div>Enabled</span>
                                        @else
                                            <span class="label text-danger d-flex"><div
                                                    class="dot-label bg-danger ml-1"></div>Disabled</span>
                                        @endif

                                    </td>
                                    <td>
                                        <a href="#">{{$user->email}}</a>
                                    </td>
                                    <td>
                                        @if($user->trashed())
                                            <span class="label text-danger d-flex">
                                                <div class="dot-label bg-danger ml-1"></div>Trashed
                                            </span>
                                        @else
                                            <span class="label text-success d-flex">
                                                <div class="dot-label bg-success ml-1"></div>Not Trashed
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route('users.editRole',$user->id)}}" class="btn btn-sm btn-primary">
                                            <i class="las la-cog"></i>
                                        </a>

                                        @if(!($user->id == Auth::User()->id) && !($user->id == 1))
                                            <a href="" data-id="{{ $user->id }}"
                                               data-name="{{ $user->name_en }}" data-target="#modaldemo1"
                                               data-toggle="modal" class="btn btn-sm btn-danger">
                                                <i class="las la-trash"></i>
                                            </a>
                                        @endif
                                        @if($user->trashed())
                                            <a href="{{route('users.restore', $user->id)}}"
                                               class="btn btn-sm btn-primary">
                                                <i class="las la-undo"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div><!-- COL END -->
    </div>
    <!-- row closed  -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
    <!-- Delete User modal -->
    <div class="modal" id="modaldemo1">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Confirmation</h6>
                    <button aria-label="Close" class="close" data-dismiss="modal"
                            type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('users.delete', 'user') }}">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <input type="hidden" id="id" name="id">
                        <h6 style="color:red">Warning !!</h6>
                        <p>Are You Sure You Want Delete <b id="user_name"></b> User.</p>
                    </div>
                    <div class="modal-footer">

                        <button class="btn ripple btn-danger" type="submit">Delete</button>

                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Delete User modal -->
@endsection
@section('js')
    <!--Internal  Datepicker js -->
    <script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
    <!-- Internal Select2 js-->
    <script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
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
    <script>
        $('#modaldemo1').on('show.bs.modal', function (event) {
            console.log('Modal open');
            var button = $(event.relatedTarget) // Button that triggered the modal
            var id = button.data('id')
            var name = button.data('name') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('.modal-body #id').val(id)
            modal.find('.modal-body #name').val(name)
            document.getElementById("user_name").innerHTML = name;
        })
    </script>
@endsection
