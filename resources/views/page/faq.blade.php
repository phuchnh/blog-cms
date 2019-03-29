@extends('layouts.app-frontend)

@section('content')
    <article class="about faq">
        <!-- Banner -->
        <section class="about__banner banner__about-page background__cover--center-bottom"
                 style="background:url('../../assets/img/olc-banner_home.jpg')">
        </section>

        <section class="about__navigate container-fluid background--light-grey">
            <ul class="nav">
                <li class="nav-item ">
                    <a class="nav-link" href="#">Benefits</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">How to practise</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">FAQ</a>
                </li>
            </ul>
        </section>

        <div class="child-page-top-desc">
            <div class="container">
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
                <p class="child-page-top-desc-02">
                    If you’re new to mindfulness & meditation, it’s natural to have many questions. These answers may easeyour mind and help you practice with more confidence.
                </p>
            </div>
        </div>


        <div class="faq-content">
            <div class="container">
                <ul>
                    <li class="faq-content__item">
                        <div class="faq-content__item__quest">
                            <i class="fas fa-plus"></i> What is mindfulness?
                        </div>
                        <div class="faq-content__item__answer">
                            Try placing your hand on your belly to further stabilizing attention to your breathing. Alternately, you can choose another anchor, like sounds, body sensations, or the breath combined with body sensations. Experiment with what works for you.
                        </div>
                    </li>
                    <li class="faq-content__item">
                        <div class="faq-content__item__quest">
                            <i class="fas fa-plus"></i> Do I need to set an intention for my practice?
                        </div>
                        <div class="faq-content__item__answer">
                            Try placing your hand on your belly to further stabilizing attention to your breathing. Alternately, you can choose another anchor, like sounds, body sensations, or the breath combined with body sensations. Experiment with what works for you.
                        </div>
                    </li>
                    <li class="faq-content__item">
                        <div class="faq-content__item__quest">
                            <i class="fas fa-plus"></i> What is mindfulness?
                        </div>
                        <div class="faq-content__item__answer">
                            Try placing your hand on your belly to further stabilizing attention to your breathing. Alternately, you can choose another anchor, like sounds, body sensations, or the breath combined with body sensations. Experiment with what works for you.
                        </div>
                    </li>
                    <li class="faq-content__item">
                        <div class="faq-content__item__quest">
                            <i class="fas fa-plus"></i> Do I need to set an intention for my practice?
                        </div>
                        <div class="faq-content__item__answer">
                            Try placing your hand on your belly to further stabilizing attention to your breathing. Alternately, you can choose another anchor, like sounds, body sensations, or the breath combined with body sensations. Experiment with what works for you.
                        </div>
                    </li>
                </ul>
                <div class="text-center">
                    <a href="#" class="faq-content__btn">
                        Take an assessment
                    </a>
                </div>
            </div>
        </div>

    </article>
@stop