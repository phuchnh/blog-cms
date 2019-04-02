@extends('layouts.app-frontend')

@section('content')
    <article class="event-section">
        <!-- Banner -->
        <section class="event__banner banner__event-page background__cover--center-bottom element_center--text-center"
                 style="background:url('/app/img/event/event-banner-detail.jpg')">
        </section>

        <section class="event-main padding--none">
            <div class="event-section__container container">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="event-section__breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item"><a href="#">Event</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Lorem ipsum dolor sit
                                        amet,consectetur adipisicing
                                    </li>
                                </ol>
                            </nav>
                        </div>
                        <div class="event-body">
                            <h1 class="font_color--orange">Lorem ipsum dolor sit amet,consectetur adipisicing</h1>

                            <hr class="hr__short--grey"/>

                            <div class="event-content">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
                                ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                                laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                                voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
                                cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed
                                ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                                laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi
                                architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit
                                aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione
                                voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet,
                                consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et
                                dolore magnam aliquam quaerat voluptatem.
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="event-section__date background--light-grey padding--15">
                            <b>DATE AND TIME</b>
                            <p class="margin_bottom--10">Tue, November 13, 2018<br>
                                7:00 PM – 9:00 PM </p>

                            <b>Location</b>
                            <p class="margin_bottom--10">139C Nguyen Dinh Chinh,Ward 8, Phu Nhuan Dist.HCMC,
                                Vietnam.</p>

                            <a href="#" class="btn btn-block border_radius--2em background--green font_color--white margin_top--30 margin_bottom--15">
                                SIGN UP NOW
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="event-section__other">
                <header class="text-center font-weight-bold fs--1-7rem">
                    Other Events You May Like
                </header>

                <div class="event-section__other--list container">
                    <div class="card-deck">
                        <div class="card border_radius--none border_none">
                            <div class="card-img-top background__cover--center"
                                 style="background: url('/app/img/event/event_14.jpg')">
                                <img class="d-none" src="/app/img/event/event_14.jpg" alt="Card image cap">
                            </div>
                            <div class="card-body">
                                <h6 class="font_color--green fs--0-8em font-italic">Category</h6>
                                <h5 class="card-title font_color--orange fs--1-3em">Lorem ipsum dolor
                                    sitamet,consectetur
                                    adipisicing</h5>
                                <div class="card__date font_color--light-grey">
                                    <p class="fs--0-9em">Tuesday, November 13, 2018</p>
                                    <p class="fs--0-9em font-weight-bold">7:00 PM – 9:00 PM</p>
                                </div>
                                <hr class="hr__short--grey"/>
                                <a href="#" class="font_color--orange">
                                    View more
                                    <i class="fas fa-arrow-right fs--0-9em"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card border_radius--none border_none">
                            <div class="card-img-top background__cover--center"
                                 style="background: url('/app/img/event/event_14.jpg')">
                                <img class="d-none" src="/app/img/event/event_14.jpg" alt="Card image cap">
                            </div>
                            <div class="card-body">
                                <h6 class="font_color--green fs--0-8em font-italic">Category</h6>
                                <h5 class="card-title font_color--orange fs--1-3em">Lorem ipsum dolor
                                    sitamet,consectetur
                                    adipisicing</h5>
                                <div class="card__date font_color--light-grey">
                                    <p class="fs--0-9em">Tuesday, November 13, 2018</p>
                                    <p class="fs--0-9em font-weight-bold">7:00 PM – 9:00 PM</p>
                                </div>
                                <hr class="hr__short--grey"/>
                                <a href="#" class="font_color--orange">
                                    View more
                                    <i class="fas fa-arrow-right fs--0-9em"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card border_radius--none border_none">
                            <div class="card-img-top background__cover--center"
                                 style="background: url('/app/img/event/event_14.jpg')">
                                <img class="d-none" src="/app/img/event/event_14.jpg" alt="Card image cap">
                            </div>
                            <div class="card-body">
                                <h6 class="font_color--green fs--0-8em font-italic">Category</h6>
                                <h5 class="card-title font_color--orange fs--1-3em">Lorem ipsum dolor
                                    sitamet,consectetur
                                    adipisicing</h5>
                                <div class="card__date font_color--light-grey">
                                    <p class="fs--0-9em">Tuesday, November 13, 2018</p>
                                    <p class="fs--0-9em font-weight-bold">7:00 PM – 9:00 PM</p>
                                </div>
                                <hr class="hr__short--grey"/>
                                <a href="#" class="font_color--orange">
                                    View more
                                    <i class="fas fa-arrow-right fs--0-9em"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </article>
@stop