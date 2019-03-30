@extends('app-frontend')

@section('content')
    <article class="about benefits">
        <!-- Banner -->
        <section class="about__banner banner__about-page background__cover--center-bottom"
                 style="background:url('/app/img/olc-banner_home.jpg')">
        </section>

        <section class="about__navigate container-fluid background--light-grey">
            <ul class="nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Benefits</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="#">How to practise</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="#">FAQ</a>
                </li>
            </ul>
        </section>

        <div class="child-page-top-desc">
            <div class="container">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
            </div>
        </div>

        <div class="benefits__content">
            <div class="container benefits__content-01">
                <p class="text-center">
                    <img src="/app/img/benefits-01.png" alt="" />
                </p>
                <p>
                    Meditation is no longer some esoteric practice that requires you to completely disconnect from your life, and travelto a retreat in a remote part of the world.
                </p>
                <p>
                    Today it is made accessible via your phone or within your community and organization. It gives people an opportunity to look within, to deepen three core qualities: Concentration, Mindfulness, and Compassion.
                </p>
                <p>
                    Whether formally defined by scientists, or informally described by practitioners, meditation has become a secular form of mental training for individuals and organizations.
                </p>
                <p>
                    Scientifically proven, Mindfulness increases Attentional Control, Self Awarness, Emotion and Behavior Regulation. Having Mindfulness skills will lead to long lasting impacts that individuals and organizations are looking for:
                </p>
                <p class="text-center">
                    <img src="/app/img/benefits-02.png" alt="" />
                </p>
            </div>
            <div class="benefits__content-02">
                <div class="container text-center">
                    <img src="/app/img/benefits-03.png" alt="" />
                </div>
            </div>
            <div class="container">
                <p>
                    <b>Jeff Weiner,</b> CEO of Linkedin, the professional social network with over 450 million members, has acknowledged his daily use of guided meditations and regularly <span>scientific benefits of meditation</span>. Weiner said that pausing to reflect onsituations helps him to strategize and work proactively towards long-term goals.
                </p>
                <p>
                    <b>Peter Bostelmann,</b> Director of Global mindfulness practice from SAP, the German global technology giant, said: “It’s the new jogging. Employees are more healthy, engaged and they can cope better with a changing world.”
                </p>
                <p>
                    Insurance giant <b>Aetna’s Mindfulness programs</b> in 2012 led to 7 percent decrease in employee health care costs.<br />
                    That equalled $6.3 million going straight to the bottom line, partly attributed to mindfulness training (from Mindful Work)
                </p>
                <div class="text-center">
                    <a href="#" class="custom-btn">
                        Read Our Blogs
                    </a>
                </div>
            </div>
        </div>

    </article>
@stop