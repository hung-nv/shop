/**
 * Alert before delete
 * @param el
 * @param message
 */
export function confirmBeforeDelete(el, message) {
    if (message === undefined || message === null) {
        message = '';
    }
    swal({
        title: 'Are you sure?',
        text: message,
        type: 'warning',
        showCancelButton: true,
        customClass: 'nvh-dialog',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then(function () {
        $(el).parent().submit();
    });
}

/**
 * Convert string to slug.
 * @param string
 * @returns {any}
 */
export function slugify(string) {
    string = string.toLowerCase();

    string = string.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a')
        .replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e')
        .replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i')
        .replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o')
        .replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u')
        .replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y')
        .replace(/đ/gi, 'd');

    string = string.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');

    string = string.replace(/[^\w ]+/g, '')
        .replace(/ +/gi, "-")
        .replace(/\-\-\-\-\-/gi, '-')
        .replace(/\-\-\-\-/gi, '-')
        .replace(/\-\-\-/gi, '-')
        .replace(/\-\-/gi, '-');
    //Xóa các ký tự gạch ngang ở đầu và cuối
    string = '@' + string + '@';
    string = string.replace(/\@\-|\-\@|\@/gi, '');

    return string;
}

/**
 * Convert to number.
 * @param string
 * @returns {*}
 */
export function toNumber(string) {
    if (_.includes(string, ',')) {
        return Number(string.replace(/,/g, ''));
    }

    return string;
}


/**
 * Get param in url
 * @param name
 * @returns {string} | null
 */
export function getParameterByName(name) {
    let match = RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);
    return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
}

/**
 * Work with ajax error.
 * @param xhr
 * @param option
 */
export function doException(xhr, option = {}) {
    if (xhr.status === 402) {
        // Auth error.
        window.location.href = xhr.responseJSON;
    } else if (xhr.responseJSON) {
        let messages = typeof xhr.responseJSON === 'string' ? [xhr.responseJSON] : xhr.responseJSON;

        if (option.elementShowError == undefined) {
            // default element show error.
            option.elementShowError = '.page-title';
        }

        $('.alert-danger').remove();

        $(option.elementShowError).after('<div class="alert alert-danger"></div>');

        for (let i in messages) {
            $('.alert-danger').append(messages[i] + '<br />');
        }
    } else {
        swal({
            type: 'error',
            title: 'Something went wrong...',
            text: "Internal Server Error",
        });
    }
}

export function _cookie(_name, _value, _days) {
    let hour = 24;

    if (_value !== undefined && _name !== undefined) {
        let _expires = '';

        if (_days) {
            let now = new Date();

            now.setTime(now.getTime() + (_days * 60 * 60 * 1000 * hour));

            _expires = "; expires=" + now.toGMTString();
        }

        document.cookie = _name + "=" + _value + _expires + "; path=/";
    } else if (_name !== undefined && !_value) {
        let nameEQ = _name + "=";
        let cookies = document.cookie.split(';');

        for (let i = 0; i < cookies.length; i++) {
            let c = cookies[i];
            while (c.charAt(0) === ' ') {
                c = c.substring(1, c.length);
            }

            if (c.indexOf(nameEQ) === 0)
                return c.substring(nameEQ.length, c.length);
        }

        return null;
    } else if (_name !== undefined && _value === null) {
        _cookie(_name, "", -1);
    }
}