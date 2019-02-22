import {confirmBeforeDelete} from "../../helpers/helpers";

let ui = {
    pageId: '#coupon-code',
    tableCoupon: '#datatable-coupon-code',
    btnDelete: '#btn-delete'
};

if ($(ui.pageId).length) {
    new Vue({
        el: ui.pageId,
        methods: {
            confirmBeforeDelete: function (event) {
                confirmBeforeDelete(event.target, 'Do you want to delete this?');
            }
        }
    });
}

$(function () {
    if ($(ui.tableCoupon).length) {
        $(ui.tableCoupon).dataTable({
            ordering: false,
            order: [[0, 'desc']],
            bLengthChange: true,
            bFilter: true
        });
    }
});