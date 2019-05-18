<section class="about__navigate container-fluid background--light-grey">
    <ul class="nav">
        <li class="nav-item @isset($slug) @if ($slug === 'approach') active @endif @endisset">
            <a class="nav-link text-uppercase" href="{{route('results').'/approach'}}">@lang('site.approach')</a>
        </li>
        <li class="nav-item @isset($slug) @if ($slug === 'expertise') active @endif @endisset">
            <a class="nav-link text-uppercase" href="{{route('results').'/expertise'}}">@lang('site.expertise')</a>
        </li>
        <li class="nav-item @isset($slug) @if ($slug === 'testimonial') active @endif @endisset">
            <a class="nav-link text-uppercase" href="{{route('results').'/testimonial'}}">@lang('site.testimonials')</a>
        </li>
    </ul>
</section>