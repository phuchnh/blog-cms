@extends('layouts.app-frontend')

@section('content')
    <article class="about about-contact">
        <!-- Banner -->
        <section class="about__banner banner__about-page background__cover--center-bottom"
                 style="background:url('/app/img/olc-banner_home.jpg')">
        </section>

        @include('page.about.navigate')

        <div class="about-contact__top">
            <div class="container">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
            </div>
        </div>

        <section class="about-contact__desc">
            <div class="container">
                <h2>You want to know who we are and what we can offer.</h2>
                <p>
                    We offer mindfulness-based training & coaching solutions to improve Performance & Purpose for individuals, teams and organizations.
                </p>
                <p>
                    <b>Our solutions are based on <span>Mindfulness</span>, <span>Neuroscience</span>, and <span>Emotional Intelligence</span>, <span>Happiness & Wellbeing</span></b>
                </p>
                <p>
                    Depending on our client’s timeframe, group size and budget, we deliver various formats of Key-note Talk, day to full day Workshop, Workshop series, Short-course to Regular Program, with or without follow-up package.
                </p>
                <p>
                    We offer the world’s famous <span>Search Inside Yourself</span> program, originated from Google, for public and companies.<br />
                    Our company and program have been featured in Forbes Vietnam (<span>December 2018 issue</span>).
                </p>
                <a href="#" class="about-contact__desc__btn">Download our company presentation here.</a>
            </div>
        </section>

        <!-- Introduction -->
        <section class="about-contact__desc about-contact__desc--02">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <img src="/app/img/about-contact-01.jpg" alt="contact about" />
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <h2>You want to connect with us.</h2>
                        <p>
                            Our company was founded with an aim to connect like-hearted and minded people anywhere in the world to deliver profit and non-profit projects worth doing.
                        </p>
                        <p>
                            Connect with us on <a href="#">Linkedin</a> or email to let us know more about you and what you are aspired to do with your
                            workplace and community.
                        </p>
                        <p>
                            Send us an <span>Inquiry</span> OR <span>subscribe</span> to our network and
                            receive news, blogs and updates from us.
                        </p>
                    </div>
                </div>
                <div class="text-center">
                    <a href="#" class="about-contact__desc__btn">
                        Download company presentation
                    </a>
                </div>
            </div>
        </section>
    </article>
@stop