import {newInputImage, initInputImage} from "../../utilities/images/image";

let ui = {
    pageId: '#create-update-advertising',
    inputImage: '#image',
    inputOldImage: '#old-image',
    urlDeleteImage: '/api/advertising/delete-image',
    inputRemoveInitPreview: '.kv-file-remove'
};

if ($(ui.pageId).length) {
    new Vue({
        el: ui.pageId,
        data: {
            adType: viewData.type !== null ? viewData.type : null,
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
