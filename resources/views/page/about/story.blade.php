@extends('app-frontend')

@section('content')
    <article class="about a-story">
        <!-- Banner -->
        <section class="about__banner banner__about-page background__cover--center-bottom"
                 style="background:url('../../assets/img/olc-banner_home.jpg')">
        </section>

        <section class="about__navigate container-fluid background--light-grey">
            <ul class="nav">
                <li class="nav-item active">
                    <a class="nav-link" href="about-us-story.html">STORY</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about-us-expert.html">EXPERT</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about-us-press.html">IN THE PRESS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about-us-contact.html">CONTACT US</a>
                </li>
            </ul>
        </section>

        <div class="child-page-top-desc">
            <div class="container">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
            </div>
        </div>

        <section class="a-story__content">
            <div class="container">
                <div class="a-story__content--left clearfix">
                    <img src="../assets/img/about-story-01.jpg" alt="" />
                    <div class="a-story__content__top">
                        <b>Welcome to One Life Connection!</b>
                        We are proud to be the first professionaltraining & coaching company in Vietnam with both internationally certified and self-designed mindfulness program.
                    </div>
                    <p>
                        Our story began in 2004 when Tien Luong, our Founder, made her first oversea journey to China, the world’s back yard economyat that time. Witnessing how Chinese professionals quickly adaptedto change and how companies vigorously transformed over sucha short period of time stimulated her thinking about innovative business models and people effectiveness.
                    </p>
                    <p>
                        Growing up in a developing socialist country, Tien fully understands and believes in the long-term impact of leadership, not only for the individual but also for the society. She started to create opportunities for herself to work with entrepreneurs and corporates in Vietnam, China, Singapore, Russia, and the Netherlands in order to acquire their multi-disciplinary mindset and skillset for change.
                    </p>
                </div>
                <div class="a-story__content__circle">
                    <span class="a-story__content__circle--orange"></span>
                    <span></span>
                </div>
                <div class="a-story__content--right clearfix">
                    <img src="../assets/img/about-story-02.jpg" alt="" />
                    <img src="" />
                    <p>
                        On a personal quest to bridge the gap between Vietnam and other countries,Tien founded One Life Connection Training & Consultancy in 2011 to deliver high quality skills training and coaching services for clients in pharmaceutical, legal,investment, retail and consuming goods, from multinationals and foreign-invested companies.
                    </p>
                    <p>
                        In the same year, she was introduced to mindfulness & meditation. After a few years of deepening her personal practice with teachers and masters in both the East and the West, she started to integrate mindfulness into her work and orient the company’s programs toward adding self-awareness, self-management, and conscious decision making to participants.
                    </p>

                </div>

            </div>
        </section>

        <section class="a-story__content-02">
            <div class="container">
                <div class="text-center">
                    <p>
                        In the process, Tien acquired certifications to become a mindfulness and meditation teacher, among which areMindfulness-based Happiness and Compassion for Social Emotional Learning with Eurasia Learning Institute, and  Search Inside Yourself, the world’s most saught after Mindfulness-based Emotional Intelligence for Leadership training which has been verysuccessfully endorsed by Google, SAP, Linkedin etc.
                    </p>
                    <p>
                        Looking forward, we are committed to bringing long term impacts in people and organization development solutions bycontinuously strengthening our unique approach and extending our professional network in the region. That way we will be able to adopt the latest trends and progressively contribute to our client’s business, brand and people results.
                    </p>
                </div>
                <iframe width="100%" height="315" src="https://www.youtube.com/embed/F0wIhtnP6MM" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </section>

        <div class="text-center">
            <a href="#" class="a-story__btn">
                Join our company
            </a>
        </div>

    </article>
@stop