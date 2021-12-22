window.$ = window.jQuery = require('jquery');
$.ajaxSetup({
    headers : {
        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
    }
});

import {Tooltip, Toast, Popover} from "bootstrap";

require('select2');

require('jquery-datetimepicker');
require('../../_common/js/blockUI');
require('../../_common/js/lodash-install');
require('../../_common/js/translator');
require('../../_common/js/form-validation');
