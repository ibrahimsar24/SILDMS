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
                            <h5>{{ __('Semesters')}}</h5>
                            <span>{{ __('Define semesters of branch')}}</span>
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
            @can('manage_semester')
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h3>{{ __('Add Semester')}}</h3></div>
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{url('semester/create')}}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label for="batch">{{ __('Batch')}}<span class="text-red">*</span></label>
                                        <input type="number" class="form-control" id="batch" name="batch" min="1000" max="9999" placeholder="Batch" required>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label for="number">{{ __('Number')}}<span class="text-red">*</span></label>
                                        <input type="number" class="form-control" id="number" name="number" min="1" max="10" placeholder="1-10" required>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail3">{{ __('Assign to Branch')}} </label>
                                        {!! Form::select('branch', $branches, null,[ 'class'=>'form-control select2', 'id' => 'branch']) !!}
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail3">{{ __('Assign Courses')}} </label>
                                        {!! Form::select('course[]', $courses, null,[ 'class'=>'form-control select2', 'multiple' => 'multiple', 'id' => 'courses']) !!}
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
                        <table id="semester_table" class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('Batch')}}</th>
                                    <th>{{ __('Number')}}</th>
                                    <th>{{ __('Assigned Branch')}}</th>
                                    <th>{{ __('Assigned Courses')}}</th>
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
    <!--server side semester table script-->
    <script src="{{ asset('js/semester.js') }}"></script>
        <script>
            $(document).ready(function(){
                // $('.select2-selection__rendered').select2();
                $('#branch').on('change', function(){
                    var branchID = $(this).val();
                    if(branchID){
                        $.ajax({
                            type:'GET',
                            url:'/semester/get-course-list/'+branchID,
                            // data:'branch_id='+branchID,
                            // data: { branch_id: branchID },
                            {{--headers: {--}}
                            {{--    'X-CSRF-TOKEN': '{{ csrf_token() }}'--}}
                            {{--},--}}
                            success:function(html){
                                console.log(html);
                                $('#courses').html(html);
                            }
                        });
                    }else{
                        $('#courses').html('');
                    }
                });
                var branchID = $('#branch').val();
                if(branchID){
                    $.ajax({
                        type:'GET',
                        url:'/semester/get-course-list/'+branchID,
                        // data:'branch_id='+branchID,
                        // data: { branch_id: branchID },
                        {{--headers: {--}}
                        {{--    'X-CSRF-TOKEN': '{{ csrf_token() }}'--}}
                        {{--},--}}
                        success:function(html){
                            console.log(html);
                            $('#courses').html(html);
                        }
                    });
                }
            });
        </script>
    @endpush
@endsection
