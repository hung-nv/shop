import {initInputMultiImage, newInputMultiImage} from "../../utilities/images/image";
import {slugify} from "../../helpers/helpers";

let ui = {
    pageId: '#create-update-product',
    inputImage: '#product_image',
    inputOldImage: '#old_product_image',
    urlDeleteImage: '/api/product/delete-image',
    modalAttribute: '#modalAttribute',
    urlAddAttribute: '/api/add-attribute',
    blockUpdateAttribute: '#multi-append-',
    urlUpdateBladeAttribute: '/api/get-attribute/',
    formProduct: '#frm-product'
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
        },
        methods: {
            saveProduct: function () {
                let valid = $(ui.formProduct).valid();

                if (valid) {
                    $(ui.formProduct).submit();
                }
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

        $(ui.formProduct).validate({
            ignore: [],
            errorPlacement: function(error, element) {
                if(element.attr("name") == "parent[]") {
                    $('.mt-checkbox').closest('.form-control').addClass('error');
                }
            },
            success: function(label, element) {
                if($(element).attr("name") == "parent[]") {
                    $('.mt-checkbox').closest('.form-control').removeClass('error');
                }
            },
            invalidHandler: function() {
                setTimeout(function() {
                    $('.nav-tabs a small.text-danger').remove();

                    $('.tab-content .tab-pane:has(.error)').each(function() {
                        let id = $(this).attr('id');

                        $('.nav-tabs').find('a[href^="#' + id + '"]').append(' <small class="text-danger">***</small>');
                    });
                });
            },
            rules: {
                name: 'required',
                sku: 'required',
                price: 'required',
                'parent[]': { required: true, minlength: 1 },
                description: 'required'
            }
        });
    });
}
