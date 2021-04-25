<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
    <head>
        <!-- Required Meta Tags -->
        <meta name="language" content="ar">
        <meta http-equiv="x-ua-compatible" content="text/html" charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>{{ __('Al-Moasher Software House')  }} - @yield('title')</title>
        <!-- Open Graph Meta Tags -->
        <meta property="og:title" content="{ __('Al-Moasher Software House')  }}" />
        <!-- Other Meta Tags -->
		<link rel="shortcut icon" type="image/png"  href="{{MAINASSETS}}/backend/img/fevicon.png">
        <!-- Required CSS Files -->
        <link href="{{MAINASSETS}}/backend/css/tornado-icons.css" rel="stylesheet" />
        <link href="{{MAINASSETS}}/backend/css/tornado.css" rel="stylesheet" />
        <link href="{{MAINASSETS}}/backend/css/chosen.min.css" rel="stylesheet" />
        <link href="{{MAINASSETS}}/plugins/datatables/datatable.min.css" rel="stylesheet" />
        <style>
            .primary-bg {background-color:rgba(0, 197, 122, 0.4) !important}
            .error-msg{ display :none !important}
            .error{font-size:14px;color:#de3131;margin-bottom: 10px !important;}
        </style>  
        <!-- Sweet alert Files -->
        <script src="{{MAINASSETS}}/plugins/sweetalert/sweetalert.min.js"></script>
    </head>
    <body>
        <!-- Dashboard Wraper -->
        <div class="dashboard-wraper flexbox">
            @php $current_route = Route::currentRouteName(); @endphp
            @if((auth()->check()))
            <!-- Main Menu -->
            <div class="main-menu">
                <!-- Logo -->
                <div style="background-color:#;" >
                    <a href="{{route('backend.index')}}">
                        <h3>{{ __('Al-Moasher')  }}</h3>
                    </a>
                </div>
                <!-- Menu -->
                <ul>
                    <li class="{{($current_route=='backend.index')?'active':'' }}"><a href="{{route('backend.index')}}" class="ti-home">{{__('Home')}}</a></li>
                    <li class="{{((in_array($current_route, ['category.create','category.index','category.edit']))?'active':'' )}}"><a href="{{route('category.index')}}" class="ti-puzzle">{{__('Categories')}}</a>
                        <ul>
                            <li><a href="{{route('category.create')}}">{{__('Add Category')}}</a></li>
                            <li><a href="{{route('category.index')}}">{{__('List All')}}</a></li> 
                        </ul>
                    </li> 
                    <li class="{{((in_array($current_route, ['course.create','course.index','course.edit']))?'active':'' )}}"><a href="#" class="ti-lock">{{__('Courses')}} </a>
                        <ul>
                            <li><a href="{{route('course.create')}}">{{__('Add Course')}}</a></li> 
                            <li><a href="{{route('course.index')}}">{{__('List All')}}</a></li> 
                        </ul>
                    </li>
                   
                </ul>
                <!-- Main Menu Toogle -->
                <a href="#" class="main-menu-toggle"></a>
                <!-- Responsive Button -->
                <a href="#" class="main-menu-close"></a>
            </div>
            <!-- // Main Menu -->
            @endif
            <!-- Content Wraper -->
            <div class="content-wraper col-auto">
                <!-- Naviation Bar -->
                <div class="navigation-bar">
                    <div style="background-color:#2e496a;" class="container-fluid flexbox align-between align-center-y">
                        <!-- Logo/Menu Toggle -->
                        <div class="action-btns">
                            <!-- Menu Toggle -->
                            <a href="#" class="main-menu-open ti-menu-level-round"></a>
                            <!-- Logo -->
                            <a href="{{route('backend.index')}}" class="logo"><img src="" alt=""></a>
                        </div>
                        <!-- Userarea -->
                        <div class="userarea">
                            <!-- User Dropdown -->
                            <div class="dropdown">
                                <a href="{{route('backend.index')}}" class="dropdown-btn"><img src="{{MAINASSETS}}/backend/img/avatar.png" alt="">{{Auth::user()->name}}</a>
                                <ul class="dropdown-list">
                                    <li><a href="{{ route('logout') }}"  onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();" class="ti-power"> {{ __('Logout') }} </a></li>
                                 
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </ul>
                            </div>
                            <!-- // User Dropdown -->
                        </div>
                        <!-- // Userarea -->
                    </div>
                </div>
                <!-- // Naviation Bar -->
                @yield('content')
            </div>
            <!-- // Content Wraper -->
        </div>
        <!-- // Dashboard Wraper -->

        <!-- Required JS for Charts -->
        <script type="text/javascript" src="{{MAINASSETS}}/backend/js/fusioncharts.js"></script>
        <script type="text/javascript" src="{{MAINASSETS}}/backend/js/fusioncharts.theme.fusion.js"></script>
        <!-- Required JS Files -->
        <script src="{{MAINASSETS}}/backend/js/jquery.min.js"></script>
        <script src="{{MAINASSETS}}/backend/js/tornado.min.js"></script>
        <script src="{{MAINASSETS}}/backend/js/chosen.jquery.min.js"></script>
        <script src="https://cdn.ckeditor.com/4.9.0/full-all/ckeditor.js"></script>
        <script type="text/javascript" src="{{MAINASSETS}}/plugins/jquery-validation/js/jquery.validate.min.js"></script>
        <script type="text/javascript" src="{{MAINASSETS}}/plugins/jquery-validation/js/additional-methods.min.js"></script>
        @if(app()->isLocale('ar'))
        <script src="{{MAINASSETS}}/plugins/jquery-validation/js/localization/messages_ar.js"></script>
        @endif
        @yield('js')
     
        <script>
        $(document).ready( function () {
            @if(Session::has('success'))
                    swal('{{ Session::get('success') }}');
            @endif
            $("body").on("click", ".delete-element", function (e) {
                e.preventDefault();
                var elem = $(this);
                var table = $(this).data('table');
                var id = $(this).data('id');
                var swal_title = "{{ __('Are You Sure?') }}";

                //swal alerts messages
                var swal_text = "{{ __('you want to delete this one?') }}";
                var swal_success ='{{ __('Deleted Successfully') }}';
                var swal_faild ='{{ __('Failed to delete') }}';

                swal({
                    title: swal_text,
                    text: '',
                    icon: "",
                    buttons: {
                        cancel: "{{ __('No') }}",
                        ok: "{{ __('Yes') }}"
                    }
                }).then((sure) => {
                    if(sure){
                        elem.html('<i class="fa fa-spinner fa-spin"></i>');
                        $.ajax({
                            url:'{{ route("element.delete") }}',
                            type: "POST",
                            data: {
                                table: table,
                                id: id,
                                _token: "{{ csrf_token() }}"
                            },
                            dataType: "JSON",
                            success: function (response) {
                                if(response.status){
                                    elem.closest('tr').remove();
                                    swal(swal_success);
                                }else{
                                    elem.html('<i class="fa fa-trash"></i>');
                                    swal(swal_faild);
                                }
                            },
                            error: function () {
                                elem.html('<i class="fa fa-trash"></i>');
                                swal(swal_faild);
                            }
                        });
                    }
                });
            });            
        });
        </script>
    </body>
</html>