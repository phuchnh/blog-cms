@extends('layouts.app-frontend')

@section('content')
    <div class="form-subscriber">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-5 background__cover--center-bottom form-background"
                     style="background:url('/app/img/background-form.jpg')">
                    <h1>THANK YOU</h1>
                </div>

                <div class="col-xs-12 col-sm-7">
                    <div class="form-container">
                        <div class="content">
                            @php
                                $thankyou = json_decode($setting['thankyou']);
                            @endphp

                            @isset($thankyou->{app()->getLocale()})
                                {!! $thankyou->{app()->getLocale()} !!}
                            @endif

                            <div class="clearfix"/>

                            <a href="{{route('home')}}" class="btn-link text-capitalize font_color--orange">
                                <i class="fa fa-caret-left"></i>

                                @lang('site.go_back')
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
