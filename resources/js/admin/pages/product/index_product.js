import {confirmBeforeDelete, doException} from "../../helpers/helpers";

let toastr = require("toastr/build/toastr.min");

let ui = {
    pageId: '#index-product',
    urlAddGroup: '/api/product/add-group',
    urlRemoveGroup: '/api/product/remove-group'
};

if ($(ui.pageId).length) {
    let vmIndexProduct = new Vue({
        el: ui.pageId,
        methods: {
            changeCoverImage: function (event) {
                let wrapImages = $(event.target).parents('.td-product-img').find('.product-image-thumb');
                if (wrapImages.is(":visible")) {
                    wrapImages.hide();
                } else {
                    wrapImages.show();
                }
            },
            updateCoverImage: function (event) {
                let self = $(event.target);

                let coverImg = self.data('img'),
                    productId = self.data('id'),
                    srcImg = self.attr('src');

                if (coverImg === undefined || srcImg === undefined) {
                    return;
                }

                $.ajax({
                    type: "post",
                    url: '/api/set-cover-product',
                    data: {
                        image: coverImg,
                        product_id: productId
                    }
                }).done(respon => {
                    toastr.info(respon.message);

                    let currentImg = self.parents('.td-product-img').find('.backend-img').children();
                    let wrapImages = self.parents('.td-product-img').find('.product-image-thumb');
                    wrapImages.hide();
                    currentImg.attr('src', srcImg);
                }).fail(xhr => {
                    doException(xhr);
                });
            },
            addGroup: function (element) {
                let groupId, groupName, productId;

                groupId = $(element).data('group-id');
                groupName = $(element).data('group-name');
                productId = $(element).data('post-id');

                if (groupId === undefined || groupName === undefined || productId === undefined) {
                    return;
                }

                $.ajax({
                    type: "post",
                    dataType: 'json',
                    url: ui.urlAddGroup,
                    data: {
                        product_id: productId,
                        group_id: groupId,
                        group_name: groupName
                    }
                }).done(respon => {
                    toastr.info(respon.message);

                    this.createContainerChecked($(element));
                }).fail(xhr => {
                    doException(xhr);
                });
            },
            removeGroup: function (element) {
                let groupId, groupName, productId;

                groupId = $(element).data('group-id');
                groupName = $(element).data('group-name');
                productId = $(element).data('post-id');

                if (groupId === undefined || groupName === undefined || productId === undefined) {
                    return;
                }

                $.ajax({
                    type: "post",
                    dataType: 'json',
                    url: ui.urlRemoveGroup,
                    data: {
                        product_id: productId,
                        group_id: groupId,
                        group_name: groupName
                    }
                }).done(respon => {
                    toastr.warning(respon.message);

                    this.createContainerSet($(element));
                }).fail(xhr => {
                    doException(xhr);
                });
            },
            createContainerChecked: function (container) {
                let iconCheck, buttonCheck, buttonRemove, iconRemove, wrapContainer;

                iconCheck = $('<i>').addClass('fa fa-check');
                buttonCheck = $('<a>').addClass('btn btn-xs blue');
                buttonRemove = $('<a>').addClass('btn btn-xs red')
                    .attr('data-group-id', container.data('group-id'))
                    .attr('data-group-name', container.data('group-name'))
                    .attr('data-post-id', container.data('post-id'))
                    .attr('id', 'btnRemoveGroup');
                iconRemove = $('<i>').addClass('fa fa-times');
                buttonCheck.append(iconCheck).append(' ' + container.data('group-name'));
                buttonRemove.append(iconRemove);

                wrapContainer = container.parent();
                wrapContainer.html('');
                wrapContainer.append(buttonCheck)
                    .append(buttonRemove);
            },
            createContainerSet: function (container) {
                let wrapContainer, buttonSetGroup;

                wrapContainer = container.parent();

                buttonSetGroup = $('<button>').addClass('btn btn-xs grey-cascade')
                    .attr('data-group-id', container.data('group-id'))
                    .attr('data-group-name', container.data('group-name'))
                    .attr('data-post-id', container.data('post-id'))
                    .attr('id', 'btnAddGroup')
                    .text('Set to "' + container.data('group-name') + '"');
                wrapContainer.html('');
                wrapContainer.append(buttonSetGroup)
            },
            confirmBeforeDelete: function (event) {
                confirmBeforeDelete(event.target, 'Do you want to delete this?');
            }
        }
    });

    $(ui.pageId).on('click', '#btnAddGroup', function () {
        vmIndexProduct.addGroup(this);
    });

    $(ui.pageId).on('click', '#btnRemoveGroup', function () {
        vmIndexProduct.removeGroup(this);
    });
}
