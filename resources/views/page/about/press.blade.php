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
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua.
            </div>
        </div>

        <div class="a-press__content">
            <div class="container">
                @isset ($data)
                    @if(count($data) > 2)
                        <div class="row">
                            @isset($data[0])
                                <div class="col-xs-12 col-sm-6 a-press__item ">
                                    <div class="custom-item-press">
                                        <img src="{{$data[0]['thumbnail']}}" alt="{{$data[0]['title']}}">
                                        <div class="d-block">
                                            <div class=" font_color--white">
                                                <header class="font-italic">
                                                    CAFEBIZ
                                                </header>

                                                <div class="content text-uppercase">
                                                    {{$data[0]['title']}}
                                                </div>
                                            </div>

                                            <a class="carousel-item__btn-link text-right font_color--white"
                                               href="{{route('pressitem', $data[0]['slug'])}}"
                                               title="{{$data[0]['title']}}"
                                               tabindex="0">
                                                @lang('site.view_more')
                                                <i class="fas fa-arrow-right font_color--white background--green padding--20"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endisset

                            @isset($data[1])
                                <div class="col-xs-12 col-sm-6 a-press__item ">
                                    <div class="custom-item-press">
                                        <img src="{{$data[1]['thumbnail']}}" alt="{{$data[1]['title']}}">
                                        <div class="d-block">
                                            <div class=" font_color--white">
                                                <header class="font-italic">
                                                    CAFEBIZ
                                                </header>

                                                <div class="content text-uppercase">
                                                    {{$data[1]['title']}}
                                                </div>
                                            </div>

                                            <a class="carousel-item__btn-link text-right font_color--white"
                                               href="{{route('pressitem', $data[1]['slug'])}}"
                                               title="{{$data[1]['title']}}"
                                               tabindex="0">
                                                @lang('site.view_more')
                                                <i class="fas fa-arrow-right font_color--white background--green padding--20"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endisset
                        </div>
                    @endif

                    @if(count($data) > 3)
                        <div class="row a-press__content--child">
                            @foreach ($data as $key => $item)
                                @if ($key === 0 || $key === 1)
                                    @continue
                                @endif

                                <div class="col-xs-12 col-sm-4 a-press__item a-press__item--child">
                                    <div class="custom-item-press">
                                        <img src="{{$item['thumbnail']}}" alt="{{$item['title']}}">
                                        <div class="d-block">
                                            <div class=" font_color--white">
                                                <header class="font-italic">
                                                    CAFEBIZ
                                                </header>

                                                <div class="content text-uppercase">
                                                    {{$item['title']}}
                                                </div>
                                            </div>

                                            <a class="carousel-item__btn-link text-right font_color--white"
                                               href="{{route('pressitem', $item['slug'])}}"
                                               title="{{$item['title']}}"
                                               tabindex="0">
                                                @lang('site.view_more')
                                                <i class="fas fa-arrow-right font_color--white background--green padding--20"></i>
                                            </a>
                                        </div>
                                    </div>

                                </div>

                            @endforeach
                        </div>
                    @endif
                @endisset

                @isset($links)
                    <div class="about-pagination">
                        {{ $links }}
                    </div>
                @endisset
            </div>
        </div>


    </article>
@stop