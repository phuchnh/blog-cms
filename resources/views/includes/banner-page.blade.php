<!-- Banner -->
@isset($banner)
    <section class="about__banner banner__about-page background__cover--center-bottom"
             style="background:url('@if($banner){{$banner}}@else {{'/app/img/olc-banner_home.jpg'}}@endif')">
    </section>
@endisset