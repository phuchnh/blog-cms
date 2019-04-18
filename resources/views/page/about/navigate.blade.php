<section class="about__navigate container-fluid background--light-grey">
    <ul class="nav">
        <li class="nav-item @isset($slug) @if ($slug === 'story') active @endif @endisset">
            <a class="nav-link" href="/about">STORY</a>
        </li>
        <li class="nav-item @isset($slug) @if ($slug === 'expert') active @endif @endisset">
            <a class="nav-link" href="/about/expert">EXPERT</a>
        </li>
        <li class="nav-item @isset($slug) @if ($slug === 'press') active @endif @endisset">
            <a class="nav-link" href="{{route('press')}}">IN THE PRESS</a>
        </li>
        <li class="nav-item @isset($slug) @if ($slug === 'contact') active @endif @endisset">
            <a class="nav-link" href="/about/contact">CONTACT US</a>
        </li>
    </ul>
</section>