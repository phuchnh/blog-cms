@extends('layouts.app-frontend')

@section('content')
    <article class="event-section">
        <!-- Banner -->
        @isset($item['meta']['banner']['url'])
            <section
                    class="event__banner banner__event-page background__cover--center-bottom element_center--text-center"
                    style="background:url('{{$item['meta']['banner']['url']}}')">
            </section>
        @endisset

        @isset($item)
            <section class="event-main padding--none">
                <div class="event-section__container container">
                    <div class="row">
                        <div class="col-sm-9">
                            <div class="event-section__breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{route('home')}}">@lang('site.home')</a>
                                        </li>
                                        <li class="breadcrumb-item">
                                            <a href="{{route('event-program')}}">@lang('site.event-and-program')</a>
                                        </li>
                                        <li class="breadcrumb-item">
                                            @isset($subnavigate)
                                                @if ($subnavigate === 'program')
                                                    <a href="{{route('program')}}">@lang('site.programs')</a>
                                                @else
                                                    <a href="{{route('event')}}">@lang('site.events')</a>
                                                @endif
                                            @endisset
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">
                                            {{$item['title']}}
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                            <div class="event-body">
                                <h1 class="font_color--orange">{{$item['title']}}</h1>

                                <hr class="hr__short--grey"/>

                                <div class="event-content">
                                    {!! $item['content'] !!}
                                </div>

                                <div class="sharethis-inline-share-buttons"></div>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="event-section__date background--light-grey padding--15">
                                <b class="text-capitalize"> @lang('site.date-and-time')</b>
                                <p class="margin_bottom--10">
                                    @isset($item['meta']['event']['date'])
                                        {{\Carbon\Carbon::parse($item['meta']['event']['date'])->format('l, F d, Y')}}
                                    @endisset
                                    <br>
                                    @isset($item['meta']['event']['start_time'])
                                        {{\Carbon\Carbon::parse($item['meta']['event']['start_time'])->format('H:i A')}}
                                    @endisset
                                    –
                                    @isset($item['meta']['event']['end_time'])
                                        {{\Carbon\Carbon::parse($item['meta']['event']['end_time'])->format('H:i A')}}
                                    @endisset
                                </p>

                                <b class="text-capitalize">@lang('site.location')</b>
                                @isset($item['meta']['event']['location'])
                                    <p class="margin_bottom--10">{{$item['meta']['event']['location']}}</p>
                                @endisset

                                @isset($item['meta']['sign_up_link'])
                                    <a href="{{$item['meta']['sign_up_link']}}"
                                       target="_blank"
                                       class="btn btn-block border_radius--2em background--green font_color--white margin_top--30 margin_bottom--15">
                                        @lang('site.sign-up-now')
                                    </a>
                                @endisset
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-offset-3 col-sm-9 text-center">
                            @isset($subnavigate) @if ($subnavigate === 'program')
                                <a href="{{route('program')}}"
                                   class="btn btn-sm background--orange font_color--white border_radius--2em mt-4">
                                    <i class="fa fa-caret-left"></i>
                                    @lang('site.back_to_all_programs')
                                </a>
                            @endif @endisset

                            @isset($subnavigate) @if ($subnavigate === 'event')
                                <a href="{{route('event')}}"
                                   class="btn btn-sm background--orange font_color--white border_radius--2em mt-4">
                                    <i class="fa fa-caret-left"></i>
                                    @lang('site.back_to_all_events')
                                </a>
                            @endif @endisset
                        </div>
                    </div>
                </div>

                @if ($others)
                    <div class="event-section__other">
                        <header class="text-center font-weight-bold fs--1-7rem">
                            @lang('site.other_posts_you_may_like')
                        </header>

                        <div class="event-section__other--list container">
                            <div class="card-columns">

                                @foreach( $others as $other)
                                    <a href="{{route('eventitem', $other['slug'])}}">
                                        <div class="card border_radius--none border_none">
                                            @isset($other['meta']['thumbnail']['url'])
                                                <div class="card-img-top background__cover--center"
                                                     style="background: url('{{$other['meta']['thumbnail']['url']}}')">
                                                    <img class="" src="{{$other['meta']['thumbnail']['url']}}"
                                                         alt="{{$other['title']}}">
                                                </div>
                                            @endisset

                                            <div class="card-body">
                                                <h6 class="font_color--green fs--0-8em font-italic">
                                                    @ifIssetShowCategoryTitle($other['taxonomies'])</h6>
                                                <h5 class="card-title font_color--orange fs--1-3em">
                                                    {{$other['title']}}
                                                </h5>
                                                <div class="card__date font_color--light-grey">
                                                    <p class="fs--0-9em">
                                                        @formatDateCarbon($other['meta']['event']['date'])
                                                    </p>

                                                    <p class="fs--0-9em font-weight-bold">
                                                        @formatTimeCarbon($other['meta']['event']['start_time']) –
                                                        @formatTimeCarbon($other['meta']['event']['end_time'])
                                                    </p>
                                                </div>
                                                <hr class="hr__short--grey"/>
                                                <a href="{{route('eventitem', $other['slug'])}}"
                                                   class="font_color--orange">
                                                    @lang('site.view_more')
                                                    <i class="fas fa-arrow-right fs--0-9em"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </section>
        @endisset
    </article>
@stop
