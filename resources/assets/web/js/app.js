$(document).ready(function () {
    GLOBAL_CONFIG.init();
});

GLOBAL_CONFIG = (() => {
    /**
     * jQuery datetime picker
     */
    let datePickerSettings = ($e, changeConfigs) => {
        let $this   = $e;
        let configs = $.extend({todayButton : false, dayOfWeekStart : 1}, changeConfigs);
        // Setting from html by attribute data. Example: data-minDate="2021/11/20"
        $(['minDate', 'maxDate', 'startDate', 'yearEnd']).each((key, eSetting) => {
            let sValue = $this.data(eSetting.toLowerCase());
            if (sValue === undefined) {
                return;
            }
            configs[eSetting] = sValue;
        });

        $this.datetimepicker(configs);
    };

    return {
        toggleBuilder : () => {
            $('[data-init-plugin="select2"]').each(function () {
                let config = {
                    minimumResultsForSearch: ($(this).attr('data-disable-search') == 'true' ? -1 : 1),
                    disabled: !!($(this).attr('readonly')),
                };

                $(this).select2(config);
            });

            /**
             * jQuery datetime picker
             */
            $('[data-toggle="date"]').each(function () {
                datePickerSettings($(this), {timepicker : false, format : 'Y/m/d'});
            });
        },
        init: function () {
            this.toggleBuilder();
            $('form.has_validate').formValidation();
        }
    };
})();
