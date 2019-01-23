window._ = require('lodash');

export default function setLocalStorageCache(key, value, time) {
    localStorage.setItem(key, JSON.stringify({
        data: value,
        expire: Date.now() + time
    }));
}

export default function getLocalStorageCache(key) {
    let cacheInformation = localStorage.getItem(key);

    if (cacheInformation) {
        cacheInformation = JSON.parse(cacheInformation);

        if (Date.now() - cacheInformation.expire > 0) {
            return cacheInformation;
        } else {
            $.ajax({
                method: 'post',
                dataType: 'json',
                data: {
                    idsProduct: _.pluck(cacheInformation.data, 'id')
                }
            }).done(response => {
                return localStorage.setItem(key, JSON.stringify({
                    data: response,
                    expire: Date.now() + (1000 * 60 * 5)
                }));
            }).fail(xhr => {

            });
        }
    } else {
        return null;
    }
}