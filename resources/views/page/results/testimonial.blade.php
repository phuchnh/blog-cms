@extends('layouts.app-frontend')

@section('content')
    <article class="about testimonials">
        <!-- Banner -->
        <section class="about__banner banner__about-page background__cover--center-bottom"
                 style="background:url('/app/img/olc-banner_home.jpg')">
        </section>

        @include('page.results.navigate')

        <div class="child-page-top-desc">
            <div class="container">
                <p>
                    Our quest for impactful training and coachingsolutions that lead to mindset and behavior change.
                </p>
                <p class="child-page-top-desc-02">
                    In short term, our unique solution will lead to higher Performance and Wellbeing due to Less Stress,More Focus and Clarity, Better Self-awareness and Emotional Control over difficult situations.
                </p>
            </div>
        </div>

        <div class="test__content">
            <div class="container">
                <div id="" class="test__content__slider text-center">
                    <div>
                        <p class="test__content__slider__desc">
                            <i>
                                “I believe that everyone can apply Mindfulness as a way to transform issuesat the workplace, in family and relationships around us. I have learnt how to havea work-life balance thanks to essential Mindfulness practices such as payingattention and being present…”
                            </i>
                        </p>
                        <p class="test__content__slider__author">
                            - Nguyen Hoa Binh -<br />Journalist & Author
                        </p>
                    </div>
                    <div>
                        <p class="test__content__slider__desc">
                            <i>
                                “I believe that everyone can apply Mindfulness as a way to transform issuesat the workplace, in family and relationships around us. I have learnt how to havea work-life balance thanks to essential Mindfulness practices such as payingattention and being present…”
                            </i>
                        </p>
                        <p class="test__content__slider__author">
                            - Nguyen Hoa Binh -<br />Journalist & Author
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="test__content-02">
            <div class="container">
                <div id="client-logo" class="client-logo-carousel">
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
            </div>
        </div>

        <div class="test__content-03">
            <div class="container">
                <div class="test__content-03__slider">
                    <div>
                        <iframe width="100%" height="315" src="https://www.youtube.com/embed/F0wIhtnP6MM" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <div>
                        <iframe width="100%" height="315" src="https://www.youtube.com/embed/F0wIhtnP6MM" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>

                <p class="text-center">
                    Read more about our areas of expertise and what we can offer in <a href="{{route('event-program')}}" class="font_color--orange">@lang('site.event-and-program')</a>
                </p>
            </div>
        </div>


    </article>
@stop