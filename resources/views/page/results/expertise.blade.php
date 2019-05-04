@extends('layouts.app-frontend')

@section('content')
    <article class="about approach">
        @include('includes.banner-page')

        @include('page.results.navigate')

        @include('includes.content-single')
    </article>
@stop