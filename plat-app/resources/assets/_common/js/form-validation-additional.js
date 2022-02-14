/**
 * Validate only letters, numbers and underline
 */
jQuery.validator.addMethod("lettersCode", function (value, element) {
    return this.optional(element) || /^[a-z0-9\\_]+$/i.test(value);
}, trans('message.validate.lettersCode'));


jQuery.validator.addMethod("gt", function (value, element, field) {
    let eNumStart = $('input[id="' + field + '"]'),
        eNumEnd   = $(element),
        startVal  = eNumStart.val(),
        endVal    = eNumEnd.val();

    // Not required
    if (!startVal.length && !endVal.length) {
        return true;
    }

    // Check the value contains a valid only digits.
    let reNumber = /^\d+$/;
    if ((startVal.length && !reNumber.test(startVal)) || (endVal.length && !reNumber.test(endVal)) ) {
        return false;
    }

    // Check the case of inputting both start and end then the end should be greater than start
    return !(startVal.length !== 0 && endVal.length !== 0 && Number(startVal) > Number(endVal));

    // TODO: validate with date string
    /* if (!/Invalid|NaN/.test(new Date(value))) {
          return new Date(value) > new Date($(field).val());
      }*/
}, trans('message.validate.gt'));
