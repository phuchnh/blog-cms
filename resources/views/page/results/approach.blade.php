@extends('layouts.app-frontend')

@section('content')
    <article class="about approach">
        @include('includes.banner-page')

        @include('page.results.navigate')

        @include('includes.content-single')
        <div class="child-page-top-desc">
            <div class="container">
               TRANSFORM THE WORKPLACE, ONE MINDFUL LEADER AT A TIME
            </div>
        </div>

        <div class="approach__content">
            <div class="container clearfix">
                <img src="/app/img/approach-01.png" alt="" />
                <p>
                    At One Life Connection, we take your questions of practicality and impacts seriously.
                </p>
                <p>
                    We find an integral solution in Mindfulness-based training & coaching programs, which, with over a few weeksof regular application, results in mindset and behaviour change.
                </p>
                <p>
                    Our solutions are based on 4 core elements: Neuroscience, Mindfulness, Emotional Intelligence, Happiness and Wellbeing.
                </p>
            </div>
            <div class="container">
                <p>
                    To tackle with today’s constant changes and challenges, we bring internationally certified training programs and high-profile consultants to Vietnam. We then add our local knowledge and language to ensure our client get the best of both solutions.
                </p>
            </div>
        </div>

        <div class="approach__content-02">
            <div class="container text-center">
                <p>
                    According to our client’s specific needs and contexts, whether it relates to Customer Service, Employee Engagement,Corporate Culture or Leadership Development, we are able to design and deliver bespoke solutions to ensure short,medium and long-term impacts.
                </p>
                <p>
                    <img src="/app/img/approach-02.png" alt="" />
                </p>
            </div>
        </div>

        <div class="text-center">
            <a href="#" class="custom-btn">Contact Us</a>
        </div>
    </article>
@stop