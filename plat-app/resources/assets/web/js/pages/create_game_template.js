$(document).ready(function () {
    $('input[id="thumbGame"]').on('change', function () {
        let $file = $(this);
        const reader  = new FileReader();
        reader.onload = function (e) {
            $('#thumb_game_box').css({
                'background-image': 'url('+ e.target.result +')',
                'background-size' : '98%'
            });
        };
        reader.readAsDataURL($file.prop("files")[0]);
    });
});
