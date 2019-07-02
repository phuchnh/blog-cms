<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-title" content="">

@isset($meta['facebook_id'])
    <meta property="fb:app_id" content="{{$meta['facebook_id']}}">
@endisset

{!! SEO::generate() !!}

@isset($meta['favicon'])
    <link type="image/x-icon" rel="icon" href="{{$meta['favicon']}}">

    {{--<link rel="icon" type="image/png" sizes="32x32" href="https://dinosaur.vn/assets/img/favicon-32x32.png">--}}
    {{--<link rel="icon" type="image/png" sizes="96x96" href="https://dinosaur.vn/assets/img/favicon-96x96.png">--}}
    {{--<link rel="icon" type="image/png" sizes="16x16" href="https://dinosaur.vn/assets/img/favicon-16x16.png">--}}
    {{--<link rel="icon" type="image/png" sizes="32x32" href="https://dinosaur.vn/assets/img/favicon-32x32.png">--}}
    {{--<link rel="icon" type="image/png" sizes="16x16" href="https://dinosaur.vn/assets/img/favicon-16x16.png">--}}
@endisset

@isset($meta['facebook_image'])
    <meta property="og:image" content="{{$meta['facebook_image']['url']}}">
    <meta property="og:image:width" content="{{$meta['facebook_image']['width']}}">
    <meta property="og:image:height" content="{{$meta['facebook_image']['height']}}">
@endisset