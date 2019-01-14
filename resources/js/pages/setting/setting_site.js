import {initInputImage, newInputImage} from "../../utilities/images/image";

const ui = {
    inputFavico: '#favico',
    inputOldFavico: '#old_favico',
    inputLogo: '#company_logo',
    inputOldLogo: '#old_company_logo',
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

    $(ui.inputFavico).on('fileclear', function (event) {
        $(ui.inputRemoveInitPreview).trigger("click");
    });
});