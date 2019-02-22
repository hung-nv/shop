let ui = {
    pageId: '#create-edit-coupon-code',
    formCoupon: '#frm-coupon-code',
    inputDate: 'input[name="dates"]'
};

$(function () {
    if ($(ui.pageId).length) {
        $(ui.inputDate).daterangepicker({
            minDate: moment(),
            autoUpdateInput: false
        });

        $(ui.inputDate).on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
        });

        $(ui.inputDate).on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
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