@extends('layouts.app-frontend')

@section('content')
    <article class="about a-story">
        @include('includes.banner-page')

        @include('page.about.navigate')

        @include('includes.content-single')
    </article>
@stop