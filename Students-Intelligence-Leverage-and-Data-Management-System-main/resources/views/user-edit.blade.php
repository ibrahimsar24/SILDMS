@extends('layouts.main')
@section('title', $user->name)
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/yearpicker.css') }}">
    @endpush


    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-user-plus bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Edit User')}}</h5>
                            <span>{{ __('Create new user, assign roles & permissions')}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{url('/')}}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">{{ __('User')}}</a>
                            </li>
                            <li class="breadcrumb-item">
                                <!-- clean unescaped data is to avoid potential XSS risk -->
                                {{ clean($user->name, 'titles')}}
                            </li>

                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- start message area-->
            @include('include.message')
            <!-- end message area-->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ url('user/update') }}" >
                        @csrf
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <div class="row">
                                <div class="col-sm-6">

                                    <div class="form-group">
                                        <label for="name">{{ __('Name')}}<span class="text-red">*</span></label>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ clean($user->name, 'titles')}}" required>
                                        <div class="help-block with-errors"></div>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="rollno">{{ __('Username')}}<span class="text-red">*</span></label>
                                        <input id="rollno" type="text" class="form-control @error('rollno') is-invalid @enderror" name="rollno" value="{{ clean($user->rollno, 'titles')}}" required>
                                        <div class="help-block with-errors"></div>

                                        @error('rollno')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email">{{ __('Email')}}<span class="text-red">*</span></label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ clean($user->email, 'titles')}}" required>
                                        <div class="help-block with-errors"></div>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email2">{{ __('Secondary Email')}}<span class="text-red">*</span></label>
                                        <input id="email2" type="email" class="form-control @error('email2') is-invalid @enderror" name="email2" value="{{ clean($user->email2, 'titles')}}" placeholder="Enter Secondary Email" required>
                                        <div class="help-block with-errors"></div>

                                        @error('email2')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">{{ __('Phone')}}<span class="text-red">*</span></label>
                                        <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ clean($user->phone, 'titles')}}" placeholder="Excluding +91" required>
                                        <div class="help-block with-errors"></div>

                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="address">{{ __('Address')}}<span class="text-red">*</span></label>
                                        <textarea id="address" required class="form-control @error('address') is-invalid @enderror" name="address" placeholder="Home address" rows="4">{{ clean($user->address, 'titles')}}</textarea>
                                        <div class="help-block with-errors"></div>

                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="branch">{{ __('Branch')}}<span class="text-red">*</span></label>
                                        {!! Form::select('branch', $branches, $user->branch_id,[ 'class'=>'form-control select2']) !!}
                                        <div class="help-block with-errors"></div>

                                        @error('branch')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="gender">{{ __('Gender')}}<span class="text-red">*</span></label>
                                        <select class="form-control select2" name="gender">
                                            <option value="1" @if($user->gender == 1) selected @endif>{{ __('Male')}}</option>
                                            <option value="0" @if($user->gender == 0) selected @endif>{{ __('Female')}}</option>
                                        </select>
                                        <div class="help-block with-errors"></div>

                                        @error('gender')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="yos">{{ __('Year of study')}}<span class="text-red">*</span></label>
                                        <select class="form-control select2" name="yos">
                                            <option value="1" @if($user->year_of_study == 1) selected @endif>{{ __('First Year')}}</option>
                                            <option value="2" @if($user->year_of_study == 2) selected @endif>{{ __('Second Year')}}</option>
                                            <option value="3" @if($user->year_of_study == 3) selected @endif>{{ __('Third Year')}}</option>
                                            <option value="4" @if($user->year_of_study == 4) selected @endif>{{ __('Fourth Year')}}</option>
                                            <option value="5" @if($user->year_of_study == 5) selected @endif>{{ __('Fifth Year')}}</option>
                                        </select>
                                        <div class="help-block with-errors"></div>

                                        @error('yos')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="dob">{{ __('Date of Birth')}}<span class="text-red">*</span></label>
                                        <input id="dob" type="date" class="form-control @error('dob') is-invalid @enderror" name="dob" value="{{ clean($user->dob, 'titles')}}" required>
                                        <div class="help-block with-errors"></div>

                                        @error('dob')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cursem">{{ __('Current Semester')}}<span class="text-red">*</span></label>
                                        <input id="cursem" type="number" class="form-control @error('cursem') is-invalid @enderror" name="cursem" value="{{ clean($user->current_semester, 'titles')}}" placeholder="ex. 8" required>
                                        <div class="help-block with-errors"></div>

                                        @error('cursem')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="batchyear">{{ __('Batch Year')}}<span class="text-red">*</span></label>
                                        <input id="batchyear" type="text" class="form-control yearpicker @error('batchyear') is-invalid @enderror" name="batchyear" value="{{ clean($user->batch_year, 'titles')}}" required>
                                        <div class="help-block with-errors"></div>

                                        @error('batchyear')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password">{{ __('Password')}}</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  >
                                        <div class="help-block with-errors"></div>

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password-confirm">{{ __('Confirm Password')}}</label>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                        <div class="help-block with-errors"></div>
                                    </div>





                                </div>
                                <div class="col-md-6">
                                    <!-- Assign role & view role permisions -->
                                    <div class="form-group">
                                        <label for="role">{{ __('Assign Role')}}<span class="text-red">*</span></label>
                                        {!! Form::select('role', $roles, $user_role->id??'' ,[ 'class'=>'form-control select2', 'placeholder' => 'Select Role','id'=> 'role', 'required'=>'required']) !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="role">{{ __('Permissions')}}</label>
                                        <div id="permission" class="form-group">
                                            @foreach($user->getAllPermissions() as $key => $permission)
                                            <span class="badge badge-dark m-1">
                                                <!-- clean unescaped data is to avoid potential XSS risk -->
                                                {{ clean($permission->name, 'titles')}}
                                            </span>
                                            @endforeach
                                        </div>
                                        <input type="hidden" id="token" name="token" value="{{ csrf_token() }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary form-control-right">{{ __('Update')}}</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- push external js -->
    @push('script')
        <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
        <!--get role wise permissiom ajax script-->
        <script src="{{ asset('js/get-role.js') }}"></script>
        <script src="{{ asset('js/yearpicker.js') }}"></script>
        <script>
            $('.yearpicker').yearpicker();

        </script>
    @endpush
@endsection
