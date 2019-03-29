$(document).ready(function () {
    /* in the press */
    $('.test__content__slider, .test__content-03__slider').slick({
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        slidesToScroll: 1
    })

    $('.inthepress-carousel').slick({
        infinite: true,
        speed: 300,
        slidesToShow: 2,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });

    $('#client-logo').slick({
        infinite: true,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 3
                }
            }
        ]
        // autoplay: true,
        // autoplaySpeed: 2000,
    });

    $('.faq .faq-content .faq-content__item__quest').click(function () {
        $(this).parent('.faq-content__item').find('.faq-content__item__answer').slideToggle(300);
        $(this).parent('.faq-content__item').find('i').toggleClass('fa-minus fa-plus')
    })
});