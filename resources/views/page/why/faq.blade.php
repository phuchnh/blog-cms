@extends('layouts.app-frontend')

@section('content')
    <article class="about faq">
        <!-- Banner -->
        <section class="about__banner banner__about-page background__cover--center-bottom"
                 style="background:url('/app/img/olc-banner_home.jpg')">
        </section>

        @include('page.why.navigate')

        <div class="child-page-top-desc">
            <div class="container">
                <p>
                    TRANSFORM THE WORKPLACE, ONE MINDFUL LEADER AT A TIME
                </p>
                <p class="child-page-top-desc-02">
                    If you’re new to mindfulness & meditation, it’s natural to have many questions. These answers may easeyour mind and help you practice with more confidence.
                </p>
            </div>
        </div>

        @isset($data)
            <div class="faq-content">
                <div class="container">
                    <ul>
                        @foreach ($data as $item)
                            <li class="faq-content__item">
                                <div class="faq-content__item__quest">
                                    <i class="fas fa-plus"></i>
                                    {{$item['description']}}
                                </div>
                                <div class="faq-content__item__answer">
                                    {!! $item['content'] !!}
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    <div class="text-center">
                        <a href="#" class="faq-content__btn">
                            @lang('site.take_an_assessment')
                        </a>
                    </div>
                </div>
            </div>
        @endisset

    </article>
@stop