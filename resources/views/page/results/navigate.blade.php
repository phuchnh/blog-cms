<section class="about__navigate container-fluid background--light-grey">
    <ul class="nav">
        <li class="nav-item @isset($slug) @if ($slug === 'approach') active @endif @endisset">
            <a class="nav-link" href="{{route('results').'/story'}}/approach">@lang('site.approach')</a>
        </li>
        <li class="nav-item @isset($slug) @if ($slug === 'expertise') active @endif @endisset">
            <a class="nav-link" href="{{route('results')}}/expertise">@lang('site.expertise')</a>
        </li>
        <li class="nav-item @isset($slug) @if ($slug === 'testimonial') active @endif @endisset">
            <a class="nav-link" href="{{route('results')}}/testimonial">@lang('site.testimonial')</a>
        </li>
    </ul>
</section>