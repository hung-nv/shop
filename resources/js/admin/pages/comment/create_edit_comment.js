import {newInputImage, initInputImage} from "../../utilities/images/image";

let ui = {
    pageId: '#create-update-comment',
    inputImage: '#image',
    inputOldImage: '#old-image',
    urlDeleteImage: '/api/comment/delete-image',
    inputRemoveInitPreview: '.kv-file-remove'
};

if ($(ui.pageId).length) {
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
