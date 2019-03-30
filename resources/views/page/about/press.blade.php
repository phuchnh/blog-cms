@extends('layouts.app-frontend')

@section('content')
    <article class="about a-press">
        <!-- Banner -->
        <section class="about__banner banner__about-page background__cover--center-bottom"
                 style="background:url('/app/img/olc-banner_home.jpg')">
        </section>

        @include('page.about.navigate')

        <div class="a-press__top">
            <div class="container">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
            </div>
        </div>

        <div class="a-press__content">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 a-press__item ">
                        <div class="custom-item-press">
                            <img src="/app/img/inthepress/inthepress_02.jpg" alt="">
                            <div class="d-block">
                                <div class=" font_color--white">
                                    <header class="font-italic">
                                        CAFEBIZ
                                    </header>

                                    <div class="content text-uppercase">
                                        Giảng viên<br> Search Inside Yourself<br> người việt đầu tiên
                                    </div>
                                </div>

                                <a class="carousel-item__btn-link text-right font_color--white" href="#" title="" tabindex="0">
                                    View aritle
                                    <i class="fas fa-arrow-right font_color--white background--green padding--20"></i>
                                </a>
                            </div>
                        </div>

                    </div>
                    <div class="col-xs-12 col-sm-6 a-press__item">
                        <div class="custom-item-press">
                            <img src="/app/img/inthepress/inthepress_01.jpg" alt="">
                            <div class="d-block">
                                <div class=" font_color--white">
                                    <header class="font-italic">
                                        CAFEBIZ
                                    </header>

                                    <div class="content text-uppercase">
                                        Giảng viên<br> Search Inside Yourself<br> người việt đầu tiên
                                    </div>
                                </div>

                                <a class="carousel-item__btn-link text-right font_color--white" href="#" title="" tabindex="0">
                                    View aritle
                                    <i class="fas fa-arrow-right font_color--white background--green padding--20"></i>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row a-press__content--child">
                    <div class="col-xs-12 col-sm-4 a-press__item a-press__item--child">
                        <div class="custom-item-press">
                            <img src="/app/img/about-press-01.jpg" alt="">
                            <div class="d-block">
                                <div class=" font_color--white">
                                    <header class="font-italic">
                                        CAFEBIZ
                                    </header>

                                    <div class="content text-uppercase">
                                        Giảng viên<br> Search Inside Yourself<br> người việt đầu tiên
                                    </div>
                                </div>

                                <a class="carousel-item__btn-link text-right font_color--white" href="#" title="" tabindex="0">
                                    View aritle
                                    <i class="fas fa-arrow-right font_color--white background--green padding--20"></i>
                                </a>
                            </div>
                        </div>

                    </div>
                    <div class="col-xs-12 col-sm-4 a-press__item a-press__item--child">
                        <div class="custom-item-press">
                            <img src="/app/img/about-press-01.jpg" alt="">
                            <div class="d-block">
                                <div class=" font_color--white">
                                    <header class="font-italic">
                                        CAFEBIZ
                                    </header>

                                    <div class="content text-uppercase">
                                        Giảng viên<br> Search Inside Yourself<br> người việt đầu tiên
                                    </div>
                                </div>

                                <a class="carousel-item__btn-link text-right font_color--white" href="#" title="" tabindex="0">
                                    View aritle
                                    <i class="fas fa-arrow-right font_color--white background--green padding--20"></i>
                                </a>
                            </div>
                        </div>

                    </div>
                    <div class="col-xs-12 col-sm-4 a-press__item a-press__item--child">
                        <div class="custom-item-press">
                            <img src="/app/img/about-press-01.jpg" alt="">
                            <div class="d-block">
                                <div class=" font_color--white">
                                    <header class="font-italic">
                                        CAFEBIZ
                                    </header>

                                    <div class="content text-uppercase">
                                        Giảng viên<br> Search Inside Yourself<br> người việt đầu tiên
                                    </div>
                                </div>

                                <a class="carousel-item__btn-link text-right font_color--white" href="#" title="" tabindex="0">
                                    View aritle
                                    <i class="fas fa-arrow-right font_color--white background--green padding--20"></i>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="about-pagination">
                    <a href="#" class="prev"></a>
                    <a href="#" class="active">1</a>
                    <a href="#">2</a>
                    <a href="#">3</a>
                    <a href="#">4</a>
                    <a href="#">5</a>
                    <a href="#">6</a>
                    <a href="#" class="next"></a>
                </div>
            </div>
        </div>


    </article>
@stop