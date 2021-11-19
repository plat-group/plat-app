var WEB = (function () {
    var validateForm = function () {
        $('form.has_validate').formValidation();
    }

    var dateTimePicker = function () {
        if ($('#datetimepicker').length === 0) return;
        $('#datetimepicker').datetimepicker({
            i18n: {
                de: {
                    months: [
                        'Januar', 'Februar', 'März', 'April',
                        'Mai', 'Juni', 'Juli', 'August',
                        'September', 'Oktober', 'November', 'Dezember',
                    ],
                    dayOfWeek: [
                        "So.", "Mo", "Di", "Mi",
                        "Do", "Fr", "Sa.",
                    ]
                }
            },
            timepicker: false,
            format: 'd/m/Y',
            maxDate: '31/12/2010',

        });
    }

    var gameOrderSlide = function () {
        if($('.game-order-slide').length === 0) return;
        var swiper = new Swiper(".game-order-slide", {
            loop: true,
            watchSlidesProgress: true,
            autoplay: {
                delay: 3000,
            },
            navigation: {
                nextEl: ".button-control-slide .swiper-next",
                prevEl: ".button-control-slide .swiper-prev",
            },
        });
    }
    return {
        _: function () {
            validateForm();
            dateTimePicker();
            gameOrderSlide();
        }
    };
})();
jQuery(document).ready(function ($) {
    WEB._();
});
