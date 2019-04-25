<footer id="footer" class="background--light-grey">
    <!-- footer inquiry -->
    <div class="footer_inquiry background--dark-grey text-center">
        <div class="container">
            <header class="font_color--orange fs--2rem margin_bottom--30 text-uppercase">@lang('site.inquiry')</header>

            <div class="row margin_bottom--15">
                <div class="col-sm-4 col-xs-12 text-center">
                    <a href="#"
                       class="btn btn-block border--orange background--none border_radius--2em fs--1-3rem font_color--white text-capitalize">
                        @lang('site.individual')
                    </a>
                </div>
                <div class="col-sm-4 col-xs-12 text-center">
                    <a href="#"
                       class="btn btn-block border--orange background--none border_radius--2em fs--1-3rem font_color--white text-capitalize">
                        @lang('site.company')
                    </a>
                </div>
                <div class="col-sm-4 col-xs-12 text-center">
                    <a href="#"
                       class="btn btn-block border--orange background--none border_radius--2em fs--1-3rem font_color--white text-capitalize">
                        @lang('site.book-a-meeting')
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- footer information -->
    <div class="footer_information">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 col-xs-12 mr-auto">
                    <div class="footer_information__address">
                        <a href="#">
                            <img src="/app/img/onlifeconnection-logo-orange.png" height="50" width="auto">
                        </a>

                        <div class="content fs--1rem margin_top--30">
                            @isset($setting['address'])
                                {{$setting['address']}}
                            @endisset

                        </div>
                    </div>
                </div>

                <div class="col-sm-9 col-xs-12 ml-auto">
                    <div class="d-flex flex-column flex-sm-row bd-highlight">
                        <div class="flex-sm-fill">
                            <header class="font-weight-bold fs--1rem text-uppercase">@lang('site.about')</header>
                            <ul class="nav flex-column margin--none padding--none">
                                <li class="nav-item"><a class="nav-link padding_left--0 text-capitalize"
                                                        href="#">@lang('site.story')</a></li>
                                <li class="nav-item"><a class="nav-link padding_left--0 text-capitalize"
                                                        href="#">@lang('site.experts')</a></li>
                                <li class="nav-item"><a class="nav-link padding_left--0 text-capitalize"
                                                        href="#">@lang('site.in_the_press')</a>
                                </li>
                                <li class="nav-item"><a class="nav-link padding_left--0 text-capitalize"
                                                        href="#">@lang('site.contact-us')</a>
                                </li>
                            </ul>
                        </div>

                        <div class="flex-sm-fill">
                            <header class="font-weight-bold fs--1rem text-uppercase">@lang('site.events-and-programs')</header>
                            <ul class="nav flex-column margin--none padding--none">
                                <li class="nav-item"><a class="nav-link padding_left--0 text-capitalize"
                                                        href="#">@lang('routes.programs')</a></li>
                                <li class="nav-item"><a class="nav-link padding_left--0 text-capitalize"
                                                        href="#">@lang('routes.events')</a></li>
                            </ul>
                        </div>


                        <div class="flex-sm-fill">
                            <header class="font-weight-bold fs--1rem text-uppercase">@lang('site.results')</header>
                            <ul class="nav flex-column margin--none padding--none">
                                <li class="nav-item"><a class="nav-link padding_left--0 text-capitalize"
                                                        href="#">@lang('site.approach')</a></li>
                                <li class="nav-item"><a class="nav-link padding_left--0 text-capitalize"
                                                        href="#">@lang('site.expertise')</a>
                                </li>
                                <li class="nav-item"><a class="nav-link padding_left--0 text-capitalize"
                                                        href="#">@lang('site.testimonials')</a></li>
                            </ul>
                        </div>

                        <div class="flex-sm-fill">
                            <header class="font-weight-bold fs--1rem text-uppercase">@lang('routes.why-mindfullness')</header>
                            <ul class="nav flex-column margin--none padding--none">
                                <li class="nav-item"><a class="nav-link padding_left--0 text-capitalize"
                                                        href="#">@lang('site.benefits')</a></li>
                                <li class="nav-item"><a class="nav-link padding_left--0 text-capitalize"
                                                        href="#">@lang('site.how_to_practise')</a></li>
                                <li class="nav-item"><a class="nav-link padding_left--0 text-capitalize"
                                                        href="#">@lang('site.faq')</a></li>
                            </ul>
                        </div>

                        <div class="flex-sm-fill">
                            <header class="font-weight-bold fs--1rem text-uppercase">@lang('site.resources')</header>
                            <ul class="nav flex-column margin--none padding--none">
                                <li class="nav-item"><a class="nav-link padding_left--0 text-capitalize"
                                                        href="#">@lang('site.blogs')</a></li>
                                <li class="nav-item"><a class="nav-link padding_left--0 text-capitalize"
                                                        href="#">@lang('site.guided-meditation')</a></li>
                                <li class="nav-item"><a class="nav-link padding_left--0 text-capitalize"
                                                        href="#">@lang('site.daily-practices')</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer copyright -->
    <div class="container-fluid">
        <div class="row footer_copyright padding_top--15 padding_bottom--15 border_top--1">
            <div class="col-12 fs--0-9rem text-center">
                @isset($setting['copyright'])
                    {{$setting['copyright']}}
                @endisset

            </div>
        </div>
        <!-- footer socialnetwork -->
        <div class="row footer_network background--orange font_color--white">
            <div class="offset-sm-3 col-sm-6 padding_top--25 text-center element_center--text-center">
                <div class="content">
                    <h5 class="fs--1rem margin_bottom--20">ENGAGE WITH US</h5>

                    <ul class="list-inline fs--1-1rem">
                        <li class="list-inline-item">
                            @isset($setting['facebook'])
                                <a target="_blank" href="{{$setting['facebook']}}" class="font_color--white">
                                    <i class="fab fa-facebook-square"></i>
                                </a>
                            @endisset

                        </li>
                        <li class="list-inline-item">
                            @isset($setting['youtube'])
                                <a target="_blank" href="{{$setting['youtube']}}" class="font_color--white">
                                    <i class="fab fa-youtube-square"></i>
                                </a>
                            @endisset
                        </li>
                        <li class="list-inline-item">
                            @isset($setting['linkedin'])
                                <a target="_blank" href="{{$setting['linkedin']}}" class="font_color--white">
                                    <i class="fab fa-linkedin"></i>
                                </a>
                            @endisset
                        </li>
                        <li class="list-inline-item">
                            @isset($setting['email'])
                                <a href="mailto:{{$setting['email']}}" class="font_color--white">
                                    <i class="fab fas fa-envelope"></i>
                                </a>
                            @endisset

                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-sm-3 background--grey element_center--text-center">
                <a href="#" class="font-weight-bold font_color--white fs--1-1rem">
                    SUBSCRIBE FOR OUR NEWSLETTER
                </a>
            </div>
        </div>
    </div>
</footer>