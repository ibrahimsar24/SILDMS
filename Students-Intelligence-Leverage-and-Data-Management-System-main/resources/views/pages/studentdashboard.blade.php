@extends('layouts.main')
@section('title', 'Dashboard')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/weather-icons/css/weather-icons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/owl.carousel/dist/assets/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/owl.carousel/dist/assets/owl.theme.default.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/chartist/dist/chartist.min.css') }}">
    @endpush

    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-layers bg-blue"></i>
                    <div class="d-inline">
                        <h5>{{ __('Student Dashboard')}}</h5>
                        <span>{{ __('Short summary of all your academic activities.')}}</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('dashboard')}}"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">{{ __('Student')}}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Dashboard')}}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- Round Chart statustc card start -->
        <div class="col-xl-3 col-md-6">
            <div class="card card-red st-cir-card text-white">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <div id="status-round-1" class="chart-shadow st-cir-chart" >
                                <h5>40%</h5>
                            </div>
                        </div>
                        <div class="col text-center">
                            <h3 class=" fw-700 mb-5">4/10</h3>
                            <h6 class="mb-0 ">Mentorship lectures Attendend</h6>
                        </div>
                    </div>
                    <span class="st-bt-lbl">40</span>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-blue st-cir-card text-white">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <div id="status-round-2" class="chart-shadow st-cir-chart" >
                                <h5>56%</h5>
                            </div>
                        </div>
                        <div class="col text-center">
                            <h3 class="fw-700 mb-5">56%</h3>
                            <h6 class="mb-0">Progress in current Semester</h6>
                        </div>
                    </div>
                    <span class="st-bt-lbl">56</span>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-green st-cir-card text-white">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <div id="status-round-3" class="chart-shadow st-cir-chart" >
                                <h5>75%</h5>
                            </div>
                        </div>
                        <div class="col text-center">
                            <h3 class="fw-700 mb-5">8.46</h3>
                            <h6 class="mb-0">CGPA of all the Semesters</h6>
                        </div>
                    </div>
                    <span class="st-bt-lbl">75</span>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-yellow st-cir-card text-white">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <div id="status-round-4" class="chart-shadow st-cir-chart" >
                                <h5>40%</h5>
                            </div>
                        </div>
                        <div class="col text-center">
                            <h3 class="fw-700 mb-5">2/5</h3>
                            <h6 class="mb-0">Subjects Requires more Focus</h6>
                        </div>
                    </div>
                    <span class="st-bt-lbl">40</span>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-4">
            <div class="card">
                <div class="card-header">
                    <h3>{{ __('Overall Attendence of the month')}}</h3>
                </div>
                <div class="card-block text-center">
                    <div id="angular_guage" class="chart-shadow"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-xl-8">
            <div class="card">
                <div class="card-header">
                    <h3>{{ __('Attendence this semester')}}</h3>
                </div>
                <div class="card-block text-center">
                    <div id="line_chart" class="chart-shadow"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h3>{{ __('Semester Results')}}</h3>
                </div>
                <div class="card-block text-center">
                    <div id="lineChart_area" class="chart-shadow "></div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h3>{{ __('Skill Set')}}</h3>
                </div>
                <div class="card-block chart-shadow">
                    <div id="skills_chart">
                        <h6 class="mt-30">{{ __('Wordpress')}} <span class="pull-right">80%</span></h6>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:80%;"> <span class="sr-only">50% Complete</span> </div>
                    </div>
                    <h6 class="mt-30">{{ __('HTML 5')}} <span class="pull-right">90%</span></h6>
                    <div class="progress  progress-sm">
                        <div class="progress-bar bg-info" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width:90%;"> <span class="sr-only">50% Complete</span> </div>
                    </div>
                    <h6 class="mt-30">{{ __('jQuery')}} <span class="pull-right">50%</span></h6>
                    <div class="progress  progress-sm">
                        <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%;"> <span class="sr-only">50% Complete</span> </div>
                    </div>
                    <h6 class="mt-30">{{ __('Photoshop')}} <span class="pull-right">70%</span></h6>
                    <div class="progress  progress-sm">
                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%;"> <span class="sr-only">50% Complete</span> </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-12">
            <div class="card proj-t-card">
                <div class="card-body">
                    <div class="row align-items-center mb-30">
                        <div class="col-auto">
                            <i class="far fa-calendar-check text-red f-30"></i>
                        </div>
                        <div class="col pl-0">
                            <h6 class="mb-5">Timely Submissions</h6>
                            <h6 class="mb-0 text-red">Assignments</h6>
                        </div>
                    </div>
                    <div class="row align-items-center text-center">
                        <div class="col">
                            <h6 class="mb-0">This semester</h6></div>
                        <div class="col"><i class="fas fa-exchange-alt text-red f-18"></i></div>
                        <div class="col">
                            <h6 class="mb-0">2/5</h6></div>
                    </div>
                    <h6 class="pt-badge bg-red">40%</h6>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card proj-t-card">
                <div class="card-body">
                    <div class="row align-items-center mb-30">
                        <div class="col-auto">
                            <i class="fas fa-paper-plane text-green f-30"></i>
                        </div>
                        <div class="col pl-0">
                            <h6 class="mb-5">Project Completion</h6>
                            <h6 class="mb-0 text-green">Progress</h6>
                        </div>
                    </div>
                    <div class="row align-items-center text-center">
                        <div class="col">
                            <h6 class="mb-0">This week</h6></div>
                        <div class="col"><i class="fas fa-exchange-alt text-green f-18"></i></div>
                        <div class="col">
                            <h6 class="mb-0">+4 modules</h6></div>
                    </div>
                    <h6 class="pt-badge bg-green">76%</h6>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card proj-t-card">
                <div class="card-body">
                    <div class="row align-items-center mb-30">
                        <div class="col-auto">
                            <i class="fas fa-lightbulb text-yellow f-30"></i>
                        </div>
                        <div class="col pl-0">
                            <h6 class="mb-5">Placements</h6>
                            <h6 class="mb-0 text-yellow">Through oncampus/offcampus</h6>
                        </div>
                    </div>
                    <div class="row align-items-center text-center">
                        <div class="col">
                            <h6 class="mb-0">Offer Letters</h6></div>
                        <div class="col"><i class="fas fa-exchange-alt text-yellow f-18"></i></div>
                        <div class="col">
                            <h6 class="mb-0">3</h6></div>
                    </div>
                    <h6 class="pt-badge bg-yellow">100%</h6>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header d-block">
                <h3>{{ __('Tasks and Completions')}}</h3>
            </div>
            <div class="card-body p-0 table-border-style">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Task')}}</th>
                                <th>{{ __('Subject')}}</th>
                                <th>{{ __('Deadline')}}</th>
                                <th>{{ __('Status')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="table-danger">
                                <th scope="row">1</th>
                                <td>HMI Experiment 1</td>
                                <td>Prof. Mukhtar Ansari</td>
                                <td>19-01-2022</td>
                                <td>Pending</td>
                            </tr>
                            <tr class="table-danger">
                                <th scope="row">2</th>
                                <td>NLP Experiment 3</td>
                                <td>Prof. Rehaal Qureshi</td>
                                <td>21-02-2022</td>
                                <td>Pending</td>
                            </tr>
                            <tr class="table-warning">
                                <th scope="row">3</th>
                                <td>DC Experiment 1</td>
                                <td>Prof. Samreen Banu</td>
                                <td>05-03-2022</td>
                                <td>Pending</td>
                            </tr>
                            <tr>
                                <th scope="row">4</th>
                                <td>CCL Experiment 1</td>
                                <td>Prof Rehaal Qureshi</td>
                                <td>10-03-2022</td>
                                <td>Pending</td>
                            </tr>
                            <tr>
                                <th scope="row">5</th>
                                <td>HMI Experiment 2</td>
                                <td>Prof. Mukhtar Ansari</td>
                                <td>13-03-2022</td>
                                <td>Pending</td>
                            </tr>
                            <tr>
                                <th scope="row">6</th>
                                <td>DC Experiment 2</td>
                                <td>Prof. Samreen Banu</td>
                                <td>15-03-2022</td>
                                <td>Pending</td>
                            </tr>
                            <tr class="table-success">
                                <th scope="row">7</th>
                                <td>NLP Experiment 1</td>
                                <td>Prof Rehaal Qureshi</td>
                                <td>19-02-2022</td>
                                <td>Done</td>
                            </tr>
                            <tr class="table-success">
                                <th scope="row">8</th>
                                <td>NLP Experiment 2</td>
                                <td>Prof Rehaal Qureshi</td>
                                <td>19-02-2022</td>
                                <td>Done</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @push('script')
        <script src="{{ asset('plugins/amcharts/amcharts.js') }}"></script>
        <script src="{{ asset('plugins/amcharts/gauge.js') }}"></script>
        <script src="{{ asset('plugins/amcharts/serial.js') }}"></script>
        <script src="{{ asset('plugins/amcharts/themes/light.js') }}"></script>
        <script src="{{ asset('plugins/amcharts/animate.min.js') }}"></script>
        <script src="{{ asset('plugins/amcharts/pie.js') }}"></script>
        <script src="{{ asset('plugins/ammap3/ammap/ammap.js') }}"></script>
        <script src="{{ asset('plugins/ammap3/ammap/maps/js/usaLow.js') }}"></script>
        <script src="{{ asset('js/chart-amcharts.js') }}"></script>
        <script src="{{ asset('plugins/chartist/dist/chartist.min.js') }}"></script>
        <script src="{{ asset('js/chart-chartist.js') }}"></script>
    @endpush
@endsection
