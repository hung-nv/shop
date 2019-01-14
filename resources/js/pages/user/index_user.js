import {confirmBeforeDelete} from "../../helpers/helpers";

let ui = {
    pageId: '#user'
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