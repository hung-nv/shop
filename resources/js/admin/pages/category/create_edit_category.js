import {slugify} from "../../helpers/helpers";
import {newInputImage} from "../../utilities/images/image";

const ui = {
    pageId: '#create-edit-category',
    inputImage: '#image',
    inputOldImage: '#old-image',
    urlDeleteImage: '/api/category/delete-image',
    inputRemoveInitPreview: '.kv-file-remove'
};

if ($(ui.pageId).length) {
    new Vue({
        el: ui.pageId,
        data: {
            categoryName: viewData.oldName,
            categorySlug: viewData.oldSlug
        },
        watch: {
            categoryName: function (newValue, oldValue) {
                this.categorySlug = slugify(newValue);
            }
        }
    });

    $(function () {
        setInputImage();

        /**
         * Set input image preview.
         */
        function setInputImage() {
            if ($(ui.inputImage).length) {
                if ($(ui.inputOldImage).length) {
                    initInputImage(
                        ui.inputOldImage,
                        ui.inputImage,
                        ui.urlDeleteImage
                    );
                } else {
                    newInputImage(ui.inputImage);
                }
            }

            $(ui.inputImage).on('fileclear', function (event) {
                $(ui.inputRemoveInitPreview).trigger("click");
            });
        }
    });
}
