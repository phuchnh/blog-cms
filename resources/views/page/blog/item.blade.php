@extends('layouts.app-frontend')

@section('content')
    <article class="event-section">
        <!-- Banner -->
        @isset($item['meta']['banner']['url'])
            <section
                    class="event__banner banner__event-page background__cover--center-bottom element_center--text-center"
                    style="background:url('{{$item['meta']['banner']['url']}}')">
            </section>
        @endisset

        <section class="event-main padding--none">
            <div class="event-section__container container">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="event-section__breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('home')}}">@lang('site.home')</a></li>
                                    <li class="breadcrumb-item">
                                        @isset($subnavigate)
                                            @if ($subnavigate === 'blogs')
                                                <a href="{{route('program')}}">@lang('site.blogs')</a>
                                            @elseif($subnavigate === 'guided-meditation')
                                                <a href="{{route('guide')}}">@lang('site.guided-meditation')</a>
                                            @else
                                                <a href="{{route('practice')}}">@lang('site.daily-practices')</a>
                                            @endif
                                        @endisset
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        {{$item['title']}}
                                    </li>
                                </ol>
                            </nav>
                        </div>
                        <div class="event-body">
                            <h1 class="font_color--orange">{{$item['title']}}</h1>

                            <hr class="hr__short--grey"/>

                            <div class="event-content">
                                {!! $item['content'] !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if ($others)
                <div class="event-section__other">
                    <header class="text-center font-weight-bold fs--1-7rem text-capitalize">
                        @lang('site.other_posts_you_may_like')
                    </header>

                    <div class="event-section__other--list container">
                        <div class="card-deck">
                            @foreach( $others as $other)
                                <div class="card border_radius--none border_none">
                                    @isset($other['meta']['thumbnail']['url'])
                                        <div class="card-img-top background__cover--center"
                                             style="background: url('{{$other['meta']['thumbnail']['url']}}')">
                                            <img class="d-none" src="{{$other['meta']['thumbnail']['url']}}"
                                                 alt="{{$other['title']}}">
                                        </div>
                                    @endisset

                                    <div class="card-body">
                                        <h6 class="font_color--green fs--0-8em font-italic">
                                            @ifIssetShowCategoryTitle($item['taxonomies'])
                                        </h6>
                                        <h5 class="card-title font_color--orange fs--1-3em">
                                            {{$other['title']}}
                                        </h5>
                                        <div class="card__date font_color--light-grey">
                                            <p class="fs--0-9em">{{$other['created_at']}}</p>
                                        </div>
                                        <hr class="hr__short--grey"/>
                                        <a href="{{route($slug.'item', $other['slug'])}}" class="font_color--orange">
                                            @lang('site.view_more')
                                            <i class="fas fa-arrow-right fs--0-9em"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </section>
    </article>
@stop