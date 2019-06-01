@extends('layouts.app-frontend')

@section('content')
    <article class="event-section">
        @include('includes.banner-page')

        @include('page.event.navigate')

        <section class="event-main">
            <form class="event-section__header margin_bottom--40 container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="input-group">
                            <select class="custom-select border_radius--2em" name="day">
                                <option value="" selected>@lang('site.day')</option>
                                @for ($i = 1; $i <= 31; $i++)
                                    <option @if($i===intval(Request::query('day'))) selected @endif value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="input-group">
                            <select class="custom-select border_radius--2em" name="month">
                                <option value="" selected>@lang('site.month')</option>
                                @for ($i = 1; $i <= 12; $i++)
                                    <option @if($i===intval(Request::query('month'))) selected @endif value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="input-group">
                            <select class="custom-select border_radius--2em" name="year">
                                <option value="" selected>@lang('site.year')</option>
                                @for ($i = intval(date('Y')); $i >= intval(date('Y'))-3; $i--)
                                    <option @if($i===intval(Request::query('year'))) selected @endif value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6 ml-auto">
                        <div class="form-inline form-search background--white border_radius--2em my-lg-0 ml-auto border--grey">
                            <input class="form-control mr-sm-2 background--none border_none" type="search" name="title"
                                   placeholder="Search" aria-label="Search" value="@if(Request::query('title')){{Request::query('title')}}@endif">
                            <button class="btn my-sm-0 ml-auto" type="submit">
                                <i class="fas fa-search font_color--grey"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            <div class="event-section__container container">
                <div class="row">
                    <div class="col-12">
                        @isset ($data)
                            <div class="card-columns">
                                @foreach ($data as $item)
                                    <div class="card border_radius--none border_none">
                                        @isset($item['meta']['thumbnail']['url'])
                                            <a href="{{route('eventitem', $item['slug'])}}">
                                                <div class="card-img-top background__cover--center"
                                                     style="background: url('{{$item['meta']['thumbnail']['url']}}')">
                                                    <img class="d-none" src="{{$item['meta']['thumbnail']['url']}}"
                                                         alt="{{$item['title']}}">
                                                </div>
                                            </a>
                                        @endisset

                                        <div class="card-body">
                                            <h6 class="font_color--green fs--0-8em font-italic">
                                                @ifIssetShowCategoryTitle($item['taxonomies'])
                                            </h6>
                                            <h5 class="card-title">
                                                <a href="{{route('eventitem', $item['slug'])}}"
                                                   class="font_color--orange fs--1-3em">
                                                    {{$item['title']}}
                                                </a>
                                            </h5>
                                            <div class="card__date font_color--light-grey">
                                                <p class="fs--0-9em">
                                                    @formatDateCarbon($item['meta']['event']['date'])
                                                </p>
                                                <p class="fs--0-9em font-weight-bold">
                                                    @formatTimeCarbon($item['meta']['event']['start_time']) –
                                                    @formatTimeCarbon($item['meta']['event']['end_time'])
                                                </p>
                                            </div>
                                            <hr class="hr__short--grey"/>
                                            <div class="card-text margin_bottom--20">{{$item['description']}}</div>

                                            <a href="{{route('eventitem', $item['slug'])}}" class="font_color--orange">
                                                @lang('site.view_more')
                                                <i class="fas fa-arrow-right fs--0-9em"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endisset
                    </div>
                </div>
            </div>
        </section>
    </article>
@stop
