@extends('layouts.main')
@section('title', 'Railway')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/datedropper/datedropper.min.css') }}">
    @endpush


    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-unlock bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Railway Concession')}}</h5>
                            <span>{{ __('Apply for Railway Concession')}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ url('dashboard') }}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">{{ __('Railway')}}</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <!-- start message area-->
            @include('include.message')
            <!-- end message area-->
            <!-- only those have manage_branch branch will get access -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h3>{{ __('Add Result')}}</h3></div>
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{url('railway/create')}}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="class">{{ __('Class of Travel')}}<span class="text-red">*</span></label>
                                        {!! Form::select('class', $class, null,[ 'class'=>'form-control select2']) !!}
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="period">{{ __('Period')}}<span class="text-red">*</span></label>
                                        {!! Form::select('period', $period, null,[ 'class'=>'form-control select2']) !!}
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="from">{{ __('From Station')}}<span class="text-red">*</span></label>
                                        {!! Form::select('from', $station, null,[ 'class'=>'form-control select2']) !!}
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="to">{{ __('To Station')}}<span class="text-red">*</span></label>
                                        {!! Form::select('to', array('Panvel'=>'Panvel'), null,[ 'class'=>'form-control select2']) !!}
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="option">{{ __('New / Renew Application')}}<span class="text-red">*</span></label>
                                        <select class="form-control options" name="option" id="option">
                                            <option value="0">{{ __('New Application')}}</option>
                                            <option value="1">{{ __('Renew Application')}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-rounded">{{ __('Save')}}</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row re">
                                <div class="col-sm-6 re">
                                    <h6>Previous Ticket Details</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2 re">
                                    <div class="form-group">
                                        <label for="ticket_no">{{ __('Ticket No.')}}</label>
                                        <input type="text" class="form-control" id="ticket_no" name="ticket_no" placeholder="eg. J1">
                                    </div>
                                </div>
                                <div class="col-sm-2 re">
                                    <div class="form-group">
                                        <label for="prev_certi_no">{{ __('Previous Certificate No.')}}</label>
                                        <input type="text" class="form-control" id="prev_certi_no" name="prev_certi_no" placeholder="eg. J1">
                                    </div>
                                </div>
                                <div class="col-sm-2 re">
                                    <div class="form-group">
                                        <label for="date_of_expiry">{{ __('Date of Expiry')}}</label>
                                        <input class="form-control" type="date" name="date_of_expiry" id="date_of_expiry"/>
                                    </div>
                                </div>
                                <div class="col-sm-2 re">
                                    <div class="form-group">
                                        <label for="prev_from">{{ __('From Station')}}</label>
                                        {!! Form::select('prev_from', $station, null,[ 'class'=>'form-control select2']) !!}
                                    </div>
                                </div>
                                <div class="col-sm-2 re">
                                    <div class="form-group">
                                        <label for="prev_to">{{ __('To Station')}}</label>
                                        {!! Form::select('prev_to', array('Panvel'=>'Panvel'), null,[ 'class'=>'form-control select2']) !!}
                                    </div>
                                </div>
                                <div class="col-sm-2 re">
                                    <div class="form-group">
                                        <label for="prev_class">{{ __('Class of Travel')}}</label>
                                        {!! Form::select('prev_class', $class, null,[ 'class'=>'form-control select2']) !!}
                                    </div>
                                </div>
{{--                                <div class="col-sm-2">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="remark">{{ __('Remark')}}<span class="text-red">*</span></label>--}}
{{--                                        {!! Form::select('options', $options, null,[ 'class'=>'form-control select2']) !!}--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-sm-4">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="exampleInputEmail3">{{ __('Assigned to Stream')}} </label>--}}
{{--                                        {!! Form::select('stream', $streams, null,[ 'class'=>'form-control select2']) !!}--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="col-sm-4">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label>{{ __('Upload CSV')}}</label>--}}
{{--                                        <input form="form1" type="file" name="csv[]" id="csv" class="file-upload-default">--}}
{{--                                        <div class="input-group col-xs-12">--}}
{{--                                            <input type="text" class="form-control file-upload-info" placeholder="Upload Image">--}}
{{--                                            <span class="input-group-append">--}}
{{--                                                <button class="file-upload-browse btn btn-primary" type="button">{{ __('Upload')}}</button>--}}
{{--                                            </span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card p-3">
                    <div class="card-body">
                        <table id="branch_table" class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('Date')}}</th>
                                    <th>{{ __('Class of Travel')}}</th>
                                    <th>{{ __('Period')}}</th>
                                    <th>{{ __('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- push external js -->
    @push('script')
    <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('plugins/DataTables/Cell-edit/dataTables.cellEdit.js') }}"></script>
    <!--server side branch table script-->
    <script src="{{ asset('js/railway.js') }}"></script>
    <script src="{{ asset('plugins/datedropper/datedropper.min.js') }}"></script>
    <script>
        $('.re').hide();
        $('.options').change(function() {
            if ($(this).val() == 1){
                $('.re').show();
            }else{
                $('.re').hide();
            }
        });
    </script>
    @endpush
@endsection
