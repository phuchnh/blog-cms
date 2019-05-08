@extends('layouts.app-frontend')

@section('content')
    <article class="about faq">
        @include('includes.banner-page')

        @include('page.why.navigate')

        @include('includes.content-single')

        @isset($data)
            <div class="faq-content">
                <div class="container">
                    <ul>
                        @foreach ($data as $item)
                            <li class="faq-content__item">
                                <div class="faq-content__item__quest">
                                    <i class="fas fa-plus"></i>
                                    {{$item['title']}}
                                </div>
                                <div class="faq-content__item__answer">
                                    {!! $item['content'] !!}
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    <div class="text-center">
                        <a href="#" class="faq-content__btn">
                            @lang('site.take_an_assessment')
                        </a>
                    </div>
                </div>
            </div>
        @endisset

    </article>
@stop