<!-- Navbar-->
<header class="app-header"><a class="app-header__logo" style="font-family: 'Cairo', 'sans-serif';" href="{{route('overview')}}">  {{ trans('admin.Vali') }}</a>

    <!-- Sidebar toggle button-->
    <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>

    <!-- Navbar Right Menu-->
    <ul class="app-nav">


        <li class="dropdown" id="notifications">


            <ul class="app-notification dropdown-menu dropdown-menu-right">

                <div class="app-notification__content">


                    <li>
                        <a class="app-notification__item" href="#">
                                <span class="app-notification__icon">
                                    <span class="fa-stack fa-lg">
                                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                        <i class="fa fa-address-book fa-stack-1x fa-inverse"></i>
                                    </span>
                                </span>
                            <div>
                                <p class="app-notification__message">Notification title</p>
                                <p class="app-notification__meta">2 mins ago</p>
                            </div>
                        </a>
                    </li>

                </div>

                <li class="app-notification__footer"><a href="#">@lang('site.all') @lang('notifications.notifications')</a></li>
            </ul>
        </li>

        {{--languages--}}
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-flag fa-lg"></i></a>
            <ul class="dropdown-menu settings-menu dropdown-menu-right">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <li>
                        <a rel="alternate" hreflang="{{ $localeCode }}" class="dropdown-item" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            {{ $properties['native'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </li>

        {{--user menu--}}
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
            <ul class="dropdown-menu settings-menu dropdown-menu-right">
                <li><a  class="dropdown-item" href="{{route('profile')}}"><i class="app-menu__icon fa fa-users"></i>{{ trans('admin.Profile') }}</a></li>
                <li>

                        @if(auth('client')->check())
                            <form method="GET" action="{{ route('logout','client') }}">
                                @else
                                    <form method="GET" action="{{ route('logout','web') }}">@endif
                                        @csrf
                                        <a class="dropdown-item" href="#" onclick="event.preventDefault();this.closest('form').submit();"> <i class="fa fa-sign-out fa-lg"></i>{{trans('admin.logout')}}</a>
                                    </form>

                </li>
            </ul>
        </li>

    </ul>
</header>
