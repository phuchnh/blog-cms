<section class="about__navigate container-fluid background--light-grey">
    <ul class="nav">
        <li class="nav-item @isset($slug) @if ($slug === 'benefits') active @endif @endisset">
            <a class="nav-link text-capitalize" href="{{route('why-mind-fullness').'/benefits'}}">@lang('site.benefits')</a>
        </li>
        <li class="nav-item @isset($slug) @if ($slug === 'practise') active @endif @endisset">
            <a class="nav-link text-capitalize" href="{{route('why-mind-fullness').'/practise'}}">@lang('site.how_to_practise')</a>
        </li>
        <li class="nav-item @isset($slug) @if ($slug === 'faq') active @endif @endisset">
            <a class="nav-link text-capitalize" href="{{route('faq')}}">@lang('site.faq')</a>
        </li>
    </ul>
</section>