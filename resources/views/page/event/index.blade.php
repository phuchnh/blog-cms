@extends('layouts.app-frontend')

@section('content')
    <article class="event-section">
        <!-- Banner -->
        <section class="event__banner banner__event-page background__cover--center-bottom element_center--text-center"
                 style="background:url('/app/img/event/event-banner.jpg')">

            <div class="font_color--white font-weight-bold text-uppercase">
                @lang('site.event-and-program')
            </div>
        </section>

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
                                <div class="card-img-top background__cover--center"
                                     style="background: url('/app/img/event/event_14.jpg')">
                                    <img class="d-none" src="/app/img/event/event_14.jpg" alt="Card image cap">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title font-weight-bold fs--1-3em">EVENTS</h5>
                                    <div class="card-text margin_bottom--20">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                    </div>

                                    <a href="{{route('event')}}" class="btn background--orange font_color--white border_radius--2em">
                                        View all Events
                                    </a>
                                </div>
                            </div>
                            <div class="card border_radius--none border_none">
                                <div class="card-img-top background__cover--center"
                                     style="background: url('/app/img/event/event_14.jpg')">
                                    <img class="d-none" src="/app/img/event/event_14.jpg" alt="Card image cap">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title font-weight-bold fs--1-3em">PROGRAMS</h5>
                                    <div class="card-text margin_bottom--20">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                    </div>

                                    <a href="{{route('program')}}" class="btn background--orange font_color--white border_radius--2em">
                                        View all Programs
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