import {confirmBeforeDelete, doException} from "../../helpers/helpers";

let toastr = require("toastr/build/toastr.min");

let ui = {
    pageId: '#index-product'
};

if ($(ui.pageId).length) {
    new Vue({
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
            confirmBeforeDelete: function (event) {
                confirmBeforeDelete(event.target, 'Do you want to delete this?');
            }
        }
    });
}
