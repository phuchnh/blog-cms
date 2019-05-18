<section class="about__navigate container-fluid background--light-grey">
    <ul class="nav">
        <li class="nav-item @isset($slug) @if ($slug === 'story') active @endif @endisset">
            <a class="nav-link text-uppercase" href="{{route('about').'/story'}}">@lang('site.story')</a>
        </li>
        <li class="nav-item @isset($slug) @if ($slug === 'expert') active @endif @endisset">
            <a class="nav-link text-uppercase" href="{{route('about').'/expert'}}">@lang('site.experts')</a>
        </li>
        <li class="nav-item @isset($slug) @if ($slug === 'press') active @endif @endisset">
            <a class="nav-link text-uppercase" href="{{route('press')}}">@lang('site.in_the_press')</a>
        </li>
        <li class="nav-item @isset($slug) @if ($slug === 'contact') active @endif @endisset">
            <a class="nav-link text-uppercase" href="{{route('about').'/contact'}}">@lang('site.contact-us')</a>
        </li>
    </ul>
</section>