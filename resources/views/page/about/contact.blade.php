@extends('layouts.app-frontend')

@section('content')
    <article class="about about-contact">
        @include('includes.banner-page')

        @include('page.about.navigate')

        @include('includes.content-single')
    </article>
@stop