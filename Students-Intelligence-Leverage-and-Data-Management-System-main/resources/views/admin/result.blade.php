@extends('layouts.main')
@section('title', 'Results')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">
    @endpush


    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-unlock bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Results')}}</h5>
                            <span>{{ __('Displays Results of students')}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="../index.html"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">{{ __('Results')}}</a>
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
            @can('manage_result')
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h3>{{ __('Add Result')}}</h3></div>
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{url('result/create')}}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="rollno">{{ __('Roll no')}}<span class="text-red">*</span></label>
                                        {!! Form::select('users', $users, null,[ 'class'=>'form-control select2']) !!}
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label for="sem">{{ __('Semester')}}<span class="text-red">*</span></label>
                                        <input type="number" class="form-control" id="sem" name="sem" placeholder="eg. 8" required>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label for="sgpi">{{ __('SGPI')}}<span class="text-red">*</span></label>
                                        <input type="number" step="0.01" aria-valuemax="10" class="form-control" id="sgpi" name="sgpi" placeholder="eg. 8.75" required>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label for="credits">{{ __('Credits')}}<span class="text-red">*</span></label>
                                        <input type="number" aria-valuemax="27" class="form-control" id="credits" name="credits" placeholder="< 27" required>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label for="cxgp">{{ __('CxGP')}}<span class="text-red">*</span></label>
                                        <input type="number" aria-valuemax="270" class="form-control" id="cxgp" name="cxgp" placeholder="< 270" required>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label for="attempt">{{ __('Attempt')}}<span class="text-red">*</span></label>
                                        <input type="number" class="form-control" id="attempt" name="attempt" placeholder="eg. 1" required>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="remark">{{ __('Remark')}}<span class="text-red">*</span></label>
                                        {!! Form::select('options', $options, null,[ 'class'=>'form-control select2']) !!}
                                    </div>
                                </div>
{{--                                <div class="col-sm-4">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="exampleInputEmail3">{{ __('Assigned to Stream')}} </label>--}}
{{--                                        {!! Form::select('stream', $streams, null,[ 'class'=>'form-control select2']) !!}--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-rounded">{{ __('Save')}}</button>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>{{ __('Upload CSV')}}</label>
                                        <input form="form1" type="file" name="csv[]" id="csv" class="file-upload-default">
                                        <div class="input-group col-xs-12">
                                            <input type="text" class="form-control file-upload-info" placeholder="Upload Image">
                                            <span class="input-group-append">
                                                <button class="file-upload-browse btn btn-primary" type="button">{{ __('Upload')}}</button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endcan
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card p-3">
                    <div class="card-body">
                        <table id="branch_table" class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('Roll No')}}</th>
                                    <th>{{ __('Name')}}</th>
                                    <th>{{ __('Semester')}}</th>
                                    <th>{{ __('SGPI')}}</th>
                                    <th>{{ __('Attempt')}}</th>
                                    <th>{{ __('Remark')}}</th>
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
    <script src="{{ asset('js/result.js') }}"></script>
    <script src="{{ asset('js/form-result.js') }}"></script>
    @endpush
@endsection
