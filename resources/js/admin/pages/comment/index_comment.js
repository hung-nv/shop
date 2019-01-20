import {confirmBeforeDelete} from "../../helpers/helpers";

let ui = {
    pageId: '#index-comment',
    tablePages: '#datatable-comment'
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

    $(function () {
        if ($(ui.tablePages).length) {
            $(ui.tablePages).dataTable({
                ordering: false,
                order: [[0, 'desc']],
                bLengthChange: true,
                bFilter: true
            });
        }
    });
}