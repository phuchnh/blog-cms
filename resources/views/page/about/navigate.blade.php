<section class="about__navigate container-fluid background--light-grey">
    <ul class="nav">
        <li class="nav-item @isset($subnavigate) @if ($subnavigate === 'about') active @endif @endisset">
            <a class="nav-link" href="/about">STORY</a>
        </li>
        <li class="nav-item @isset($subnavigate) @if ($subnavigate === 'expert') active @endif @endisset">
            <a class="nav-link" href="/about/expert">EXPERT</a>
        </li>
        <li class="nav-item @isset($subnavigate) @if ($subnavigate === 'press') active @endif @endisset">
            <a class="nav-link" href="{{route('press')}}">IN THE PRESS</a>
        </li>
        <li class="nav-item @isset($subnavigate) @if ($subnavigate === 'contact') active @endif @endisset">
            <a class="nav-link" href="/about/contact">CONTACT US</a>
        </li>
    </ul>
</section>