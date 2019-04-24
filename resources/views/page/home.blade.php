@extends('layouts.app-frontend')

@section('content')
    <article>
        <!-- Banner -->
        @isset($setting['banner'])
            <section class="banner banner__home-page background__cover--center"
                     style="background:url('@isset($setting['banner']['image']){{$setting['banner']['image']}}@endisset')">
                <div class="banner_content text-center font_color--white">
                    @if (array_search(app()->getLocale(), array_column($setting['banner']['content'], 'locale')))
                        <h1>
                            @isset($setting['banner']['content'][app()->getLocale()]->title)
                                {{$setting['banner']['content'][app()->getLocale()]->title}}
                            @endif

                            <small>@isset($setting['banner']['content'][app()->getLocale()]->sub_title){{$setting['banner']['content'][app()->getLocale()]->sub_title}}@endisset</small>
                        </h1>
                        <div class="content margin_bottom--25">
                            @isset($setting['banner']['content'][app()->getLocale()]->description){{$setting['banner']['content'][app()->getLocale()]->description}}@endisset
                        </div>
                        <a href="@isset($setting['banner']['content'][app()->getLocale()]->link){{$setting['banner']['content'][app()->getLocale()]->link}}@endisset" class="btn btn-lg fs--1rem border_radius--2em background--white font_color--orange font-weight-bold">
                            @lang('site.view_more')
                        </a>
                    @endif
                </div>
            </section>
        @endisset

    <!-- Introduction -->
        @isset($setting['introduction'])
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
                                    @isset($setting['introduction']['content'][app()->getLocale()]->title)
                                        {{$setting['introduction']['content'][app()->getLocale()]->title}}
                                    @endif
                                </div>
                                <a href="@isset($setting['introduction']['content'][app()->getLocale()]->link) $setting['introduction']['content'][app()->getLocale()]->link} @endisset" class="btn background--orange border_radius--2em font_color--white">@lang('site.view_more')</a>
                            </div>
                        </div>
                        <div class=" col-xs-12 col-sm-6">
                            @isset($setting['introduction']['image'])
                                <img src="{{$setting['introduction']['image']}}" width="484" height="315">
                            @endif
                        </div>
                    </div>
                </div>
            </section>
        @endisset

        <!-- In The Press -->
        <section class="section-content section-content__inthepress">
            <h2 class="section-content__header text-center text-uppercase">
                @lang('site.in_the_press')
            </h2>
            @isset($data['press'])
                <div class="section-content__container container padding_left--0 padding_right--0 margin_bottom--30">
                    <div id="inThePress" class="inthepress-carousel">
                        @foreach ($data['press'] as $press_item)
                            <div class="custom-item-press">
                                <img src="{{$press_item['thumbnail']}}" alt=""/>

                                <div class="d-block">
                                    <div class=" font_color--white">
                                        <header class="font-italic">
                                            CAFEBIZ
                                        </header>

                                        <div class="content text-uppercase">
                                            {{$press_item['title']}}
                                        </div>
                                    </div>

                                    <a class="carousel-item__btn-link text-right font_color--white"
                                       href="{{route('pressitem', $press_item['slug'])}}"
                                       title="{{$press_item['title']}}">
                                        @lang('site.view_more')

                                        <i class="fas fa-arrow-right font_color--white background--green padding--20"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endisset
        </section>

        <!-- Client -->
        <section class="section-content section-content__client container">
            <h2 class="section-content__header text-center text-uppercase">
                @lang('site.client')
            </h2>

            @isset($data['clients'])
                <div class="section-content__container ">

                    <!-- Client Logo-->
                    <div id="client-logo" class="client-logo-carousel w-100">
                        @foreach ($data['clients'] as $client)
                            <a target="_blank" href="{{$client['url']}}">
                                <img src="{{$client['thumbnail']}}" alt="{{$client['name']}}">
                            </a>
                        @endforeach
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
            @endisset
        </section>

        <!-- Event & Programs -->
        @isset($data['eventAndProgram'])
            <section class="section-content section-content__event-program background--light-orange">
                <h2 class="section-content__header text-center">
                    @lang('site.event-and-program')
                </h2>

                <div class="section-content__container padding_left--15 padding_right--15">
                    @foreach ($data['eventAndProgram'] as $ep)
                        <div class="row background--white margin_left--0 margin_right--0">
                            <div class="col-sm-4 col-xs-12 padding_left--0">
                                <div class="event-image background__cover--center"
                                     style="background:url({{$ep['thumbnail']}})">
                                    <img class="d-none" src="{{$ep['thumbnail']}}" width="370" height="325">
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
                                            {{$ep['title']}}
                                        </header>

                                        <div class="content">
                                            {{$ep['description']}}
                                        </div>

                                        @if ($ep['type'] === 'event')
                                            <a href="{{route('eventitem', $ep['slug'])}}"
                                               class="font_color--green pull-right" title="">
                                                @lang('site.view_more') <i class="fas fa-arrow-right"></i>
                                            </a>
                                        @else
                                            <a href="{{route('programitem', $ep['slug'])}}"
                                               class="font_color--green pull-right" title="">
                                                @lang('site.view_more') <i class="fas fa-arrow-right"></i>
                                            </a>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <center class="view-more">
                    <a class="btn background--white font_color--orange font-weight-bold border_radius--2em"
                       href="{{route('event-program')}}"
                       title="view-more">
                        @lang('site.view_more')
                        @lang('site.event-and-program')
                    </a>
                </center>
            </section>
        @endisset

    </article>
@stop