<section class="about__navigate container-fluid background--light-grey">
    <ul class="nav">
        <li class="nav-item @isset($subnavigate) @if ($subnavigate === 'blogs') active @endif @endisset">
            <a class="nav-link" href="/blogs">Blog</a>
        </li>
        <li class="nav-item @isset($subnavigate) @if ($subnavigate === 'guided-meditation') active @endif @endisset">
            <a class="nav-link" href="/resources/index-row">Guided Meditation</a>
        </li>
        <li class="nav-item @isset($subnavigate) @if ($subnavigate === 'daily-practices') active @endif @endisset">
            <a class="nav-link" href="/resources/index-row">Daily practices</a>
        </li>
    </ul>
</section>