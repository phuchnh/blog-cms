@extends('layouts.app-frontend')

@section('content')
    <article class="about blog">
        <!-- Banner -->
        <section class="about__banner banner__about-page background__cover--center-bottom"
                 style="background:url('/app/img/olc-banner_home.jpg')">
        </section>

        @include('page.blog.navigate')

        <div class="child-page-top-desc">
            <div class="container">
                TRANSFORM THE WORKPLACE, ONE MINDFUL LEADER AT A TIME
            </div>
        </div>

        @isset ($data)
            <div class="blog__content">
                <div class="container">
                    @if(count($data) > 2)
                        <div class="blog__content-01 card-deck clearfix">
                            @isset($data[0])
                                <div class="col-xs-12 col-sm-7">
                                    <div class="card border_radius--none">
                                        @isset ($data[0]['thumbnail'])
                                            <div class="card-img-top background__cover--center"
                                                 style="background: url({{$data[0]['thumbnail']}})">
                                            </div>
                                        @endisset

                                        <div class="card-body">
                                            <h5 class="card-title fs--1-3em">{{$data[0]['title']}}</h5>
                                            <hr class="hr__short--grey">
                                            <div class="card-text margin_bottom--20">
                                                {{$data[0]['content']}}
                                            </div>

                                            <p class="text-right">
                                                <a href="{{route('blogitem',$data[0]['slug'])}}"
                                                   class="font_color--orange">
                                                    @lang('site.view_more')
                                                    <i class="fas fa-arrow-right fs--0-9em"></i>
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endisset

                            @isset($data[1])
                                <div class="col-xs-12 col-sm-5">
                                    <div class="card border_radius--none">
                                        @isset ($data[0]['thumbnail'])
                                            <div class="card-img-top background__cover--center"
                                                 style="background: url({{$data[1]['thumbnail']}})">
                                            </div>
                                        @endisset

                                        <div class="card-body">
                                            <h5 class="card-title fs--1-3em">{{$data[1]['title']}}</h5>
                                            <hr class="hr__short--grey">
                                            <div class="card-text margin_bottom--20">{{$data[1]['content']}}</div>

                                            <p class="text-right">
                                                <a href="{{route('blogitem',$data[1]['slug'])}}"
                                                   class="font_color--orange">
                                                    @lang('site.view_more')
                                                    <i class="fas fa-arrow-right fs--0-9em"></i>
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endisset
                        </div>
                    @endif

                    @if(count($data) > 3)
                        <div class="blog__content-02">
                            <div class="card-deck">
                                @foreach ($data as $key => $item)
                                    @if ($key === 0 || $key === 1)
                                        @continue
                                    @endif

                                    <div class="col-xs-12 col-sm-4">
                                        <div class="card border_radius--none">
                                            <div class="card-img-top background__cover--center"
                                                 style="background: url({{$item['title']}})">
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title fs--1-3em">{{$item['title']}}</h5>
                                                <hr class="hr__short--grey">
                                                <div class="card-text margin_bottom--20">{{$item['content']}}</div>

                                                <p class="text-right">
                                                    <a href="{{route('blogitem',$item['slug'])}}"
                                                       class="font_color--orange">
                                                        @lang('site.view_more')
                                                        <i class="fas fa-arrow-right fs--0-9em"></i>
                                                    </a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @isset($links)
                        <div class="about-pagination">
                            {{ $links }}
                        </div>
                    @endisset
                </div>
            </div>
        @endisset
    </article>
@stop