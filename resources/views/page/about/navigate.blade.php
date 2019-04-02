<section class="about__navigate container-fluid background--light-grey">
    <ul class="nav">
        <li class="nav-item @if (!$slug) active @endif">
            <a class="nav-link" href="/about">STORY</a>
        </li>
        <li class="nav-item @if ($slug && $slug === 'expert') active @endif">
            <a class="nav-link" href="/about/expert">EXPERT</a>
        </li>
        <li class="nav-item @if ($slug && $slug === 'press') active @endif">
            <a class="nav-link" href="/about/press">IN THE PRESS</a>
        </li>
        <li class="nav-item @if ($slug && $slug === 'contact') active @endif">
            <a class="nav-link" href="/about/contact">CONTACT US</a>
        </li>
    </ul>
</section>