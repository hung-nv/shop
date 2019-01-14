import {slugify} from "../../helpers/helpers";
import {newInputImage, initInputImage} from "../../utilities/images/image";

const ui = {
    pageId: '#create-edit-post',
    inputImage: '#image',
    inputOldImage: '#old-image',
    urlDeleteImage: '/api/post/delete-image',
    inputRemoveInitPreview: '.kv-file-remove'
};

if ($(ui.pageId).length) {
    new Vue({
        el: ui.pageId,
        data: {
            postName: viewData.oldName,
            postSlug: viewData.oldSlug
        },
        watch: {
            postName: function (newValue, oldValue) {
                this.postSlug = slugify(newValue);
            }
        },
        methods: {

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
