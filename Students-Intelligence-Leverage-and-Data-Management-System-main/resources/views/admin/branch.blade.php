@extends('layouts.main')
@section('title', 'Branch')
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
                            <h5>{{ __('Branches')}}</h5>
                            <span>{{ __('Define branches of stream')}}</span>
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
                                <a href="#">{{ __('Branches')}}</a>
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
            @can('manage_branch')
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h3>{{ __('Add Branch')}}</h3></div>
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{url('branch/create')}}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label for="code">{{ __('Code')}}<span class="text-red">*</span></label>
                                        <input type="text" class="form-control" id="code" name="code" placeholder="ex. CO" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="branch">{{ __('Branch')}}<span class="text-red">*</span></label>
                                        <input type="text" class="form-control" id="branch" name="branch" placeholder="Branch Name" required>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="duration">{{ __('Duration')}}<span class="text-red">*</span></label>
                                        <input type="text" class="form-control" id="duration" name="duration" placeholder="In years" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail3">{{ __('Assigned to Stream')}} </label>
                                        {!! Form::select('stream', $streams, null,[ 'class'=>'form-control select2']) !!}
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-rounded">{{ __('Save')}}</button>
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
                                    <th>{{ __('Branch Code')}}</th>
                                    <th>{{ __('Branch')}}</th>
                                    <th>{{ __('Duration in Years')}}</th>
                                    <th>{{ __('Assigned Stream')}}</th>
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
    <script src="{{ asset('js/branch.js') }}"></script>
    @endpush
@endsection
