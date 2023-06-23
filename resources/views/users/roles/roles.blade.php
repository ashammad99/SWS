@extends('layouts.master')
@section('title')
    SWS - Roles List
@stop
@section('css')
<style>
    td {
overflow: hidden;
max-width: 100px;
word-wrap: break-word;
}

</style>
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Users</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    Roles</span>
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
                        <h4 class="card-title mg-b-0">ROLES TABLE</h4>
                        <div class="btn-icon-list">
                            <button class="btn btn-success btn-icon" data-toggle="modal" data-target="#modaldemo3"><i
                                    class="typcn typcn-document-add"></i></button>
                        </div>
                    </div>


                </div>
                <div class="card-body">
                    <div class="table-responsive border-top userlist-table">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <table class="table card-table table-striped table-vcenter text-nowrap mb-0">
                            <thead>
                                <tr>
                                    <th class="wd-lg-20p">Name</th>
                                    <th class="wd-lg-9p">Permissions</th>
                                    <th class="wd-lg-20p">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        <div class="tags">
                                            @foreach($role->permissions as $per)
                                            <span class="tag tag-gray-dark">{{$per->name}}</span>
                                            @endforeach
                                        </div>   
                                    </td>
                                    <td>
                                        <a href="{{route('roles.perimissions',$role->id)}}" class="btn btn-sm btn-primary">
                                            <i class="las la-cog"></i>
                                        </a>
                                        <a href="" data-id="{{ $role->id }}"
                                            data-name="{{ $role->name }}" 
                                            data-target="#modaldemo2" data-toggle="modal" class="btn btn-sm btn-info">
                                            <i class="las la-pen"></i>
                                        </a>
                                        <a href="" data-id="{{ $role->id }}"
                                            data-name="{{ $role->name }}" data-target="#modaldemo1"
                                            data-toggle="modal" class="btn btn-sm btn-danger">
                                            <i class="las la-trash"></i>
                                        </a>
                                    </td>
                                    </tr>
                                @endforeach
                                <tr>
                            </tbody>
                        </table>
                    </div>

                    <ul class="pagination mt-4 mb-0 float-left">
                        <li class="page-item page-prev disabled">
                            <a class="page-link" href="#" tabindex="-1">Prev</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item page-next">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div><!-- COL END -->
    </div>
    <!-- row closed  -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
    <!-- Create Permission modal -->
    <div class="modal" id="modaldemo3">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Create Role</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form method="post" action="{{ route('roles.store') }}">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="id" name="id">
                        <div class="">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Role Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter Role">
                                @if ($errors->has('name'))
                                    <div class="error" style="color: red;">{{ $errors->first('name') }}</div>
                                @endif
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">

                        <button class="btn ripple btn-success" type="submit">Create</button>

                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--End Create Role modal -->
        <!-- Delete Role modal -->
        <div class="modal" id="modaldemo1">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Confirmation</h6><button aria-label="Close" class="close" data-dismiss="modal"
                            type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="{{ route('roles.delete', 'test') }}">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            <input type="hidden" id="id" name="id">
                            <h6 style="color:red">Warning !!</h6>
                            <p>Are You Sure You Want Delete <b id="per_name"></b> Role.</p>
                        </div>
                        <div class="modal-footer">
    
                            <button class="btn ripple btn-danger" type="submit">Delete</button>
    
                            <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Delete Role modal -->
        <!-- Edit Role modal -->
        <div class="modal" id="modaldemo2">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Edit Role</h6><button aria-label="Close" class="close"
                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form method="post" action="{{route('roles.update1')}}">
                        @csrf
                            <div class="modal-body">
                            <input type="hidden" id="id" name="id">
                            <div class="">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Role Name</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="Enter Role" value="{{$role->name}}">
                                        @if($errors->has('name'))
                                        <div class="error" style="color: red;">{{ $errors->first('name') }}</div>
                                        @endif
                                </div>
    
                            </div>
                        </div>
                        <div class="modal-footer">
    
                            <button class="btn ripple btn-info" type="submit">Update</button>
    
                            <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Edit Role modal -->
@endsection
@section('js')
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script>
        $('#modaldemo1').on('show.bs.modal', function(event) {
            console.log('Modal open');
            var button = $(event.relatedTarget) // Button that triggered the modal
            var id = button.data('id')
            var name = button.data('name') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('.modal-body #id').val(id)
            modal.find('.modal-body #name').val(name)
            document.getElementById("per_name").innerHTML = name;
        })
    </script>
    <script>
        $('#modaldemo2').on('show.bs.modal', function(event) {
            console.log('Modal open2');
            var button = $(event.relatedTarget) // Button that triggered the modal
            var id = button.data('id')
            var name = button.data('name')
            // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('.modal-body #id').val(id)
            modal.find('.modal-body #name').val(name)
            

        })
    </script>
@endsection
