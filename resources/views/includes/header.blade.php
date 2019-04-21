<header id="header">
    <div class="container-fluid padding--none">
        <div class="header-top background--dark-grey">
            <nav class="navbar navbar-expand-lg">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        @isset($options['phone'])
                            <a class="nav-link font_color--white font-weight-bold" href="#">{{$options['phone']}}</a>
                        @endisset
                    </li>
                    <li class="nav-item">
                        @isset($options['facebook'])
                            <a target="_blank" href="{{$options['facebook']}}" class="nav-link font_color--white">
                                <i class="fab fa-facebook-square"></i>
                            </a>
                        @endisset
                    </li>
                    <li class="nav-item">
                        @isset($options['facebook'])
                            <a class="nav-link font_color--white" target="_blank" href="{{$options['facebook']}}">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        @endisset
                    </li>
                    <li class="nav-item">
                        @isset($options['email'])
                            <a class="nav-link font_color--white" target="_blank" href="mailto:{{$options['email']}}">
                                <i class="fas fa-envelope"></i>
                            </a>
                        @endisset
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="#" class="nav-link font-weight-bold font_color--orange">
                            Attend a Program <i class="fas fa-arrow-right"></i>
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <form class="form-inline form-search background--white border_radius--2em my-lg-0 ml-auto">
                        <input class="form-control mr-sm-2 background--none border_none" type="search"
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
                            <a class="nav-link text-uppercase" href="{{route('home')}}">Home <span
                                        class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item @if ($navigate === 'about') active @endif">
                            <a class="nav-link text-uppercase" href="/about">ABOUT</a>
                        </li>
                        <li class="nav-item @if ($navigate === 'event-program') active @endif">
                            <a class="nav-link text-uppercase" href="{{route('event-program')}}">EVENT & PROGRAMS</a>
                        </li>
                        <li class="nav-item @if ($navigate === 'results') active @endif">
                            <a class="nav-link text-uppercase" href="/results">RESULTS</a>
                        </li>
                        <li class="nav-item @if ($navigate === 'whymindfullness') active @endif">
                            <a class="nav-link text-uppercase" href="/whymindfullness">WHY MINDFULNESS</a>
                        </li>
                        <li class="nav-item @if ($navigate === 'resources') active @endif">
                            <a class="nav-link text-uppercase" href="/resources">RESOURCES</a>
                        </li>
                    </ul>
                    <form class="form-inline form-search background--white border_radius--2em my-lg-0 ml-auto">
                        <input class="form-control mr-sm-2 background--none border_none" type="search"
                               placeholder="Search" aria-label="Search">
                        <button class="btn my-sm-0 ml-auto" type="submit">
                            <i class="fas fa-search font_color--orange"></i>
                        </button>
                    </form>

                    <ul class="navbar-nav ml-auto navbar-language">
                        <li class="nav-item text-uppercase"><a class="nav-link">ENG</a></li>
                        <li class="nav-item"><a class="nav-link">|</a></li>
                        <li class="nav-item text-uppercase active"><a class="nav-link">VN</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>
