let ui = {
    pageId: '#create-edit-coupon-code'
};

if ($(ui.pageId).length) {
    $(function () {
        $('input[name="dates"]').daterangepicker({
            minDate: moment()
        });

        $('#frm-coupon-code').validate({
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
    });
}
