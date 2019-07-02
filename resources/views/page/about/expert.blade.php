@extends('layouts.app-frontend')

@section('content')
    <article class="about a-expert">
        @include('includes.banner-page')

        @include('page.about.navigate')

        @include('includes.content-single')

        @isset($people)
            @if($people)
                <section class="a-expert__member">
                    <div class="container">
                        @foreach($people as $person)
                            <div class="a-expert__member__item a-expert__member--boss">
                                <h2>
                                    @isset($person['meta']['thumbnail']['url'])
                                        <img width="189" height="189" src="{{$person['meta']['thumbnail']['url']}}" alt="{{$person['title']}}"/>
                                    @endisset
                                    {{$person['title']}}

                                    <span>{{$person['description']}}</span>
                                </h2>
                                <div>{!! $person['content'] !!}</div>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif
        @endisset
    </article>
    
    <style>
        iframe{
            width: 100%;
        }
    </style>
@stop