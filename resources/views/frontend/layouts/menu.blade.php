<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Merienda+One">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
    .form-inline {
        display: inline-block;
    }

    .navbar-header.col {
        padding: 0 !important;
    }

    .navbar {
        background: #fff;
        padding-left: 16px;
        padding-right: 16px;
        border-bottom: 1px solid #d6d6d6;
        box-shadow: 0 0 4px rgba(0, 0, 0, .1);
    }

    .nav-link img {
        border-radius: 50%;
        width: 36px;
        height: 36px;
        margin: -8px 0;
        float: left;
        margin-right: 10px;
    }

    .navbar .navbar-brand {
        color: #555;
        padding-left: 0;
        padding-right: 50px;
        font-family: 'Merienda One', sans-serif;
    }

    .navbar .navbar-brand i {
        font-size: 20px;
        margin-right: 5px;
    }

    .search-box {
        position: relative;
    }

    .search-box input {
        box-shadow: none;
        padding-right: 35px;
        border-radius: 3px !important;
    }

    .search-box .input-group-addon {
        min-width: 35px;
        border: none;
        background: transparent;
        position: absolute;
        right: 0;
        z-index: 9;
        padding: 7px;
        height: 100%;
    }

    .search-box i {
        color: #a0a5b1;
        font-size: 19px;
    }

    .navbar .nav-item i {
        font-size: 18px;
    }

    .navbar .dropdown-item i {
        font-size: 16px;
        min-width: 22px;
    }

    .navbar .nav-item.open>a {
        background: none !important;
    }

    .navbar .dropdown-menu {
        border-radius: 1px;
        border-color: #e5e5e5;
        box-shadow: 0 2px 8px rgba(0, 0, 0, .05);
    }

    .navbar .dropdown-menu a {
        color: #777;
        padding: 8px 20px;
        line-height: normal;
    }

    .navbar .dropdown-menu a:hover,
    .navbar .dropdown-menu a:active {
        color: #333;
    }

    .navbar .dropdown-item .material-icons {
        font-size: 21px;
        line-height: 16px;
        vertical-align: middle;
        margin-top: -2px;
    }

    .navbar .badge {
        color: #fff;
        background: #f44336;
        font-size: 11px;
        border-radius: 20px;
        position: absolute;
        min-width: 10px;
        padding: 4px 6px 0;
        min-height: 18px;
        top: 5px;
    }

    .navbar a.notifications,
    .navbar a.messages {
        position: relative;
        margin-right: 10px;
    }

    .navbar a.messages {
        margin-right: 20px;
    }

    .navbar a.notifications .badge {
        margin-left: -8px;
    }

    .navbar a.messages .badge {
        margin-left: -4px;
    }

    .navbar .active a,
    .navbar .active a:hover,
    .navbar .active a:focus {
        background: transparent !important;
    }

    @media (min-width: 1200px) {
        .form-inline .input-group {
            width: 300px;
            margin-left: 30px;
        }
    }

    @media (max-width: 1199px) {
        .form-inline {
            display: block;
            margin-bottom: 10px;
        }

        .input-group {
            width: 100%;
        }
    }

</style>
<style>
    <style>.menubutton {
        padding: 15px 25px;
        font-size: 24px;
        text-align: center;
        cursor: pointer;
        outline: none;
        color: #fff;
        background-color: #04AA6D;
        border: none;
        border-radius: 15px;
        box-shadow: 0 9px rgb(153, 153, 153);
    }

    .menubutton:hover {
        background-color: #dbade9;
    }

    .menubutton:active {
        background-color: #3e8e41;
        box-shadow: 0 5px #666;
        transform: translateY(4px);
    }

</style>

<nav class="navbar navbar-expand-xl navbar-light bg-light">
    <a href="./" class="navbar-brand"><img src="{{ asset('frontend/images/logo.png')}}" alt="" height="100" width="200"></a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Collection of nav links, forms, and other content for toggling -->
    <div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">
        <div class="navbar-nav">
            <a href="./" class="nav-item nav-link border px-3 menubutton">Home</a>
            <div class="nav-item dropdown border px-3 menubutton">
                <a href="#" class="nav-link dropdown-toggle menubutton menubutton" data-toggle="dropdown">@lang('messages.vaccination service')</a>
                <div class="dropdown-menu">
                    <a href="./#main_slider" class="dropdown-item" >@lang('messages.search vaccine center')</a>
                    <a href="{{ route('login') }}" class="dropdown-item">@lang('messages.book vaccine slot')</a>
                    <a href{{ route('login') }} class="dropdown-item">@lang('messages.manage appointment')</a>
                </div>
            </div>
            <div class="nav-item dropdown border px-3 menubutton">
                <a href="#" class="nav-link dropdown-toggle menubutton" data-toggle="dropdown">@lang('messages.resources')</a>
                <div class="dropdown-menu">
                    <a href="./howtogetvaccined" class="dropdown-item">@lang('messages.how to get vaccinated')</a>
                    <a href="./doanddonts" class="dropdown-item">@lang('dosanddonts.Title')</a>
                    
                    <a href="./faqs" class="dropdown-item">@lang('faq.TITLE')</a>
                </div>
            </div>
            @if(Auth::user())
                @if(Auth::user()->user_role == "User")
                @endif        
            @else
                <a href="/login" class="nav-item nav-link btn-warning px-3">@lang('messages.register/login')</a>
            @endif
        </div>
        <div class="navbar-nav ml-auto">
            <div class="nav-item dropdown">
                @if (config('app.locale') == 'en')
                    <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle user-action">@lang('language.en') <b
                            class="caret"></b></a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('language.change', 'kn') }}">
                            <i class="fas fa-globe fa-sm fa-fw mr-2 text-gray-400"></i> @lang('language.kn')
                        </a>
                        <a class="dropdown-item" href="{{ route('language.change', 'en') }}">
                            <i class="fas fa-globe fa-sm fa-fw mr-2 text-gray-400"></i> @lang('language.en')
                        </a>
                    </div>
                @endif
                @if (config('app.locale') == 'kn')
                    <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle user-action">@lang('language.kn') <b
                            class="caret"></b></a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('language.change', 'en') }}">
                            <i class="fas fa-globe fa-sm fa-fw mr-2 text-gray-400"></i> @lang('language.en')
                        </a>
                        <a class="dropdown-item" href="{{ route('language.change', 'kn') }}">
                            <i class="fas fa-globe fa-sm fa-fw mr-2 text-gray-400"></i> @lang('language.kn')
                        </a>

                    </div>
                @endif
            </div>
            <div class="nav-item dropdown">
                @if(Auth::user())
                    @if(Auth::user()->user_role == "User")  
                    <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle user-action "> Account <b class="caret"></b></a>
                    @endif
                @else
                    <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle user-action "> Platform <b
                    class="caret"></b></a>
                @endif
                <div class="dropdown-menu pull-left" style="right: 0; left: auto;">
                @if(Auth::user())
                    @if(Auth::user()->user_role == "User")
                    <a href="{{ route('beneficiaryview') }}" class="dropdown-item"><i class="material-icons">&#xe875;</i>@lang('messages.viewbenficiary')</a>
                    <a href="{{ route('logout') }}" class="dropdown-item"><i class="material-icons">&#xE8AC;</i>@lang('messages.logout')</a>
                    @endif
                @else
                    <a href="{{ route('deptlogin') }}" class="dropdown-item"><i class="fa fa-user-o"></i>@lang('messages.dept login')</a></a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('vaccinatorlogin') }}" class="dropdown-item"><i class="fa fa-calendar-o"></i>@lang('messages.vaccinator login')</a>
                @endif
                </div>
            </div>
        </div>
    </div>
</nav>
