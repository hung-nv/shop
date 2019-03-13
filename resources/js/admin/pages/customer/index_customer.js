import {confirmBeforeDelete} from "../../helpers/helpers";

let ui = {
    pageId: '#customer',
    tableCoupon: '#datatable-customer',
    btnDelete: '#btn-delete',
    modalSendMail: '#modal-send-mail',
    formSendMail: '#frmSendMail',
    urlSendMail: 'api/send-promotion'
};

$(function () {
    if ($(ui.pageId).length) {
        window.vmCustomer = new Vue({
            el: ui.pageId,
            data: {
                idsCustomer: [],
                mailSubject: '',
                mailContent: ''
            },
            methods: {
                selectAllCustomer: function (event) {
                    this.idsCustomer = [];

                    if ($(event.target).prop('checked')) {
                        this.idsCustomer = viewData.ids_customer;
                    }
                },
                openPopupMail: function() {
                    if (this.idsCustomer.length) {
                        $(ui.modalSendMail).modal('show');
                    }
                },
                sendMail: function() {
                    let valid = $(ui.formSendMail).valid();

                    if (valid) {
                        $.ajax({
                            method: 'post',
                            url: '',
                            data: {
                                ids_customer: this.idsCustomer,
                                mail_subject: this.mailSubject,
                                mail_content: this.mailContent
                            }
                        }).done(response => {

                        }).fail(xhr => {

                        }).always(() => {

                        });
                    }
                },
                confirmBeforeDelete: function (event) {
                    confirmBeforeDelete(event.target, 'Do you want to delete this?');
                }
            }
        });

        $(ui.formSendMail).validate({
            rules: {
                mail_subject: 'required',
                mail_content: 'required'
            }
        });

        $(ui.tableCoupon).dataTable({
            ordering: false,
            order: [[0, 'desc']],
            bLengthChange: true,
            bFilter: true
        });
    }
});