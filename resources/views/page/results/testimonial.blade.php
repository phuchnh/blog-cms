@extends('layouts.app-frontend')

@section('content')
    <article class="about testimonials">
        @include('includes.banner-page')

        @include('page.results.navigate')

        @include('includes.content-single')

        @isset($testimonials)
            @if($testimonials)
                <div class="test__content">
                    <div class="container">
                        <div class="test__content__slider text-center">
                            @foreach ($testimonials as $testimonial)
                                <div>
                                    <p class="test__content__slider__desc">
                                        <i>
                                            “{!! $testimonial['content'] !!}”
                                        </i>
                                    </p>
                                    <p class="test__content__slider__author">
                                        - {{$testimonial['title']}} -<br/>{{$testimonial['description']}}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        @endisset

        @isset($clients)
            <div class="test__content-02">
                <div class="container">
                    <div id="client-logo" class="client-logo-carousel">
                        @foreach ($clients as $client)
                            @isset($client['meta']['thumbnail']['url'])
                                <a target="_blank" href="{{$client['url']}}">
                                    <img src="{{$client['meta']['thumbnail']['url']}}" alt="{{$client['name']}}">
                                </a>
                            @endisset
                        @endforeach
                    </div>
                </div>
            </div>
        @endisset
    </article>
@stop