@extends('layouts.main')
@section('title', 'Profile')
@section('content')


    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-file-text bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Profile')}}</h5>
                            <span>
                                @foreach ($user->roles as $role)
                                    {{ $role->name }}
                                @endforeach
                            </span>
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
                                <a href="#">{{ __('User')}}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Profile')}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            @include('include.message')
            <div class="col-lg-4 col-md-5">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ asset('img/users/')."/"}}{{ Auth::user()->avatar == 'default.jpg' ? Auth::user()->gender == 1 ? 'male_' : 'female_' : '' }}{{ Auth::user()->avatar == 'default.jpg' ? Auth::user()->role == 'Student' ? 'student.png' : 'instructor.png' : '' }}" class="rounded-circle" width="150" />
                            <h4 class="card-title mt-10">{{ $user->name}}</h4>
                            <p class="card-subtitle">{{ $user->rollno }}</p>
                            <h6 class="card-subtitle">{{ $user->branch->name }}</h6>
                            <div class="row text-center justify-content-md-center">
                                <div class="col-4"><a href="javascript:void(0)" class="link"><i class="ik ik-user"></i> <font class="font-medium">254</font></a></div>
                                <div class="col-4"><a href="javascript:void(0)" class="link"><i class="ik ik-image"></i> <font class="font-medium">54</font></a></div>
                            </div>
                        </div>
                    </div>
                    <hr class="mb-0">
                    <div class="card-body">
                        <small class="text-muted d-block">{{ __('Primary Email address')}} </small>
                        <h6>{{ $user->email }}</h6>
                        <small class="text-muted d-block">{{ __('Secondary Email address')}} </small>
                        <h6>{{ $user->email2 }}</h6>
                        <small class="text-muted d-block pt-10">{{ __('Phone')}}</small>
                        <h6>+91 {{ $user->phone }}</h6>
                        <small class="text-muted d-block pt-10">{{ __('Address')}}</small>
                        <h6>{{ $user->address }}</h6>
                        <div class="map-box">
{{--                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d248849.886539092!2d77.49085452149588!3d12.953959988118836!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae1670c9b44e6d%3A0xf8dfc3e8517e4fe0!2sBengaluru%2C+Karnataka!5e0!3m2!1sen!2sin!4v1542005497600" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>--}}
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1886.217680821519!2d73.10300555792276!3d19.00052813285509!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7e83a36fbf179%3A0xbbb0905051e8c56e!2sAnjuman-I-Islam&#39;s%20Kalsekar%20Technical%20Campus!5e0!3m2!1sen!2sin!4v1645966243628!5m2!1sen!2sin" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>
                        <small class="text-muted d-block pt-30">{{ __('Social Profile')}}</small>
                        <br/>
                        <button class="btn btn-icon btn-facebook"><i class="fab fa-facebook-f"></i></button>
                        <button class="btn btn-icon btn-twitter"><i class="fab fa-twitter"></i></button>
                        <button class="btn btn-icon btn-instagram"><i class="fab fa-instagram"></i></button>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-7">
                <div class="card">
                    <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link active" id="pills-timeline-tab" data-toggle="pill" href="#current-month" role="tab" aria-controls="pills-timeline" aria-selected="true">{{ __('Timeline')}}</a>--}}
{{--                        </li>--}}
                        <li class="nav-item">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#last-month" role="tab" aria-controls="pills-profile" aria-selected="true">{{ __('Profile')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-setting-tab" data-toggle="pill" href="#previous-month" role="tab" aria-controls="pills-setting" aria-selected="false">{{ __('Setting')}}</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
{{--                        <div class="tab-pane fade show active" id="current-month" role="tabpanel" aria-labelledby="pills-timeline-tab">--}}
{{--                            <div class="card-body">--}}
{{--                                <div class="profiletimeline mt-0">--}}
{{--                                    <div class="sl-item">--}}
{{--                                        <div class="sl-left"> <img src="../img/users/1.jpg" alt="user" class="rounded-circle" /> </div>--}}
{{--                                        <div class="sl-right">--}}
{{--                                            <div><a href="javascript:void(0)" class="link">John Doe</a> <span class="sl-date">5 minutes ago</span>--}}
{{--                                                <p>assign a new task <a href="javascript:void(0)"> Design weblayout</a></p>--}}
{{--                                                <div class="row">--}}
{{--                                                    <div class="col-lg-3 col-md-6 mb-20"><img src="../img/big/img2.jpg" class="img-fluid rounded" /></div>--}}
{{--                                                    <div class="col-lg-3 col-md-6 mb-20"><img src="../img/big/img3.jpg" class="img-fluid rounded" /></div>--}}
{{--                                                    <div class="col-lg-3 col-md-6 mb-20"><img src="../img/big/img4.jpg" class="img-fluid rounded" /></div>--}}
{{--                                                    <div class="col-lg-3 col-md-6 mb-20"><img src="../img/big/img5.jpg" class="img-fluid rounded" /></div>--}}
{{--                                                </div>--}}
{{--                                                <div class="like-comm">--}}
{{--                                                    <a href="javascript:void(0)" class="link mr-10">2 comment</a>--}}
{{--                                                    <a href="javascript:void(0)" class="link mr-10"><i class="fa fa-heart text-danger"></i> 5 Love</a>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <hr>--}}
{{--                                    <div class="sl-item">--}}
{{--                                        <div class="sl-left"> <img src="../img/users/2.jpg" alt="user" class="rounded-circle" /> </div>--}}
{{--                                        <div class="sl-right">--}}
{{--                                            <div> <a href="javascript:void(0)" class="link">John Doe</a> <span class="sl-date">5 minutes ago</span>--}}
{{--                                                <div class="mt-20 row">--}}
{{--                                                    <div class="col-md-3 col-xs-12"><img src="../img/big/img6.jpg" alt="user" class="img-fluid rounded" /></div>--}}
{{--                                                    <div class="col-md-9 col-xs-12">--}}
{{--                                                        <p> {{ __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.')}}</p> <a href="javascript:void(0)" class="btn btn-success"> Design weblayout</a>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="like-comm mt-20">--}}
{{--                                                    <a href="javascript:void(0)" class="link mr-10">2 comment</a>--}}
{{--                                                    <a href="javascript:void(0)" class="link mr-10"><i class="fa fa-heart text-danger"></i> 5 Love</a>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <hr>--}}
{{--                                    <div class="sl-item">--}}
{{--                                        <div class="sl-left"> <img src="../img/users/3.jpg" alt="user" class="rounded-circle" /> </div>--}}
{{--                                        <div class="sl-right">--}}
{{--                                            <div>--}}
{{--                                                <a href="javascript:void(0)" class="link">John Doe</a> <span class="sl-date">5 minutes ago</span>--}}
{{--                                                <p class="mt-10">{{ __(' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper')}} </p>--}}
{{--                                            </div>--}}
{{--                                            <div class="like-comm mt-20">--}}
{{--                                                <a href="javascript:void(0)" class="link mr-10">2 comment</a>--}}
{{--                                                <a href="javascript:void(0)" class="link mr-10"><i class="fa fa-heart text-danger"></i> 5 Love</a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <hr>--}}
{{--                                    <div class="sl-item">--}}
{{--                                        <div class="sl-left"> <img src="../img/users/4.jpg" alt="user" class="rounded-circle" /> </div>--}}
{{--                                        <div class="sl-right">--}}
{{--                                            <div><a href="javascript:void(0)" class="link">John Doe</a> <span class="sl-date">5 minutes ago</span>--}}
{{--                                                <blockquote class="mt-10">--}}
{{--                                                    {{ __('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt')}}--}}
{{--                                                </blockquote>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="tab-pane fade show active" id="last-month" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 col-6"> <strong>{{ __('Full Name')}}</strong>
                                        <br>
                                        <p class="text-muted">{{ $user->name }}</p>
                                    </div>
                                    <div class="col-md-3 col-6"> <strong>{{ __('Mobile')}}</strong>
                                        <br>
                                        <p class="text-muted">+91 {{ $user->phone }}</p>
                                    </div>
                                    <div class="col-md-3 col-6"> <strong>{{ __('Email')}}</strong>
                                        <br>
                                        <p class="text-muted">{{ $user->email2 }}</p>
                                    </div>
                                    <div class="col-md-3 col-6"> <strong>{{ __('Branch')}}</strong>
                                        <br>
                                        <p class="text-muted">{{ $user->branch->name }}</p>
                                    </div>
                                </div>
                                <hr>
                                <p class="mt-30">{!! nl2br($user->bio) !!}</p>
                                @if (count($skills) != 0)
                                    <h4 class="mt-30">{{ __('Skill Set')}}</h4>
                                    <hr>
                                    @for($i=0;$i<count($skills);$i++)
                                        <h6 class="mt-30">{{ $skills[$i]->name }} <span class="pull-right">{{ $skills[$i]->percentage }}%</span></h6>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar {{ $colors[$i%count($skills)] }}" role="progressbar" aria-valuenow="{{ $skills[$i]->percentage }}" aria-valuemin="0" aria-valuemax="100" style="width:{{ $skills[$i]->percentage }}%;"> <span class="sr-only">50% Complete</span> </div>
                                        </div>
                                    @endfor
{{--                                    <h6 class="mt-30">{{ $skills[$i]->name }} <span class="pull-right">{{ $skills[$i]->percentage }}%</span></h6>--}}
{{--                                    <div class="progress progress-sm">--}}
{{--                                        <div class="progress-bar bg-success" role="progressbar" aria-valuenow="{{ $skills[$i]->percentage }}" aria-valuemin="0" aria-valuemax="100" style="width:80%;"> <span class="sr-only">50% Complete</span> </div>--}}
{{--                                    </div>--}}
{{--                                    <h6 class="mt-30">{{ __('HTML 5')}} <span class="pull-right">90%</span></h6>--}}
{{--                                    <div class="progress  progress-sm">--}}
{{--                                        <div class="progress-bar bg-info" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width:90%;"> <span class="sr-only">50% Complete</span> </div>--}}
{{--                                    </div>--}}
{{--                                    <h6 class="mt-30">{{ __('jQuery')}} <span class="pull-right">50%</span></h6>--}}
{{--                                    <div class="progress  progress-sm">--}}
{{--                                        <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%;"> <span class="sr-only">50% Complete</span> </div>--}}
{{--                                    </div>--}}
{{--                                    <h6 class="mt-30">{{ __('Photoshop')}} <span class="pull-right">70%</span></h6>--}}
{{--                                    <div class="progress  progress-sm">--}}
{{--                                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%;"> <span class="sr-only">50% Complete</span> </div>--}}
{{--                                    </div>--}}
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade" id="previous-month" role="tabpanel" aria-labelledby="pills-setting-tab">
                            <div class="card-body">
                                <form id="settings" class="forms-horizontal" method="POST" action="{{ route('update-profile') }}" >
                                    @csrf
{{--                                    <div class="form-group">--}}
{{--                                        <label for="example-name">{{ __('Full Name')}}</label>--}}
{{--                                        <input type="text" placeholder="Johnathan Doe" class="form-control" name="example-name" id="example-name">--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="example-email">{{ __('Email')}}</label>--}}
{{--                                        <input type="email" placeholder="johnathan@admin.com" class="form-control" name="example-email" id="example-email">--}}
{{--                                    </div>--}}
                                    <div class="form-group">
                                        <label for="example-message">{{ __('Bio')}}</label>
                                        <textarea name="bio" id="bio" rows="5" class="form-control @error('bio') is-invalid @enderror">{{ clean($user->bio, 'titles')}}</textarea>
                                        <div class="help-block with-errors"></div>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="prev_password">{{ __('Current Password')}}</label>
                                        <input type="password" class="form-control @error('prev_password') is-invalid @enderror" name="prev_password" id="prev_password">
                                        @error('prev_password')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password">{{ __('New Password')}}</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirmation">{{ __('Retype Password')}}</label>
                                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                                    </div>
                                    <div class="form-group">
{{--                                        <div class="card">--}}
{{--                                            <div class="card-header"><h3>{{ __('Form Repeater')}}</h3></div>--}}
{{--                                            <div class="card-body">--}}
{{--                                                <p>{{ __('Click the add button to add more skills')}}</p>--}}
{{--                                                <form class="form-inline repeater">--}}
{{--                                                    <div data-repeater-list="group-a">--}}
{{--                                                        <div data-repeater-item class="d-flex mb-2">--}}
{{--                                                            <label class="sr-only" for="inlineFormInputGroup1">{{ __('Skills')}}</label>--}}
{{--                                                            <div class="form-group mb-3 mr-sm-6 mb-sm-0">--}}
{{--                                                                <input type="text" class="form-control" placeholder="Skill Name">--}}
{{--                                                            </div>--}}
{{--                                                            <div class="form-group mb-3 mr-sm-6 mb-sm-0">--}}
{{--                                                                <input type="text" min="1" max="100" class="form-control" placeholder="Percentage Rating">--}}
{{--                                                            </div>--}}
{{--                                                            <div class="form-group mb-3 mr-sm-6 mb-sm-0">--}}
{{--                                                                <input type="text" min="1" max="100" class="form-control" placeholder="Percentage Rating">--}}
{{--                                                            </div>--}}
{{--                                                            <button data-repeater-delete type="button" class="btn btn-danger btn-icon ml-2" ><i class="ik ik-trash-2"></i></button>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <button data-repeater-create type="button" class="btn btn-success btn-icon ml-2 mb-2"><i class="ik ik-plus"></i></button>--}}
{{--                                                </form>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                    </div>
{{--                                    <div class="form-group">--}}
{{--                                        <label for="example-phone">{{ __('Phone No')}}</label>--}}
{{--                                        <input type="text" placeholder="123 456 7890" id="example-phone" name="example-phone" class="form-control">--}}
{{--                                    </div>--}}

{{--                                    <div class="form-group">--}}
{{--                                        <label for="example-country">{{ __('Select Country')}}</label>--}}
{{--                                        <select name="example-message" id="example-message" class="form-control">--}}
{{--                                            <option>{{ __('London')}}</option>--}}
{{--                                            <option>{{ __('India')}}</option>--}}
{{--                                            <option>{{ __('Usa')}}</option>--}}
{{--                                            <option>{{ __('Canada')}}</option>--}}
{{--                                            <option>{{ __('Thailand')}}</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}

                                </form>
                                <div class="card">
                                    <div class="card-body">
                                        <p>{{ __('Click the add button to add more skills')}}</p>
                                        <form class="form-inline repeater">
                                        <div data-repeater-list="group-a">
                                            @if (count($skills) != 0)
                                                @foreach($skills as $skill)
                                                <div data-repeater-item="" class="d-flex mb-2" style="">
                                                    <label class="sr-only" for="inlineFormInputGroup1">Skills</label>
                                                    <div class="form-group mb-3 mr-sm-6 mb-sm-0">
                                                        <input disabled name="skill" type="text" form="settings" class="form-control" placeholder="Skill Name" value="{{ $skill->name }}">
                                                    </div>
                                                    <div class="form-group mb-3 mr-sm-6 mb-sm-0">
                                                        <input disabled name="percent" type="number" form="settings" min="1" max="100" class="form-control" placeholder="Percentage Rating" value="{{ $skill->percentage }}">
                                                    </div>
                                                    <button data-repeater-delete="" data-id="{{ $skill->id }}" type="button" class="btn btn-danger btn-icon ml-2"><i class="ik ik-trash-2"></i></button>
                                                </div>
                                                @endforeach
                                            @endif
                                            <div data-repeater-item class="d-flex mb-2">
                                                <label class="sr-only" for="inlineFormInputGroup1">{{ __('Skills')}}</label>
                                                <div class="form-group mb-3 mr-sm-6 mb-sm-0">
                                                    <input name="skill" type="text" form="settings" class="form-control" placeholder="Skill Name">
                                                </div>
                                                <div class="form-group mb-3 mr-sm-6 mb-sm-0">
                                                    <input name="percent" type="number" form="settings" min="1" max="100" class="form-control" placeholder="Percentage Rating">
                                                </div>
                                                <button data-repeater-delete type="button" class="btn btn-danger btn-icon ml-2" ><i class="ik ik-trash-2"></i></button>
                                            </div>
                                        </div>
                                        <button data-repeater-create type="button" class="btn btn-success btn-icon ml-2 mb-2"><i class="ik ik-plus"></i></button>
                                        </form>
                                    </div>
                                </div>
                                <button class="btn btn-success" form="settings" type="submit">Update Profile</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
        <script src="{{ asset('plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
        <script src="{{ asset('plugins/jquery.repeater/jquery.repeater.min.js') }}"></script>

        <script src="{{ asset('js/profile-skills.js') }}"></script>
    @endpush
@endsection
