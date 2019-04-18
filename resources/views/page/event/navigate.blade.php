<section class="sub-navigate container-fluid background--light-grey">
    <ul class="nav">
        <li class="nav-item @isset($subnavigate) @if ($subnavigate === 'program') active @endif @endisset">
            <a class="nav-link" href="{{route('program')}}">PROGRAMS</a>
        </li>
        <li class="nav-item @isset($subnavigate) @if ($subnavigate === 'event') active @endif @endisset">
            <a class="nav-link" href="{{route('event')}}">EVENTS</a>
        </li>
    </ul>
</section>