<section class="sub-navigate container-fluid background--light-grey">
    <ul class="nav">
        <li class="nav-item @isset($subnavigate) @if ($subnavigate === 'program') active @endif @endisset">
            <a class="nav-link text-uppercase" href="{{route('program')}}">@lang('site.programs')</a>
        </li>
        <li class="nav-item @isset($subnavigate) @if ($subnavigate === 'event') active @endif @endisset">
            <a class="nav-link text-uppercase" href="{{route('event')}}">@lang('site.events')</a>
        </li>
    </ul>
</section>