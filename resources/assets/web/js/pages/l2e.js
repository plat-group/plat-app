require('jquery.repeater');
import {Modal} from "bootstrap";

$(document).ready(function ($) {

    initRepeater();

    resetRadio();

    videoHandle();
});

function initRepeater() {
    $('.repeater').repeater({
        initEmpty : false,
        show : function () {
            $(this).slideDown();
        },
        hide: function (deleteElement) {
            if (confirm(trans('message.confirm_delete'))) {
                $(this).slideUp(deleteElement);
            }
        },
        isFirstItemUndeletable : true,
        repeaters: [{
            // Specify the jQuery selector for this nested repeater
            selector: '.inner-repeater',
        }],
        ready: function (setIndexes) {
        }
    });
}

/**
 *
 */
function resetRadio()
{
    $(document).on('change', '.js-check-correct', function () {
        if ($(this).prop('checked')) {
            let $this = $(this);
            $(this).closest(".inner-repeater").find('input[type="checkbox"]').prop("checked", false);
            $this.prop('checked', true);
        }
    });
}

/**
 *
 */
function videoHandle()
{
    const video = document.getElementById('learnVideo');
    if (!video) {
        return;
    }

    const myModalEl = new Modal(document.getElementById('exercise'), {
        keyboard: false
    })
    video.addEventListener('timeupdate', (event) => {
        if (video.currentTime >= 2) {
            video.pause();
            myModalEl.show();
        }
    });
}
