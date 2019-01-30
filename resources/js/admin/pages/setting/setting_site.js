import {initInputImage, newInputImage} from "../../utilities/images/image";

const ui = {
    inputFavico: '#favico',
    inputOldFavico: '#old_favico',
    inputLogo: '#company_logo',
    inputOldLogo: '#old_company_logo',
    inputBannerImage1: '#banner_image_1',
    inputOldBannerImage1: '#old_banner_image_1',
    inputBannerImage2: '#banner_image_2',
    inputOldBannerImage2: '#old_banner_image_2',
    urlDeleteFileSetting: '/api/delete-file-setting',
    inputRemoveInitPreview: '.kv-file-remove'
};

$(function () {
    // init favico.
    if ($(ui.inputFavico).length) {
        if ($(ui.inputOldFavico).length) {
            initInputImage(
                ui.inputOldFavico,
                ui.inputFavico,
                ui.urlDeleteFileSetting,
                {extractName: 'favico'}
            );
        } else {
            newInputImage(ui.inputFavico);
        }
    }

    // init logo.
    if ($(ui.inputLogo).length) {
        if ($(ui.inputOldLogo).length) {
            initInputImage(
                ui.inputOldLogo,
                ui.inputLogo,
                ui.urlDeleteFileSetting,
                {extractName: 'company_logo'}
            );
        } else {
            newInputImage(ui.inputLogo);
        }
    }

    // init banner image 1.
    if ($(ui.inputBannerImage1).length) {
        if ($(ui.inputOldBannerImage1).length) {
            initInputImage(
                ui.inputOldBannerImage1,
                ui.inputBannerImage1,
                ui.urlDeleteFileSetting,
                {extractName: 'banner_image_1'}
            );
        } else {
            newInputImage(ui.inputBannerImage1);
        }
    }

    // init banner image 2.
    if ($(ui.inputBannerImage2).length) {
        if ($(ui.inputOldBannerImage2).length) {
            initInputImage(
                ui.inputOldBannerImage2,
                ui.inputBannerImage2,
                ui.urlDeleteFileSetting,
                {extractName: 'banner_image_2'}
            );
        } else {
            newInputImage(ui.inputBannerImage2);
        }
    }

    $(ui.inputFavico).on('fileclear', function (event) {
        $(ui.inputRemoveInitPreview).trigger("click");
    });
});