@extends('app-frontend')

@section('content')
    <article class="about a-expert">
        <!-- Banner -->
        <section class="about__banner banner__about-page background__cover--center-bottom"
                 style="background:url('../../assets/img/olc-banner_home.jpg')">
        </section>

        <section class="about__navigate container-fluid background--light-grey">
            <ul class="nav">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="about-us-story.html">STORY</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="about-us-expert.html">EXPERT</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about-us-press.html">IN THE PRESS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about-us-contact.html">CONTACT US</a>
                    </li>
                </ul>
            </ul>
        </section>

        <div class="a-expert__top">
            <div class="container">
                <p class="a-expert__top-01">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <p class="a-expert__top-02">We would like to connect with trainers and coaches  who share our approach and want to cooperate for projects worth doing in Vietnam.</p>
            </div>
        </div>

        <section class="a-expert__member">
            <div class="container">
                <div class="a-expert__member__item a-expert__member--boss">
                    <h2>
                        <img src="../assets/img/about-expert-01.jpg" alt="" />
                        Founder, Luong Ngoc Tien
                        <span>The first Vietnamese Search Inside Yourself Teacher in Vietnam</span>
                    </h2>
                    <div>
                        <p>
                            Now based in Ho Chi Minh City, Vietnam, Tien designs and facilitates management courses, mindfulness programs and provides one-on-one coaching for individuals, groups andcompanies.
                            She has the energy and insights to foster and shape social entrepreneurs,intrapreneurs, and entrepreneurs and motivate them to fully realize their potentials.
                            She has been invited to speak at <b>Forbes Women Summit 2018</b> and <b>Tedx Tay Ho Women 2018</b> onHappiness and Mindfulness topics.
                        </p>
                        <p>
                            She is currently Board member of HCMC Association for Women Entrepreneurs & Executives(HAWEE.vn) and local partner of Eurasia Learning Institute (Eurasia.org.vn).
                        </p>
                    </div>
                </div>
                <div class="a-expert__member__item">
                    <h2>
                        <img src="../assets/img/about-expert-01.jpg" alt="" />
                        Arnaud Duran
                        <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit</span>
                    </h2>
                    <div>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                    </div>
                </div>

            </div>
        </section>


    </article>
@stop