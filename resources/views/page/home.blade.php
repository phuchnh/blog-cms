@extends('layouts.app-frontend')

@section('content')
    <article>
        <!-- Banner -->
        <section class="banner banner__home-page background__cover--center"
                 style="background:url('/app/img/olc-banner_home.jpg')">
            <div class="banner_content text-center font_color--white">
                <h1>
                    WE ARE
                    <small>A solution-driven, mindfulness-based training and coaching company in Vietnam.</small>
                </h1>
                <div class="content margin_bottom--25">
                    We work with individuals, teams and organizations<br>to transform the workplace, one mindful leader
                    at a time.
                </div>
                <button class="btn btn-lg fs--1rem border_radius--2em background--white font_color--orange font-weight-bold">
                    Read more
                </button>
            </div>
        </section>

        <!-- Introduction -->
        <section class="section-content section-content__introduction">
            <h2 class="section-content__header text-center">
                INTRODUCTION
            </h2>

            <div class="section-content__container container">
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <div class="section-content__container--padding">
                            <header class="font-weight-bold fs--2rem margin_bottom--15">
                                <span class="font_color--dark-grey">WELCOME</span><br>
                                <span class="font_color--orange">TO ONE LIFE CONNECTION</span>
                            </header>

                            <div class="content">
                                Improve Performance and Purposeat work with our unique training & coaching solution
                                based on insights and applications of Mindfulness,Neuroscience, Emotional
                                Intelligence,Happiness & Wellbeing. Watch this video and learn more.
                            </div>
                            <div class="btn background--orange border_radius--2em font_color--white">@lang('site.view_more')</div>
                        </div>
                    </div>
                    <div class=" col-xs-12 col-sm-6">
                        <img src="/app/img/olc-banner_home.jpg" width="484" height="315">
                    </div>
                </div>
            </div>
        </section>

        <!-- In The Press -->
        <section class="section-content section-content__inthepress">
            <h2 class="section-content__header text-center">
                IN THE PRESS
            </h2>

            <div class="section-content__container container padding_left--0 padding_right--0 margin_bottom--30">
                <div id="inThePress" class="inthepress-carousel">
                    <div class="custom-item-press">
                        <img src="/app/img/inthepress/inthepress_02.jpg" alt=""/>
                        <div class="d-block">
                            <div class=" font_color--white">
                                <header class="font-italic">
                                    CAFEBIZ
                                </header>

                                <div class="content text-uppercase">
                                    Giảng viên<br> Search Inside Yourself<br> người việt đầu tiên
                                </div>
                            </div>

                            <a class="carousel-item__btn-link text-right font_color--white" href="#"
                               title="">
                                View aritle
                                <i class="fas fa-arrow-right font_color--white background--green padding--20"></i>
                            </a>
                        </div>
                    </div>
                    <div class="custom-item-press">
                        <img src="/app/img/inthepress/inthepress_01.jpg" alt=""/>
                        <div class="d-block">
                            <div class=" font_color--white">
                                <header>forbes</header>
                                <div class="content text-uppercase">
                                    Lối về cho tâm
                                </div>
                            </div>

                            <a class="carousel-item__btn-link text-right font_color--white" href="#"
                               title="">
                                View aritle <i
                                        class="fas fa-arrow-right font_color--white background--green padding--20"></i>
                            </a>
                        </div>
                    </div>
                    <div class="custom-item-press">
                        <img src="/app/img/inthepress/inthepress_02.jpg" alt=""/>
                        <div class="d-block">
                            <div class=" font_color--white">
                                <header>CAFEBIZ</header>

                                <div class="content text-uppercase">
                                    Giảng viên<br> Search Inside Yourself<br> người việt đầu tiên
                                </div>
                            </div>

                            <a class="carousel-item__btn-link text-right font_color--white" href="#"
                               title="">
                                View aritle <i
                                        class="fas fa-arrow-right font_color--white background--green padding--20"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Client -->
        <section class="section-content section-content__client container">
            <h2 class="section-content__header text-center">
                CLIENT
            </h2>

            <div class="section-content__container ">
                <!-- Client Logo-->
                <div id="client-logo" class="client-logo-carousel w-100">
                    <div class="">
                        <img src="/app/img/clients/client_logo_01.jpg" alt="...">
                    </div>

                    <div class="">
                        <img src="/app/img/clients/client_logo_02.jpg" alt="...">
                    </div>

                    <div class="">
                        <img src="/app/img/clients/client_logo_03.jpg" alt="...">
                    </div>

                    <div class="">
                        <img src="/app/img/clients/client_logo_04.jpg" alt="...">
                    </div>

                    <div class="">
                        <img src="/app/img/clients/client_logo_01.jpg" alt="...">
                    </div>
                </div>
                <!-- Client Masonry-->
                <div class="client_images">
                    <div class="card-columns">
                        <div class="card">
                            <img src="/app/img/clients/client_image_188.jpg" alt="">
                        </div>
                        <div class="card">
                            <img src="/app/img/clients/client_image_215.jpg" alt="">
                        </div>
                        <div class="card">
                            <img src="/app/img/clients/client_image_190.jpg" alt="">
                        </div>
                        <div class="card">
                            <img src="/app/img/clients/client_image_192.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Event & Programs -->
        <section class="section-content section-content__event-program background--light-orange">
            <h2 class="section-content__header text-center">
                EVENTS & PROGRAMS
            </h2>

            <div class="section-content__container padding_left--15 padding_right--15">
                <div class="row background--white margin_left--0 margin_right--0">
                    <div class="col-sm-4 col-xs-12 padding_left--0">
                        <div class="event-image background__cover--center"
                             style="background:url('/app/img/olc-banner_home.jpg')">
                            <img class="d-none" src="/app/img/olc-banner_home.jpg" width="370" height="325">
                        </div>
                    </div>
                    <div class="col-sm-8 col-xs-12">
                        <div class="event-content">
                            <div class="event-content__date background--orange font_color--white margin_bottom--15">
                                <span class="font-weight-bold event-content__date--day">16</span>
                                <span>|</span>
                                <span class="event-content__date--month">March</span>
                                <span class="event-content__date--year">2017</span>
                            </div>

                            <div class="event-content__body">
                                <header class="event-content__title fs--1-2rem font-weight-bold text-uppercase">
                                    Lorem ipsum dolor sit amet
                                </header>

                                <div class="content">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.
                                </div>

                                <a href="#" class="font_color--green pull-right" title="">
                                    @lang('site.view_more') <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row background--white margin_left--0 margin_right--0">
                    <div class="col-sm-4 col-xs-12 padding_left--0">
                        <div class="event-image background__cover--center"
                             style="background:url('/app/img/olc-banner_home.jpg')">
                            <img class="d-none" src="/app/img/olc-banner_home.jpg" width="370" height="325">
                        </div>
                    </div>
                    <div class="col-sm-8 col-xs-12">
                        <div class="event-content">
                            <div class="event-content__date background--orange font_color--white margin_bottom--15">
                                <span class="font-weight-bold event-content__date--day">16</span>
                                <span>|</span>
                                <span class="event-content__date--month">March</span>
                                <span class="event-content__date--year">2017</span>
                            </div>

                            <div class="event-content__body">
                                <header class="event-content__title fs--1-2rem font-weight-bold text-uppercase">
                                    Lorem ipsum dolor sit amet
                                </header>

                                <div class="content">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.
                                </div>

                                <a href="#" class="font_color--green pull-right" title="">
                                    @lang('site.view_more') <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row background--white margin_left--0 margin_right--0">
                    <div class="col-sm-4 col-xs-12 padding_left--0">
                        <div class="event-image background__cover--center"
                             style="background:url('/app/img/olc-banner_home.jpg')">
                            <img class="d-none" src="/app/img/olc-banner_home.jpg" width="370" height="325">
                        </div>
                    </div>
                    <div class="col-sm-8 col-xs-12">
                        <div class="event-content">
                            <div class="event-content__date background--orange font_color--white margin_bottom--15">
                                <span class="font-weight-bold event-content__date--day">16</span>
                                <span>|</span>
                                <span class="event-content__date--month">March</span>
                                <span class="event-content__date--year">2017</span>
                            </div>

                            <div class="event-content__body">
                                <header class="event-content__title fs--1-2rem font-weight-bold text-uppercase">
                                    Lorem ipsum dolor sit amet
                                </header>

                                <div class="content">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.
                                </div>

                                <a href="#" class="font_color--green pull-right" title="">
                                    @lang('site.view_more') <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row background--white margin_left--0 margin_right--0">
                    <div class="col-sm-4 col-xs-12 padding_left--0">
                        <div class="event-image background__cover--center"
                             style="background:url('/app/img/olc-banner_home.jpg')">
                            <img class="d-none" src="/app/img/olc-banner_home.jpg" width="370" height="325">
                        </div>
                    </div>
                    <div class="col-sm-8 col-xs-12">
                        <div class="event-content">
                            <div class="event-content__date background--orange font_color--white margin_bottom--15">
                                <span class="font-weight-bold event-content__date--day">16</span>
                                <span>|</span>
                                <span class="event-content__date--month">March</span>
                                <span class="event-content__date--year">2017</span>
                            </div>

                            <div class="event-content__body">
                                <header class="event-content__title fs--1-2rem font-weight-bold text-uppercase">
                                    Lorem ipsum dolor sit amet
                                </header>

                                <div class="content">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.
                                </div>

                                <a href="#" class="font_color--green pull-right" title="">
                                    @lang('site.view_more') <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <center class="view-more">
                <a class="btn background--white font_color--orange font-weight-bold border_radius--2em " href="#"
                   title="view-more">
                    @lang('site.view_more') events & programs
                </a>
            </center>
        </section>
    </article>
@stop