<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-title" content="">

<meta property="og:url" content="{{base_path()}}">
<meta property="og:type" content="website">

@isset($meta['facebook_id'])
    <meta property="fb:app_id" content="{{$meta['facebook_id']}}">
@endisset

@isset($meta['description'])
    <meta name="description" content="">
    <meta property="og:description"
          content="{{$meta['description']}}">
@endisset

@isset($meta['keywords'])
    <meta name="keywords" content="{{$meta['keywords']}}">
@endisset

@isset($meta['author'])
    <meta name="author" content="{{$meta['author']}}">
@endisset

@isset($meta['title'])
    <meta property="og:title" content="{{$meta['title']}}">
    <title>{{$meta['title']}}</title>
@endisset

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

{{--<link rel="apple-touch-icon" sizes="57x57" href="https://dinosaur.vn/assets/img/apple-icon-57x57.png">--}}
{{--<link rel="apple-touch-icon" sizes="60x60" href="https://dinosaur.vn/assets/img/apple-icon-60x60.png">--}}
{{--<link rel="apple-touch-icon" sizes="72x72" href="https://dinosaur.vn/assets/img/apple-icon-72x72.png">--}}
{{--<link rel="apple-touch-icon" sizes="76x76" href="https://dinosaur.vn/assets/img/apple-icon-76x76.png">--}}
{{--<link rel="apple-touch-icon" sizes="114x114" href="https://dinosaur.vn/assets/img/apple-icon-114x114.png">--}}
{{--<link rel="apple-touch-icon" sizes="120x120" href="https://dinosaur.vn/assets/img/apple-icon-120x120.png">--}}
{{--<link rel="apple-touch-icon" sizes="144x144" href="https://dinosaur.vn/assets/img/apple-icon-144x144.png">--}}
{{--<link rel="apple-touch-icon" sizes="152x152" href="https://dinosaur.vn/assets/img/apple-icon-152x152.png">--}}
{{--<link rel="apple-touch-icon" sizes="180x180" href="https://dinosaur.vn/assets/img/apple-icon-180x180.png">--}}
{{--<link rel="icon" type="image/png" sizes="192x192" href="https://dinosaur.vn/assets/img/android-icon-192x192.png">--}}

</head>