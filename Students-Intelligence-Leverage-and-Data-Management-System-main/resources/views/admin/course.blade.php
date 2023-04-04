@extends('layouts.main')
@section('title', 'Course')
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
                            <h5>{{ __('Courses')}}</h5>
                            <span>{{ __('Define courses of branch')}}</span>
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
                                <a href="#">{{ __('Courses')}}</a>
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
            <!-- only those have manage_course course will get access -->
            @can('manage_course')
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="d-block w-100">Add Course
                            <small class="float-right"><a href="{{ asset('sample/courses_import.csv') }}" download type="button" class="btn btn-success float-right"><i class="fa fa-download"></i> {{ __('Download Import Template')}}</a></small><pre  class="float-right"> </pre>
                            <small class="float-right">
                                <input form="form1" type="file" name="csv[]" id="csv" class="file-upload-default" hidden>
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" placeholder="Upload Image">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-primary" type="button">{{ __('Upload')}}</button>
                                    </span>
                                </div>
                            </small>
                        </h3>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{url('course/create')}}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label for="code">{{ __('Code')}}<span class="text-red">*</span></label>
                                        <input type="text" class="form-control" id="code" name="code" placeholder="Code" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="course">{{ __('Course')}}<span class="text-red">*</span></label>
                                        <input type="text" class="form-control" id="course" name="course" placeholder="Course Name" required>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="credits">{{ __('Credits')}}<span class="text-red">*</span></label>
                                        <input type="number" class="form-control" id="credits" name="credits" placeholder="Total credits" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail3">{{ __('Assigned to Branch')}} </label>
                                        {!! Form::select('branch', $branches, null,[ 'class'=>'form-control select2']) !!}
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-rounded">{{ __('Save')}}</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="ut1">{{ __('UT1')}}</label>
                                        <input type="number" class="form-control" id="ut1" name="ut1" placeholder="Total marks">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="ut2">{{ __('UT2')}}</label>
                                        <input type="number" class="form-control" id="ut2" name="ut2" placeholder="Total marks">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="ese">{{ __('ESE')}}</label>
                                        <input type="number" class="form-control" id="ese" name="ese" placeholder="Total marks">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="tw">{{ __('TW')}}</label>
                                        <input type="number" class="form-control" id="tw" name="tw" placeholder="Total marks">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="oral">{{ __('Oral')}}</label>
                                        <input type="number" class="form-control" id="oral" name="oral" placeholder="Total marks">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="oral_practical">{{ __('Oral & Practical')}}</label>
                                        <input type="number" class="form-control" id="oral_practical" name="oral_practical" placeholder="Total credits">
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
                        <table id="course_table" class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('Course Code')}}</th>
                                    <th>{{ __('Course')}}</th>
                                    <th>{{ __('Total Credits')}}</th>
                                    <th>{{ __('UT1')}}</th>
                                    <th>{{ __('UT2')}}</th>
                                    <th>{{ __('ESE')}}</th>
                                    <th>{{ __('TW')}}</th>
                                    <th>{{ __('Oral')}}</th>
                                    <th>{{ __('Oral & Practical')}}</th>
                                    <th>{{ __('Assigned Branch')}}</th>
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
    <!--server side course table script-->
    <script src="{{ asset('js/course.js') }}"></script>
    <script>
        var config = {};
        config.url = '{{ route('users.upload') }}';
        config.token = "{{ csrf_token() }}";
    </script>
    <script src="{{ asset('js/upload_courses.js') }}"></script>
    @endpush
@endsection
