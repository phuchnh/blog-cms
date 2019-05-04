@extends('layouts.app-frontend')

@section('content')
    <article class="about a-story">
        @include('page.about.banner')

        @include('page.about.navigate')

        @include('page.about.content')
    </article>
@stop