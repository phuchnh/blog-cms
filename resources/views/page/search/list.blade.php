@extends('layouts.app-frontend')

@section('content')
    <article class="about blog">
        <div class="blog__content">
            <div class="container">
                <div class="blog__content-03">
                    @isset ($data)
                        @foreach ($data as $item)
                            <div class="blog__content03--item">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-7 col-md-8 col-lg-9">
                                        <div class="blog__content03--item-content">
                                            <p class="font_color--grey">@formatDateCarbon($item['created_at'])</p>

                                            <h3 class="font_color--orange font-weight-bold fs--1-7rem margin_top--15 margin_bottom--25">
                                                {{$item['title']}}
                                            </h3>

                                            <p class="margin_bottom--15">{{$item['description']}}</p>

                                            <a href="@if($item['route'][0] === 'faq' || $item['route'][0] === 'home'){{route($item['route'][0])}} @else {{route($item['route'][0], $item['slug'])}}@endif"
                                               class="font_color--orange"
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