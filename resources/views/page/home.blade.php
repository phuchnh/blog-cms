@extends('layouts.app-frontend')

@section('content')
    <article>
        <!-- Banner -->
        @isset($setting['banner'])
            @php
                $key_banner = array_search(app()->getLocale(), array_column($setting['banner']['content'], 'locale'));
            @endphp

            <section class="banner banner__home-page background__cover--center"
                     style="background:url('@isset($setting['banner']['image']->url){{$setting['banner']['image']->url}}@endisset')">
                <div class="banner_content text-center font_color--white">
                    <h1>
                        @isset($setting['banner']['content'][$key_banner]->title)
                            {{$setting['banner']['content'][$key_banner]->title}}
                        @endif

                        <small>@isset($setting['banner']['content'][$key_banner]->sub_title){{$setting['banner']['content'][$key_banner]->sub_title}}@endisset</small>
                    </h1>

                    <div class="content margin_bottom--25"
                         style="white-space: pre-line">@isset($setting['banner']['content'][$key_banner]->description){{$setting['banner']['content'][$key_banner]->description}}@endisset</div>

                    <a href="@isset($setting['banner']['content'][$key_banner]->link){{$setting['banner']['content'][$key_banner]->link}}@endisset"
                       class="btn btn-lg fs--1rem border_radius--2em background--white font_color--orange font-weight-bold">
                        @lang('site.view_more')
                    </a>
                </div>
            </section>
        @endisset

    <!-- Introduction -->
        @isset($setting['introduction'])
            @php
                $key_introduction = array_search(app()->getLocale(), array_column($setting['introduction']['content'], 'locale'));
            @endphp

            <section class="section-content section-content__introduction">
                <h2 class="section-content__header text-center text-uppercase">
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
                                    @isset($setting['introduction']['content'][$key_introduction]->description)
                                        {{$setting['introduction']['content'][$key_introduction]->description}}
                                    @endif
                                </div>
                                <a href="@isset($setting['introduction']['content'][$key_introduction]->link) {{$setting['introduction']['content'][$key_introduction]->link }} @endisset"
                                   class="btn background--orange border_radius--2em font_color--white">@lang('site.view_more')</a>
                            </div>
                        </div>
                        <div class=" col-xs-12 col-sm-6">
                            @isset($setting['introduction']['image']->url)
                                <img class="img-responsive" src="{{$setting['introduction']['image']->url}}">
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
                                @isset($press_item['meta']['thumbnail']['url'])
                                    <img src="{{$press_item['meta']['thumbnail']['url']}}"
                                         alt="{{$press_item['title']}}"/>
                                @endisset

                                <div class="d-block">
                                    <div class=" font_color--white">
                                        <header class="font-italic">
                                            @ifIssetShowCategoryTitle($press_item['taxonomies'])
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
                @lang('site.clients')
            </h2>

            @isset($data['clients'])
                <div class="section-content__container ">

                    <!-- Client Logo-->
                    <div id="client-logo" class="client-logo-carousel w-100">
                        @foreach ($data['clients'] as $client)
                            @isset($client['meta']['thumbnail']['url'])
                                <a target="_blank" href="{{$client['url']}}">
                                    <img src="{{$client['meta']['thumbnail']['url']}}" alt="{{$client['name']}}">
                                </a>
                            @endisset
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
                <h2 class="section-content__header text-center text-uppercase">
                    @lang('site.events-and-programs')
                </h2>

                <div class="section-content__container padding_left--15 padding_right--15">
                    @foreach ($data['eventAndProgram'] as $ep)
                        <div class="row background--white margin_left--0 margin_right--0">
                            <div class="col-sm-4 col-xs-12 padding_left--0">
                                @isset($ep['meta']['thumbnail']['url'])
                                    @if ($ep['type'] === 'event')
                                        <a href="{{route('eventitem', $ep['slug'])}}">
                                            <div class="event-image background__cover--center"
                                                 style="background:url({{$ep['meta']['thumbnail']['url']}})">
                                                <img class="d-none" src="{{$ep['meta']['thumbnail']['url']}}"
                                                     width="370"
                                                     height="325">
                                            </div>
                                        </a>
                                    @else
                                        <a href="{{route('programitem', $ep['slug'])}}">
                                            <div class="event-image background__cover--center"
                                                 style="background:url({{$ep['meta']['thumbnail']['url']}})">
                                                <img class="d-none" src="{{$ep['meta']['thumbnail']['url']}}"
                                                     width="370"
                                                     height="325">
                                            </div>
                                        </a>
                                    @endif
                                @endisset
                            </div>
                            <div class="col-sm-8 col-xs-12">
                                <div class="event-content">
                                    <div class="event-content__date background--orange font_color--white margin_bottom--15">
                                        <span class="font-weight-bold event-content__date--day">{{\Carbon\Carbon::parse($ep['meta']['event']['date'])->format('d')}}</span>
                                        <span>|</span>
                                        <span class="event-content__date--month">{{\Carbon\Carbon::parse($ep['meta']['event']['date'])->format('F')}}</span>
                                        <span class="event-content__date--year">{{\Carbon\Carbon::parse($ep['meta']['event']['date'])->format('Y')}}</span>
                                    </div>

                                    <div class="event-content__body">
                                        <header class="event-content__title">
                                            @if ($ep['type'] === 'event')
                                                <a href="{{route('eventitem', $ep['slug'])}}"
                                                   class="fs--1-2rem font-weight-bold text-uppercase font_color--grey">
                                                    @ifIssetShowValue($ep['title'])
                                                </a>
                                            @else
                                                <a href="{{route('programitem', $ep['slug'])}}"
                                                   class="fs--1-2rem font-weight-bold text-uppercase font_color--grey">
                                                    @ifIssetShowValue($ep['title'])
                                                </a>
                                            @endif
                                        </header>

                                        <div class="content">
                                            @ifIssetShowValue($ep['description'])
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