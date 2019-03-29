@extends('app-frontend')

@section('content')
    <article class="event-section">
        <!-- Banner -->
        <section class="event__banner banner__event-page background__cover--center-bottom element_center--text-center"
                 style="background:url('../../assets/img/event/event-banner.jpg')">

            <div class="font_color--white font-weight-bold">
                EVENTS & PROGRAMS
            </div>
        </section>

        <section class="sub-navigate container-fluid background--light-grey">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="event-program.html">PROGRAMS</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="event-list.html">EVENTS</a>
                </li>
            </ul>
        </section>

        <section class="event-main">
            <div class="event-section__header margin_bottom--40 container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="input-group">
                            <select class="custom-select border_radius--2em">
                                <option selected>Choose...</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="input-group">
                            <select class="custom-select border_radius--2em">
                                <option selected>Choose...</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="input-group">
                            <select class="custom-select border_radius--2em">
                                <option selected>Choose...</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6 ml-auto">
                        <form class="form-inline form-search background--white border_radius--2em my-lg-0 ml-auto border--grey">
                            <input class="form-control mr-sm-2 background--none border_none" type="search"
                                   placeholder="Search" aria-label="Search">
                            <button class="btn my-sm-0 ml-auto" type="submit">
                                <i class="fas fa-search font_color--grey"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="event-section__container container">
                <div class="row">
                    <div class="col-12">
                        <div class="card-deck">
                            <div class="card border_radius--none border_none">
                                <div class="card-img-top background__cover--center"
                                     style="background: url('../../assets/img/event/event_14.jpg')">
                                    <img class="d-none" src="../assets/img/event/event_14.jpg" alt="Card image cap">
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
                                    <div class="card-text margin_bottom--20">This card has supporting text below as a
                                        natural lead-in to additional
                                        content.
                                    </div>

                                    <a href="event-detail.html" class="font_color--orange">
                                        View more
                                        <i class="fas fa-arrow-right fs--0-9em"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card border_radius--none border_none">
                                <div class="card-img-top background__cover--center"
                                     style="background: url('../../assets/img/event/event_15.jpg')">
                                    <img class="d-none" src="../assets/img/event/event_15.jpg" alt="Card image cap">
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
                                    <div class="card-text margin_bottom--20">This card has supporting text below as a
                                        natural lead-in to additional
                                        content.
                                    </div>

                                    <a href="event-detail.html" class="font_color--orange">
                                        View more
                                        <i class="fas fa-arrow-right fs--0-9em"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card border_radius--none border_none">
                                <div class="card-img-top background__cover--center"
                                     style="background: url('../../assets/img/event/event_17.jpg')">
                                    <img class="d-none" src="../assets/img/event/event_17.jpg" alt="Card image cap">
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
                                    <div class="card-text margin_bottom--20">This card has supporting text below as a
                                        natural lead-in to additional
                                        content.
                                    </div>

                                    <a href="event-detail.html" class="font_color--orange">
                                        View more
                                        <i class="fas fa-arrow-right fs--0-9em"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card-deck">
                            <div class="card border_radius--none border_none">
                                <div class="card-img-top background__cover--center"
                                     style="background: url('../../assets/img/event/event_32.jpg')">
                                    <img class="d-none" src="../assets/img/event/event_32.jpg" alt="Card image cap">
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
                                    <div class="card-text margin_bottom--20">This card has supporting text below as a
                                        natural lead-in to additional
                                        content.
                                    </div>

                                    <a href="event-detail.html" class="font_color--orange">
                                        View more
                                        <i class="fas fa-arrow-right fs--0-9em"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card border_radius--none border_none">
                                <div class="card-img-top background__cover--center"
                                     style="background: url('../../assets/img/event/event_33.jpg')">
                                    <img class="d-none" src="../assets/img/event/event_33.jpg" alt="Card image cap">
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
                                    <div class="card-text margin_bottom--20">This card has supporting text below as a
                                        natural lead-in to additional
                                        content.
                                    </div>

                                    <a href="event-detail.html" class="font_color--orange">
                                        View more
                                        <i class="fas fa-arrow-right fs--0-9em"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card border_radius--none border_none">
                                <div class="card-img-top background__cover--center"
                                     style="background: url('../../assets/img/event/event_35.jpg')">
                                    <img class="d-none" src="../assets/img/event/event_35.jpg" alt="Card image cap">
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
                                    <div class="card-text margin_bottom--20">This card has supporting text below as a
                                        natural lead-in to additional
                                        content.
                                    </div>

                                    <a href="event-detail.html" class="font_color--orange">
                                        View more
                                        <i class="fas fa-arrow-right fs--0-9em"></i>
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