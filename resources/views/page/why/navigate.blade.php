<section class="about__navigate container-fluid background--light-grey">
    <ul class="nav">
        <li class="nav-item @isset($slug) @if ($slug === 'benefits') active @endif @endisset">
            <a class="nav-link text-capitalize" href="/whymindfullness/benefits">@lang('site.benefits')</a>
        </li>
        <li class="nav-item @isset($slug) @if ($slug === 'how-to-practise') active @endif @endisset">
            <a class="nav-link text-capitalize" href="/whymindfullness/how-to-practise">@lang('site.how_to_practise')</a>
        </li>
        <li class="nav-item @isset($slug) @if ($slug === 'faq') active @endif @endisset">
            <a class="nav-link text-capitalize" href="{{route('faq')}}">@lang('site.faq')</a>
        </li>
    </ul>
</section>