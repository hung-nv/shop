import {initInputMultiImage, newInputMultiImage} from "../../utilities/images/image";
import {slugify} from "../../helpers/helpers";

const ui = {
    pageId: '#create-update-product',
    inputImage: '#product_image',
    inputOldImage: '#old_product_image',
    urlDeleteImage: '/api/product/delete-image',
    modalAttribute: '#modalAttribute',
    urlAddAttribute: '/api/add-attribute',
    blockUpdateAttribute: '#multi-append-',
    urlUpdateBladeAttribute: '/api/get-attribute/',
};

if ($(ui.pageId).length) {
    new Vue({
        el: ui.pageId,
        data: {
            productName: viewData.oldName,
            productSlug: viewData.oldSlug
        },
        watch: {
            productName: function (newValue, oldValue) {
                this.productSlug = slugify(newValue);
            }
        }
    });

    $(function () {
        if ($(ui.inputOldImage).length) {
            // update product.
            initInputMultiImage(ui.inputOldImage, ui.inputImage, ui.urlDeleteImage);
        } else {
            if ($(ui.inputImage).length) {
                // create product.
                newInputMultiImage(ui.inputImage);
            }
        }
    });
}
