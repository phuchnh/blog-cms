<section class="about__navigate container-fluid background--light-grey">
    <ul class="nav">
        <li class="nav-item @isset($subnavigate) @if ($subnavigate === 'blogs') active @endif @endisset">
            <a class="nav-link text-uppercase" href="{{route('blog')}}">@lang('site.blogs')</a>
        </li>
        <li class="nav-item @isset($subnavigate) @if ($subnavigate === 'guided-meditation') active @endif @endisset">
            <a class="nav-link text-uppercase" href="{{route('guide')}}">@lang('site.guided-meditation')</a>
        </li>
        <li class="nav-item @isset($subnavigate) @if ($subnavigate === 'daily-practices') active @endif @endisset">
            <a class="nav-link text-uppercase" href="{{route('practice')}}">@lang('site.daily-practices')</a>
        </li>
    </ul>
</section>