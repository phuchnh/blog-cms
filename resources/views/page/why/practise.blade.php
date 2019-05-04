@extends('layouts.app-frontend')

@section('content')
    <article class="about practise">
        @include('includes.banner-page')

        @include('page.why.navigate')

        @include('includes.content-single')
    </article>
@stop