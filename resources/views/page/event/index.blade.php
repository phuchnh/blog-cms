@extends('layouts.app-frontend')

@section('content')
    <article class="event-section">
        <!-- Banner -->
        @isset($banner)
            <section class="event__banner banner__event-page background__cover--center-bottom element_center--text-center"
                     style="background:url('@if($banner){{$banner}}@else {{'/app/img/olc-banner_home.jpg'}}@endif')">

                <div class="font_color--white font-weight-bold text-uppercase">
                    @lang('site.event-and-program')
                </div>
            </section>
        @endisset

        <div class="event-headline__top">
            <div class="container">
                TRANSFORM THE WORKPLACE, ONE MINDFUL LEADER AT A TIME
            </div>
        </div>

        <section class="event-main event-main--program">
            <div class="event-section__container container">
                <div class="row">
                    <div class="col-12">
                        <div class="card-deck">
                            <div class="card border_radius--none border_none">
                                @isset($event->thumbnail->url)
                                    <div class="card-img-top background__cover--center"
                                         style="background: url('{{$event->thumbnail->url}}')">
                                        <img class="d-none" src="{{$event->thumbnail->url}}" alt="Card image cap">
                                    </div>
                                @endisset

                                <div class="card-body">
                                    <h5 class="card-title font-weight-bold fs--1-3em text-uppercase">@lang('site.events')</h5>
                                    <div class="card-text margin_bottom--20">
                                        @isset($event_content)
                                            {!! $event_content->description !!}
                                        @endisset
                                    </div>

                                    <a href="{{route('event')}}"
                                       class="btn background--orange font_color--white border_radius--2em text-capitalize">
                                        @lang('site.view_all_events')
                                    </a>
                                </div>
                            </div>
                            <div class="card border_radius--none border_none">
                                @isset($program->thumbnail->url)
                                    <div class="card-img-top background__cover--center"
                                         style="background: url('{{$program->thumbnail->url}}')">
                                        <img class="d-none" src="{{$program->thumbnail->url}}" alt="Card image cap">
                                    </div>
                                @endisset

                                <div class="card-body">
                                    <h5 class="card-title font-weight-bold fs--1-3em text-uppercase">@lang('site.programs')</h5>
                                    <div class="card-text margin_bottom--20">
                                        @isset($program_content)
                                            {!! $program_content->description !!}
                                        @endisset
                                    </div>

                                    <a href="{{route('program')}}"
                                       class="btn background--orange font_color--white border_radius--2em text-capitalize">
                                        @lang('site.view_all_programs')
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </article>
@stop