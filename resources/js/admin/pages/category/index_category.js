import {confirmBeforeDelete} from "../../helpers/helpers";

const ui = {
    pageId: '#category',
    tableCategory: '#datatable-category',
    btnDelete: '#btn-delete'
};

$(function () {
    if ($(ui.tableCategory).length) {
        $(ui.tableCategory).dataTable({
            ordering: false,
            order: [[0, 'desc']],
            bLengthChange: true,
            bFilter: true
        });
    }

    $(ui.tableCategory).on('click', ui.btnDelete, function () {
        confirmBeforeDelete(this, 'Do you want to delete this?');
    });
});