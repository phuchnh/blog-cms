@extends('layouts.app-frontend')

@section('content')
    <article class="about practise">
        <!-- Banner -->
        <section class="about__banner banner__about-page background__cover--center-bottom"
                 style="background:url('/app/img/olc-banner_home.jpg')">
        </section>

        @include('page.why.navigate')

        <div class="child-page-top-desc">
            <div class="container">
                TRANSFORM THE WORKPLACE, ONE MINDFUL LEADER AT A TIME
            </div>
        </div>

        <div class="practise__content">
            <div class="text-center container">
                <p>
                    There are many ways to start, whether from sitting to standing, walking, eating, to lying down.Different techniques may work with different people, and in different situations.
                </p>
                <p>
                    There are flexible ways to learn it too, whether from an experienced instructor or following guided meditations from an app.<br/>
                    Once you understand the principles and techniques, you can start practicing anywhere, anytime.
                </p>
                <p>
                    <b><span>Let’s watch</span> an instruction video for beginners by Coach Luong Ngoc Tien.</b>
                </p>
                <iframe width="100%" height="315" src="https://www.youtube.com/embed/F0wIhtnP6MM" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                <a href="#" class="custom-btn">
                    Try our guided meditation
                </a>
            </div>
        </div>

    </article>
@stop