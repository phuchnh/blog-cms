@extends('layouts.app-frontend')

@section('content')
    <div class="form-subscriber">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-5 background__cover--center-bottom form-background"
                     style="background:url('/app/img/background-form.jpg')">
                    <h1>@lang('site.subscribe')</h1>
                </div>

                <div class="col-xs-12 col-sm-7">
                    <div class="form-container">
                        @if ($errors->any())
                            <div class="m-4">
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        <form action="{{route('subscriber.store')}}"
                              method="POST"
                              class="form form-action background--white">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="type" value="{{ Request::segment(3) }}">
                            <div class="form-input-area" style="margin-bottom: 25px; font-weight: bold; font-size: 1.8rem">
                                <b>@lang('site.subscribe-headline')</b>
                            </div>
                            <div class="form-input-area">
                                <input class="form-control mr-sm-2 background--none border_none"
                                       type="text"
                                       name="name"
                                       placeholder="@lang('site.your-name')"
                                       aria-label="name">

                                <input class="form-control mr-sm-2 background--none border_none"
                                       type="text"
                                       name="email"
                                       placeholder="@lang('site.your-email')"
                                       aria-label="email">
                            </div>

                            <button class="btn background--orange font_color--white text-capitalize btn-block my-sm-0 ml-auto"
                                    type="submit">
                                @lang('site.submit-form')
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
