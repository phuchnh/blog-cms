@extends('layouts.app-frontend')

@section('content')
    <article class="about about-contact">
        @include('page.about.banner')

        @include('page.about.navigate')

        @include('page.about.content')
    </article>
@stop