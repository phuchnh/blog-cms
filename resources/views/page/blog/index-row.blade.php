@extends('layouts.app-frontend')

@section('content')
    <article class="about blog">
        @include('includes.banner-page')

        @include('page.blog.navigate')

        <div class="blog__content">
            <div class="container">
                <div class="blog__content-03">
                    @isset ($data)
                        @foreach ($data as $item)
                            <div class="blog__content03--item">
                                <div class="row">
                                    @isset($item['meta']['thumbnail']['url'])
                                        <div class="col-xs-12 col-sm-5 col-md-4 col-lg-3">
                                            <div class="blog__content03--item-image background__cover--center"
                                                 style="background: url('{{$item['meta']['thumbnail']['url']}}')">
                                                <img class="d-none" src="{{$item['meta']['thumbnail']['url']}}"
                                                     alt="{{$item['title']}}">
                                            </div>
                                        </div>
                                    @endisset

                                    <div class="col-xs-12 col-sm-7 col-md-8 col-lg-9">
                                        <div class="blog__content03--item-content">
                                            <p class="font_color--grey">{{$item['created_at']}}</p>

                                            <h3 class="font_color--orange font-weight-bold fs--1-7rem margin_top--15 margin_bottom--25">
                                                {{$item['title']}}
                                            </h3>

                                            <p class="margin_bottom--15">{{$item['description']}}</p>

                                            <a href="{{route($slug.'item', $item['slug'])}}" class="font_color--orange"
                                               title="{{$item['title']}}">
                                                @lang('site.view_more') <i class="fas fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endisset
                </div>

                @isset($links)
                    <div class="about-pagination">
                        {{ $links }}
                    </div>
                @endisset

            </div>
        </div>


    </article>
@stop