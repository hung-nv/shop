let ui = {
    pageId: '#create-edit-coupon-code',
    formCoupon: '#frm-coupon-code',
    inputDate: 'input[name="dates"]'
};

$(function () {
    if ($(ui.pageId).length) {
        $(ui.inputDate).daterangepicker({
            minDate: moment()
        });

        $(ui.formCoupon).validate({
            rules: {
                'value': {
                    required: true,
                    number: true,
                    min: 0,
                    max: 100
                },
                'dates': {
                    required: true
                }
            }
        });
    }
});