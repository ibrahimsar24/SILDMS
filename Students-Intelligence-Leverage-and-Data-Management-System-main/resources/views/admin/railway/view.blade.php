@extends('layouts.main')
@section('title', 'View Application')
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-file-text bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('View Application')}}</h5>
                            <span>{{ __('Application for Railway Concession')}}</span>
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
                                <a href="{{ url('railway/verify') }}">{{ __('Verify')}}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('View')}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h3 class="d-block w-100" align="center">Anjuman-I-Islam's Kalsekar Technical Campus, New Panvel<small class="float-right">{{ __('Date: ').date_format(date_create($railway->date),"d/m/Y") }}</small></h3></div>
            <div class="card-body">
                <div class="row invoice-info">
                    <div class="col-md-8 offset-md-2">
                        <h5 align="center"><b><u>APPLICATION FOR RAILWAY CONCESSION</u></b></h5>
                        <div class="col-md-12">
                            <h6 align="left">The Director<br><br>Sir,<br><br>
                                Please issue a Student's Certificate for Railway Season Ticket on WESTERN/ CENTRAL/ HARBOUR Railway as under. I am a bonafied student of your college.
                            </h6><br>
                        </div>
                            <table class="table table-bordered border-dark">
                                <thead>
                                <tr align="center">
                                    <th scope="col"><h6>Class of Travel</h6></th>
                                    <th scope="col"><h6>Period</h6></th>
                                    <th scope="col"><h6>From</h6></th>
                                    <th scope="col"><h6>To</h6></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr align="center">
                                    <td><h6>{{ $railway->class == 1 ? "First Class" : "Second Class" }}</h6></td>
                                    <td><h6>{{ $railway->period == 1 ? "Monthly" : "Quarterly" }}</h6></td>
                                    <td><h6>{{ $railway->from }}</h6></td>
                                    <td><h6>{{ $railway->to }}</h6></td>
                                </tr>
                                </tbody>
                            </table>
                        <div class="col-md-12">
                            <br>
                            <h6>My particulars: Full name: <u>{{ $railway->user->name }}</u><br><br>

                                Branch: <u>{{ $railway->user->branch->name }}</u>

                                Year: <u>{{ $railway->user->year_of_study }}</u>

                                Roll No.: <u>{{ $railway->user->rollno }}</u>

                                Date of Birth: <u>{{ date_format(date_create($railway->user->dob),"d/m/Y") }}</u><br><br>

                                Age: <u>{{ $age->y }}</u> Years <u>{{ $age->m }}</u> Months. At present I held Railway Season<br><br>

                                Ticket No. <u>{{ $railway->ticket_no }}</u>

                                Previous Certificate No. <u>{{ $railway->prev_certi_no }}</u>

                                Date of Expiry <u>{{ $railway->date_of_expiry }}</u><br><br>

                                From <u>{{ $railway->prev_from }}</u>

                                To <u>{{ $railway->prev_to }}</u>

                                Class <u>{{ $railway->prev_class == 1 ? "First Class" : "Second Class" }}</u><br><br>

                                Residential Address is <u>{{ $railway->user->address }}</u><br><br>

                                Note: The Certificate will be issued after THREE DAYS from the date of receipt of application.
                            </h6>
                            <br>
                        </div>
                        <div class="row no-print">
                            <div class="col-md-12" align="center">
                                <a href="{{ url('railway/accept/'.$railway->id) }}" type="button" class="btn btn-success pull-right"><i class="fa fa-check-circle"></i> {{ __('Accept Application')}}</a>
                                <a href="{{ url('railway/delete/'.$railway->id) }}" type="button" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> {{ __('Delete Application')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

