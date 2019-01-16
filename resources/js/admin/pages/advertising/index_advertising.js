import {confirmBeforeDelete} from "../../helpers/helpers";

let ui = {
    pageId: '#index-advertising',
    tableAdvertising: '#datatable-advertising',
};

$(function () {
    if ($(ui.pageId).length) {
        new Vue({
            el: ui.pageId,
            methods: {
                confirmBeforeDelete: function (event) {
                    confirmBeforeDelete(event.target, 'Do you want to delete this?');
                }
            }
        });

        if ($(ui.tableAdvertising).length) {
            $(ui.tableAdvertising).dataTable({
                ordering: false,
                order: [[0, 'desc']],
                bLengthChange: true,
                bFilter: true
            });
        }
    }
});