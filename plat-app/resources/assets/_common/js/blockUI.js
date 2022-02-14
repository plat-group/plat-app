require('block-ui');
LOADING = function () {
    let params = {
        message: '<i class="fa fas fa-spinner fa-spin"></i>',
        css: { border: 0, backgroundColor: 'transparent', color: '#fff', fontSize: '30px' },
        overlayCSS:  {
            backgroundColor: '#000',
            opacity:         0.3
        },
    };
    return {
        block:  (target) => {  $(target).block(params); },
        page: () => { $.blockUI(params); },
        unblock: (target) => {
            if (target && target !== 'body') {
                $(target).unblock();
            } else {
                $.unblockUI();
            }
        }
    }
}();
