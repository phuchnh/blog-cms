@extends('layouts.app-frontend')

@section('content')
    <article class="about testimonials">
        @include('includes.banner-page')

        @include('page.results.navigate')

        @include('includes.content-single')

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