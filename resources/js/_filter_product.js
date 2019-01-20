import {getParameterByName, toNumber} from "./admin/helpers/helpers";
import {number_format} from "./admin/utilities/format";

let ui = {
    elementId: '#list-products',
    inputRange: '.price-slider'
};

if ($(ui.elementId).length) {
    let vmFilter = new Vue({
        el: ui.elementId,
        data: function () {
            return {
                pageSize: this.getDefaultPageSize(),
                sortType: this.getDefaultSortType(),
                labelSortType: null,
                minPrice: this.getMinRangePrice(),
                maxPrice: this.getMaxRangePrice()
            };
        },
        watch: {
            sortType: function (newValue, oldValue) {
                this.labelSortType = this.setLabelSortType(newValue);

                // check if change value.
                if (newValue !== oldValue) {
                    this.initSearch();
                }
            },
            pageSize: function (newValue, oldValue) {
                // check if change value.
                if (newValue !== oldValue) {
                    this.initSearch();
                }
            }
        },
        created: function () {
            this.labelSortType = this.setLabelSortType(this.sortType);
        },
        methods: {
            initSearch: function (isSearchPrice = false) {
                let params = {};
                let page = 1;

                if (getParameterByName('page')) {
                    page = getParameterByName('page');
                }

                // set param page.
                params['page'] = page;
                params['sort'] = this.sortType;
                params['pageSize'] = this.pageSize;

                if (getParameterByName('min')) {
                    params['min'] = getParameterByName('min');
                }

                if (getParameterByName('max')) {
                    params['max'] = getParameterByName('max');
                }

                if (isSearchPrice) {
                    let rangePrice = $(ui.inputRange).slider('getValue');
                    params['min'] = rangePrice[0];
                    params['max'] = rangePrice[1];
                }

                let currentURL = location.protocol + '//' + location.host + location.pathname;

                window.location = currentURL + '?' + $.param(params);
            },
            getMinRangePrice: function() {
                let minPrice = 200000;

                if (getParameterByName('min')) {
                    minPrice = getParameterByName('min');
                }

                return number_format(minPrice);
            },
            getMaxRangePrice: function() {
                let maxPrice = 500000;

                if (getParameterByName('max')) {
                    maxPrice = getParameterByName('max');
                }

                return number_format(maxPrice);
            },
            getDefaultSortType: function () {
                let sortType = 1;
                let defaultType = getParameterByName('sort');

                if (defaultType) {
                    sortType = defaultType;
                }

                return sortType;
            },
            getDefaultPageSize: function () {
                let pageSize = 12;
                let defaultPageSize = getParameterByName('pageSize');

                if (defaultPageSize && !isNaN(pageSize)) {
                    pageSize = defaultPageSize;
                }

                return pageSize;
            },
            setPageSize: function (numeric, event) {
                this.pageSize = numeric;
            },
            setLabelSortType: function (sortType) {
                let label = '';

                switch (sortType) {
                    case '1':
                        label = 'Mới nhất';
                        break;
                    case '2':
                        label = 'Giá: thấp - cao';
                        break;
                    case '3':
                        label = 'Giá: cao - thấp';
                        break;
                    case '4':
                        label = 'Tên sản phẩm: A - Z';
                        break;
                    default:
                        label = 'Mới nhất';
                }

                return label;
            },
            setSortType: function (type) {
                this.sortType = type;
            },
            onClickSearchWithPrice: function (event) {
                this.initSearch(true);
            }
        }
    });

    $(function () {
        // Price Slider
        if ($(ui.inputRange).length > 0) {
            $(ui.inputRange).slider({
                range: false,
                min: 100000,
                max: 600000,
                step: 50000,
                value: [toNumber(vmFilter.minPrice), toNumber(vmFilter.maxPrice)],
                handle: "square",
            }).on('slide', function (event) {
                $('.price-range-holder .min-max .pull-left').text(number_format(event.value[0]));
                $('.price-range-holder .min-max .pull-right').text(number_format(event.value[1]));
            });
        }
    });
}