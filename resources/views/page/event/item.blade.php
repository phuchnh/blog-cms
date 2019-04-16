@extends('layouts.app-frontend')

@section('content')
    <article class="event-section">
        <!-- Banner -->
        <section class="event__banner banner__event-page background__cover--center-bottom element_center--text-center"
                 style="background:url('/app/img/event/event-banner-detail.jpg')">
        </section>

        @isset($item)
            <section class="event-main padding--none">
                <div class="event-section__container container">
                    <div class="row">
                        <div class="col-sm-9">
                            <div class="event-section__breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{route('home')}}">@lang('site.home')</a></li>
                                        <li class="breadcrumb-item">
                                            <a href="{{route('event-program')}}">@lang('site.event-and-program')</a>
                                        </li>
                                        <li class="breadcrumb-item">
                                            <a href="{{route('event')}}">@lang('site.event')</a>
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
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="event-section__date background--light-grey padding--15">
                                <b class="text-capitalize"> @lang('site.date-and-time')</b>
                                <p class="margin_bottom--10">
                                    @isset($item['meta']['date'])
                                        {{\Carbon\Carbon::parse($item['meta']['date'])->format('l, F d, Y')}}
                                    @endisset
                                    <br>
                                    @isset($item['meta']['start_time'])
                                        {{\Carbon\Carbon::parse($item['meta']['start_time'])->format('H:i A')}}
                                    @endisset
                                    –
                                    @isset($item['meta']['end_time'])
                                        {{\Carbon\Carbon::parse($item['meta']['end_time'])->format('H:i A')}}
                                    @endisset
                                </p>

                                <b class="text-capitalize">@lang('site.location')</b>
                                @isset($item['meta']['location'])
                                    <p class="margin_bottom--10">{{$item['meta']['location']}}</p>
                                @endisset

                                <a href="#"
                                   class="btn btn-block border_radius--2em background--green font_color--white margin_top--30 margin_bottom--15">
                                    SIGN UP NOW
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                @if ($others)
                    <div class="event-section__other">
                        <header class="text-center font-weight-bold fs--1-7rem">
                            @lang('site.other_posts_you_may_like')
                        </header>

                        <div class="event-section__other--list container">
                            <div class="card-deck">
                                @foreach( $others as $other)
                                    <div class="card border_radius--none border_none">
                                        <div class="card-img-top background__cover--center"
                                             style="background: url({{$other['thumbnail']}})">
                                            <img class="d-none" src="{{$other['thumbnail']}}" alt="{{$other['title']}}">
                                        </div>
                                        <div class="card-body">
                                            <h6 class="font_color--green fs--0-8em font-italic">Category</h6>
                                            <h5 class="card-title font_color--orange fs--1-3em">
                                                {{$other['title']}}
                                            </h5>
                                            <div class="card__date font_color--light-grey">
                                                <p class="fs--0-9em">
                                                    @isset($other['meta']['date'])
                                                        {{\Carbon\Carbon::parse($other['meta']['date'])->format('l, F d, Y')}}
                                                    @endisset
                                                </p>

                                                <p class="fs--0-9em font-weight-bold">
                                                    @isset($other['meta']['start_time'])
                                                        {{\Carbon\Carbon::parse($other['meta']['start_time'])->format('H:i A')}}
                                                    @endisset
                                                    –
                                                    @isset($item['meta']['end_time'])
                                                        {{\Carbon\Carbon::parse($item['meta']['end_time'])->format('H:i A')}}
                                                    @endisset
                                                </p>
                                            </div>
                                            <hr class="hr__short--grey"/>
                                            <a href="{{route('eventitem', $other['slug'])}}" class="font_color--orange">
                                                @lang('site.view_more')
                                                <i class="fas fa-arrow-right fs--0-9em"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </section>
        @endisset
    </article>
@stop