<section class="about__navigate container-fluid background--light-grey">
    <ul class="nav">
        <li class="nav-item @isset($subnavigate) @if ($subnavigate === 'blogs') active @endif @endisset">
            <a class="nav-link text-capitalize" href="{{route('blog')}}">@lang('site.blogs')</a>
        </li>
        <li class="nav-item @isset($subnavigate) @if ($subnavigate === 'guided-meditation') active @endif @endisset">
            <a class="nav-link text-capitalize" href="{{route('guide')}}">Guided Meditation</a>
        </li>
        <li class="nav-item @isset($subnavigate) @if ($subnavigate === 'daily-practices') active @endif @endisset">
            <a class="nav-link text-capitalize" href="{{route('practice')}}">Daily practices</a>
        </li>
    </ul>
</section>