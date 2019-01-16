import {getParameterByName} from "./admin/helpers/helpers";

var vmHeader = new Vue({
    el: '#header',
    data: {
        textSearch: getParameterByName('search') ? getParameterByName('search') : '',
        idCatalog: -1,
        nameCatalog: ''
    },
    created: function() {
        // set name catalog.
        this.nameCatalog = this.setNameCatalog();
    },
    methods: {
        submitSearchForm: function (event) {
            if (this.textSearch !== '') {
                if (!this.idCatalog) {
                    return false;
                }

                window.location = '?search=' + this.textSearch + '&catalog=' + this.idCatalog;
            }
        },
        onClickSelectCatalog: function (event) {
            this.idCatalog = $(event.target).data('id');

            this.nameCatalog = $(event.target).data('name');
        },
        setNameCatalog: function () {
            let idCatalog = getParameterByName('catalog');

            if (idCatalog) {
                return catalogs[idCatalog];
            } else {
                return 'All Categories';
            }
        }
    }
});