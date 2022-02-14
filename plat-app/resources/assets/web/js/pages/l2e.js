require('jquery.repeater');

$(document).ready(function ($) {

    initRepeater();

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
