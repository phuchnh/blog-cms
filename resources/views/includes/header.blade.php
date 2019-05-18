<header id="header">
    <div class="container-fluid padding--none">
        <div class="header-top background--dark-grey">
            <nav class="navbar navbar-expand-lg">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        @isset($setting['phone'])
                            <a class="nav-link font_color--white font-weight-bold" href="#">{{$setting['phone']}}</a>
                        @endisset
                    </li>
                    <li class="nav-item">
                        @isset($setting['facebook'])
                            <a target="_blank" href="{{$setting['facebook']}}" class="nav-link font_color--white">
                                <i class="fab fa-facebook-square"></i>
                            </a>
                        @endisset
                    </li>
                    <li class="nav-item">
                        @isset($setting['facebook'])
                            <a class="nav-link font_color--white" target="_blank" href="{{$setting['facebook']}}">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        @endisset
                    </li>
                    <li class="nav-item">
                        @isset($setting['email'])
                            <a class="nav-link font_color--white" target="_blank" href="mailto:{{$setting['email']}}">
                                <i class="fas fa-envelope"></i>
                            </a>
                        @endisset

                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="#" class="nav-link font-weight-bold font_color--orange">
                            @lang('site.attend-a-program') <i class="fas fa-arrow-right"></i>
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <form action="{{route('search')}}" method="get" class="form-inline form-search background--white border_radius--2em my-lg-0 ml-auto">
                        <input class="form-control mr-sm-2 background--none border_none" type="title"
                               placeholder="Search" aria-label="Search">
                        <button class="btn my-sm-0 ml-auto" type="submit">
                            <i class="fas fa-search font_color--orange"></i>
                        </button>
                    </form>
                </ul>
            </nav>
        </div>

        <div class="header-main background--orange font_color--white">
            <nav class="navbar navbar-expand-lg navbar-light padding--none">
                <a class="navbar-brand" href="{{route('home')}}">
                    <img src="/app/img/onelifeconnection-logo.png" width="" height="50" alt="">
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_navigate"
                        aria-controls="main_navigate" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>

                <div class="collapse navbar-collapse" id="main_navigate">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item @if ($navigate === 'home') active @endif">
                            <a class="nav-link text-uppercase font-weight-bold" href="{{route('home')}}">Home <span
                                        class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item @if ($navigate === 'about') active @endif">
                            <a class="nav-link text-uppercase font-weight-bold" href="{{route('about')}}">ABOUT</a>
                        </li>
                        <li class="nav-item @if ($navigate === 'event-program') active @endif">
                            <a class="nav-link text-uppercase font-weight-bold" href="{{route('event-program')}}">EVENTS &
                                PROGRAMS</a>
                        </li>
                        <li class="nav-item @if ($navigate === 'results') active @endif">
                            <a class="nav-link text-uppercase font-weight-bold" href="{{route('results')}}">RESULTS</a>
                        </li>
                        <li class="nav-item @if ($navigate === 'whymindfullness') active @endif">
                            <a class="nav-link text-uppercase font-weight-bold" href="{{route('why-mind-fullness')}}">WHY
                                MINDFULNESS</a>
                        </li>
                        <li class="nav-item @if ($navigate === 'resources') active @endif">
                            <a class="nav-link text-uppercase font-weight-bold" href="{{route('resources')}}">RESOURCES</a>
                        </li>
                    </ul>
                    <form action="{{route('search')}}" method="get" class="form-inline form-search background--white border_radius--2em my-lg-0 ml-auto">
                        <input name="title" class="form-control mr-sm-2 background--none border_none" type="input"
                               placeholder="Search" aria-label="Search">
                        <button class="btn my-sm-0 ml-auto" type="submit">
                            <i class="fas fa-search font_color--orange"></i>
                        </button>
                    </form>

                    <ul class="navbar-nav ml-auto navbar-language">
                        @foreach (config('translatable.locales_array') as $lang => $language)
                            <li class="nav-item text-uppercase @if ($lang === app()->getLocale()) active @endif">
                                <a class="nav-link" href="{{ route('lang.switch', $lang) }}">
                                    {{ $lang }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>
