@extends('layouts.master')
@section('title')
    SWS - Dashboard
@endsection
@section('css')
    <link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('assets/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
                <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">Hi {{Auth::user()->name_en}}, welcome back!</h2>
            </div>
        </div>

    </div>
    <!-- /breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        @role('Admin')
        <div class="col-lg-3 col-md-4">
            <div class="card  bg-primary-gradient">
                <div class="card-body">
                    <div class="counter-status d-flex md-mb-0">
                        <div class="counter-icon">
                            <i class="icon icon-people"></i>
                        </div>
                        <div class="mr-auto">
                            <h5 class="tx-13 tx-white-8 mb-3">Users</h5>
                            <h2 class="counter mb-0 text-white">{{$count_users}}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endrole

        @role('Social Researcher')
        <div class="col-lg-3 col-md-6">
            <div class="card  bg-danger-gradient">
                <div class="card-body">
                    <div class="counter-status d-flex md-mb-0">
                        <div class="counter-icon text-warning">
                            <i class="icon icon-user-female"></i>
                        </div>
                        <div class="mr-auto">
                            <h5 class="tx-13 tx-white-8 mb-3">Children who are being cared</h5>
                            <h2 class="counter mb-0 text-white">{{$count_cared_children}}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endrole

        @role('Supervisor')
        <div class="col-lg-3 col-md-6">
            <div class="card  bg-danger-gradient">
                <div class="card-body">
                    <div class="counter-status d-flex md-mb-0">
                        <div class="counter-icon text-warning">
                            <i class="icon icon-user-female"></i>
                        </div>
                        <div class="mr-auto">
                            <h5 class="tx-13 tx-white-8 mb-3">Total Children</h5>
                            <h2 class="counter mb-0 text-white">{{$count_children}}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card  bg-success-gradient">
                <div class="card-body">
                    <div class="counter-status d-flex md-mb-0">
                        <div class="counter-icon text-warning">
                            <i class="icon icon-user-female"></i>
                        </div>
                        <div class="mr-auto">
                            <h5 class="tx-13 tx-white-8 mb-3">Total Governorates</h5>
                            <h2 class="counter mb-0 text-white">{{$governorates_count}}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card  bg-danger-gradient">
                <div class="card-body">
                    <div class="counter-status d-flex md-mb-0">
                        <div class="counter-icon text-primary">
                            <i class="icon icon-docs"></i>
                        </div>
                        <div class="mr-auto">
                            <h5 class="tx-13 tx-white-8 mb-3">Total Areas</h5>
                            <h2 class="counter mb-0 text-white">{{$areas_count}}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endrole
    </div>
    <br>
    @role('Admin')
    <div class="row row-sm">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <p><b>Pie Chart For Users Role</b></p>
                    <canvas id="chartRole"></canvas>
                </div>
            </div>
        </div>
    </div>
    @endrole

    @role('Supervisor')
    <div class="row row-sm">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <p><b>Pie Chart For Distribution Children by Governorates</b></p>
                    <canvas id="chartGovernorates"></canvas>
                </div>
            </div>
        </div>
    </div>
    @endrole

    @role('Social Researcher')
    <div class="row row-sm">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <p><b>Pie Chart For Children Category</b></p>
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <p><b>Pie Chart For Children Gender</b></p>
                    <canvas id="myChart1"></canvas>
                </div>
            </div>
        </div>
    </div>
    @endrole
    <!-- Container closed -->
@endsection
@section('js')
    <script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js')}}"></script>
    <!-- Internal Select2 js-->
    <script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
    <!-- Internal Chart flot js -->
    <script src="{{URL::asset('assets/js/chart.flot.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/raphael/raphael.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js')}}"></script>
    <script src="{{URL::asset('assets/js/dashboard.sampledata.js')}}"></script>
    <script src="{{URL::asset('assets/js/chart.flot.sampledata.js')}}"></script>
    <script src="{{URL::asset('assets/js/apexcharts.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
    <script src="{{URL::asset('assets/js/modal-popup.js')}}"></script>
    <script src="{{URL::asset('assets/js/index.js')}}"></script>
    <script src="{{URL::asset('assets/js/jquery.vmap.sampledata.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/counters/counterup.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/counters/waypoints.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/counters/counterup.min.js')}}"></script>
    <!--Internal Time Counter -->
    <script src="{{URL::asset('assets/plugins/counters/jquery.missofis-countdown.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/counters/counter.js')}}"></script>
    <script src="{{URL::asset('assets/js/chart.chartjs.js')}}"></script>
    <script src="{{URL::asset('assets/js/apexcharts.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var role_data = @json($role_data);
        var role_labels = role_data.map(item => item.label);
        var role_values = role_data.map(item => item.value);
        const ctx1 = document.getElementById('chartRole');
        new Chart(ctx1, {
            type: 'pie',
            data: {
                labels: role_labels,
                datasets: [{
                    label: '# of Users',
                    data: role_values,
                    backgroundColor: [
                        'rgba(15, 10, 222,1)',
                        'rgba(255, 255, 0, 1)',
                        'rgba(0, 128, 0, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var category_data = @json($category_data);
        var category_labels = category_data.map(item => item.label);
        var category_values = category_data.map(item => item.value);
        const ctx2 = document.getElementById('myChart');
        new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: category_labels,
                datasets: [{
                    label: '# of Children',
                    data: category_values,
                    backgroundColor: [
                        'rgba(15, 10, 222,1)',
                        'rgba(255, 255, 0, 1)',
                        'rgba(0, 128, 0, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var gender_data = @json($gender_data);
        var gender_labels = gender_data.map(item => item.label);
        var gender_values = gender_data.map(item => item.value);
        const ctx3 = document.getElementById('myChart1');
        new Chart(ctx3, {
            type: 'pie',
            data: {
                labels: gender_labels,
                datasets: [{
                    label: '# of Children',
                    data: gender_values,
                    backgroundColor: [
                        'rgba(15, 10, 222,1)',
                        'rgba(255, 255, 0, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <script>
        var Governorate_data = @json($Governorate_data);
        var Governorate_labels = Governorate_data.map(item => item.label);
        var Governorate_values = Governorate_data.map(item => item.value);
        const ctx4 = document.getElementById('chartGovernorates');
        new Chart(ctx4, {
            type: 'pie',
            data: {
                labels: Governorate_labels,
                datasets: [{
                    label: '# of Children',
                    data: Governorate_values,
                    backgroundColor: [
                        'rgba(15, 10, 222,1)',
                        'rgba(255, 255, 0, 1)',
                        'rgba(0, 128, 0, 1)',
                        'rgba(255, 0, 0, 1)',
                        'rgba(211, 84, 0,1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection
