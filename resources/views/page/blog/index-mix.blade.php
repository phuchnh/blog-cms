@extends('layouts.app-frontend')

@section('content')
    <article class="about blog">
        @include('includes.banner-page')

        @include('page.blog.navigate')

        <div class="child-page-top-desc">
            <div class="container">
                TRANSFORM THE WORKPLACE, ONE MINDFUL LEADER AT A TIME
            </div>
        </div>

        @isset ($data)
            <div class="blog__content">
                <div class="container">
                    <div class="blog__content-01 clearfix">
                        <div class="row">
                            @isset($data[0])
                                <div class="col-xs-12 col-sm-7">
                                    <div class="card border_radius--none">
                                        @isset ($data[0]['meta']['thumbnail']['url'])
                                            <a href="{{route('blogitem',$data[0]['slug'])}}">
                                                <div class="card-img-top background__cover--center"
                                                     style="background: url('{{$data[0]['meta']['thumbnail']['url']}}')">
                                                </div>
                                            </a>
                                        @endisset

                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <a href="{{route('blogitem',$data[0]['slug'])}}"
                                                   class="fs--1-3em font_color--grey">
                                                    {{$data[0]['title']}}
                                                </a>
                                            </h5>
                                            <hr class="hr__short--grey">
                                            <div class="card-text margin_bottom--20">
                                                {{$data[0]['description']}}
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
                                        @isset ($data[1]['meta']['thumbnail']['url'])
                                            <a href="{{route('blogitem',$data[1]['slug'])}}">
                                                <div class="card-img-top background__cover--center"
                                                     style="background: url('{{$data[1]['meta']['thumbnail']['url']}}')">
                                                </div>
                                            </a>
                                        @endisset

                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <a href="{{route('blogitem',$data[1]['slug'])}}"
                                                   class="fs--1-3em font_color--grey">
                                                    {{$data[1]['title']}}
                                                </a>
                                            </h5>
                                            <hr class="hr__short--grey">
                                            <div class="card-text margin_bottom--20">{{$data[1]['description']}}</div>

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
                    </div>

                    @if(count($data) > 2)
                        <div class="blog__content-02">
                            <div class="card-columns">
                                @foreach ($data as $key => $item)
                                    @if ($key === 0 || $key === 1)
                                        @continue
                                    @endif

                                    <div class="card border_radius--none">
                                        @isset ($item['meta']['thumbnail']['url'])
                                            <a href="{{route('blogitem',$item['slug'])}}">
                                                <div class="card-img-top background__cover--center"
                                                     style="background: url('{{$item['meta']['thumbnail']['url']}}')">
                                                </div>
                                            </a>
                                        @endisset

                                        <div class="card-body">
                                            <h5 class="card-title fs--1-3em">
                                                <a href="{{route('blogitem',$item['slug'])}}"
                                                   class="fs--1-3em font_color--grey">
                                                    {{$item['title']}}
                                                </a>
                                            </h5>
                                            <hr class="hr__short--grey">
                                            <div class="card-text margin_bottom--20">{{$item['description']}}</div>

                                            <p class="text-right">
                                                <a href="{{route('blogitem',$item['slug'])}}"
                                                   class="font_color--orange">
                                                    @lang('site.view_more')
                                                    <i class="fas fa-arrow-right fs--0-9em"></i>
                                                </a>
                                            </p>
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