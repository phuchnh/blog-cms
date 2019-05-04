@extends('layouts.app-frontend')

@section('content')
    <article class="about a-expert">
        @include('page.about.banner')

        @include('page.about.navigate')

        @include('page.about.content')
    </article>
@stop