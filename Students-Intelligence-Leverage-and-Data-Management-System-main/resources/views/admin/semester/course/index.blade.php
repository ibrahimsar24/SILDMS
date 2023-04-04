@extends('layouts.main')
@section('title', 'Semester')
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
                            <h5>{{ __('Semester') }} {{ $semester->number }}</h5>
                            <span>{{ __('Branch')}} {{ $semester->branch->name }}</span>
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
                                <a href="#">{{ __('Semesters')}}</a>
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
            <!-- only those have manage_semester semester will get access -->
        </div>
{{--        <div class="row">--}}
{{--            <div class="col-md-12">--}}
{{--                <div class="card p-3">--}}
{{--                    <div class="card-header"><h3>{{ __('View Courses')}}</h3></div>--}}
{{--                    <div class="card-body">--}}
{{--                        <table id="course_table" class="table">--}}
{{--                            <thead>--}}
{{--                                <tr>--}}
{{--                                    <th>{{ __('Batch')}}</th>--}}
{{--                                    <th>{{ __('Number')}}</th>--}}
{{--                                    <th>{{ __('Assigned Branch')}}</th>--}}
{{--                                    <th>{{ __('Assigned Courses')}}</th>--}}
{{--                                    <th>{{ __('Assigned Professors')}}</th>--}}
{{--                                    <th>{{ __('Action')}}</th>--}}
{{--                                </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="row">--}}
{{--            <div class="col-md-12">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header"><h3>{{ __('Add Students')}}<small><a type="button" class="btn btn-primary float-right"><i class="fa fa-download"></i> {{ __('Download Template')}}</a></small></h3></div>--}}
{{--                    <div class="card-header"><h3 class="d-block w-100">Add Students<small class="float-right"><a href="{{ asset('sample/student_list.csv') }}" download type="button" class="btn btn-success float-right"><i class="fa fa-download"></i> {{ __('Download Template')}}</a></small></h3></div>--}}

{{--                    <div class="card-body">--}}
{{--                        <form class="forms-sample" method="POST" action="{{url('semester/student/add')}}">--}}
{{--                            @csrf--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-sm-4">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="students">{{ __('Student')}}<span class="text-red">*</span></label>--}}
{{--                                        {!! Form::select('students', $students, null,[ 'class'=>'form-control select2', 'id' => 'students']) !!}--}}
{{--                                        <input type="hidden" id="semester_id" name="semester_id" value="{{ $semester->id }}">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-sm-1">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="number">{{ __('Number')}}<span class="text-red">*</span></label>--}}
{{--                                        <input type="number" class="form-control" id="number" name="number" min="1" max="10" placeholder="1-10" required>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="col-sm-3">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="exampleInputEmail3">{{ __('Assign to Branch')}} </label>--}}
{{--                                        {!! Form::select('branch', $branches, null,[ 'class'=>'form-control select2', 'id' => 'branch']) !!}--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-sm-6">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="exampleInputEmail3">{{ __('Assign Courses')}} </label>--}}
{{--                                        {!! Form::select('course[]', $courses, null,[ 'class'=>'form-control select2', 'multiple' => 'multiple', 'id' => 'courses']) !!}--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-sm-1">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <button type="submit" class="btn btn-primary btn-rounded">{{ __('Save')}}</button>--}}
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
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="row">
            <div class="col-md-12">
                <div class="card p-3">
                    <div class="card-header"><h3>{{ __('All Students')}}</h3></div>
                    <div class="card-body">
                        <table id="students_table" class="table">
                            <thead>
                            <tr>
                                <th>{{ __('Roll No.')}}</th>
                                <th>{{ __('Name')}}</th>
                                @if ($course->ut1 != null)
                                <th>{{ __('UT1')}}</th>
                                <th>{{ __('UT2')}}</th>
                                <th>{{ __('IA')}}</th>
                                @endif
                                @if ($course->ese != null)
                                <th>{{ __('ESE')}}</th>
                                @endif
                                @if ($course->tw != null)
                                <th>{{ __('TW')}}</th>
                                @endif
                                @if ($course->oral != null)
                                <th>{{ __('Oral')}}</th>
                                @endif
                                @if ($course->oral_practical != null)
                                <th>{{ __('Oral & Practical')}}</th>
                                @endif
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
    <!--server side semester table script-->
    <script>
        var config = {};
        config.semester = "{{ $semester->id }}";
        config.course = "{{ $code }}";
        config.url = '{{ route('semester.result.update') }}';
        config.token = "{{ csrf_token() }}";
        config.columns = [
            {data:'rollno', name: 'rollno'},
            {data:'name', name: 'name'},
            @if ($course->ut1 != null)
            {data:'ut1', name: 'ut1'},
            {data:'ut2', name: 'ut2'},
            {data:'average', name: 'average'},
            @endif
            @if ($course->ese != null)
            {data:'ese', name: 'ese'},
            @endif
            @if ($course->tw != null)
            {data:'tw', name: 'tw'},
            @endif
            @if ($course->oral != null)
            {data:'oral', name: 'oral'},
            @endif
            @if ($course->oral_practical != null)
            {data:'oral_practical', name: 'oral_practical'},
            @endif
            // {data:'action', name: 'action', orderable:false}
        ];
    </script>
{{--    <script src="{{ asset('js/select_semester.js') }}"></script>--}}
    <script src="{{ asset('js/semester_students_marks.js') }}"></script>
{{--    <script src="{{ asset('js/semester_students_upload.js') }}"></script>--}}

{{--        <script>--}}
{{--            $(document).ready(function(){--}}
{{--                // $('.select2-selection__rendered').select2();--}}
{{--                $('#branch').on('change', function(){--}}
{{--                    var branchID = $(this).val();--}}
{{--                    if(branchID){--}}
{{--                        $.ajax({--}}
{{--                            type:'GET',--}}
{{--                            url:'{{ URL('semester/get-course-list') }}',--}}
{{--                            data:'branch_id='+branchID,--}}
{{--                            success:function(html){--}}
{{--                                console.log(html);--}}
{{--                                $('#courses').html(html);--}}
{{--                            }--}}
{{--                        });--}}
{{--                    }else{--}}
{{--                        $('#courses').html('');--}}
{{--                    }--}}
{{--                });--}}
{{--                var branchID = $('#branch').val();--}}
{{--                if(branchID){--}}
{{--                    $.ajax({--}}
{{--                        type:'GET',--}}
{{--                        url:'{{ URL('semester/get-course-list') }}',--}}
{{--                        data:'branch_id='+branchID,--}}
{{--                        success:function(html){--}}
{{--                            console.log(html);--}}
{{--                            $('#courses').html(html);--}}
{{--                        }--}}
{{--                    });--}}
{{--                }--}}
{{--            });--}}
{{--        </script>--}}
    @endpush
@endsection
