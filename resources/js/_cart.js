import {getParameterByName, _cookie, toNumber} from "./admin/helpers/helpers";
import {number_format} from "./admin/utilities/format";

window._ = require('lodash');

let ui = {
    urlGetProducts: '/api/get-products',
    timeExpire: 1000 * 60 * 5,
    urlCheckCouponCode: '/api/check-coupon-code',
    urlSaveOrder: '/api/save-order',
    formOrder: '#frm-customer',
    modalSuccess: '.modal-confirm',
    modalCrawl: '.modal-crawl-information',
    formCrawl: '#frm-crawl-information',
    urlCrawlInformation: '/api/crawl-information',
    modalConfirmCrawl: '.modal-confirm-crawl',
    inputRange: '.price-slider'
};

window.vmCard = new Vue({
    el: '#mainApp',
    data: function () {
        return {
            totalMoney: 0,
            productsInCart: [],
            textSearch: getParameterByName('name') ? getParameterByName('name') : '',
            idCatalog: -1,
            nameCatalog: '',
            couponCode: '',
            couponCodeSale: 0,
            isCoupon: true,
            isLoading: false,
            name: '',
            telephone: '',
            address: '',
            note: '',
            email: '',
            errorMessage: '',
            showError: true,
            pageSize: this.getDefaultPageSize(),
            sortType: this.getDefaultSortType(),
            labelSortType: null,
            minPrice: this.getMinRangePrice(),
            maxPrice: this.getMaxRangePrice()
        };
    },
    created: function () {
        // set name catalog.
        this.nameCatalog = this.setNameCatalog();

        this.productsInCart = this.getDefaultCart();

        this.totalMoney = this.getTotalMoney(this.productsInCart);

        this.labelSortType = this.setLabelSortType(this.sortType);
    },
    watch: {
        productsInCart: function (newValue) {
            this.totalMoney = this.getTotalMoney();
        },
        couponCode: function (newValue) {
            if (!this.isCoupon) {
                this.isCoupon = true;
            }

            if (this.couponCodeSale) {
                this.couponCodeSale = 0;
            }
        },
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
    methods: {
        removeLocalStorageCache: function (key) {
            localStorage.removeItem(key);
        },
        setLocalStorageCache: function (key, value, time) {
            localStorage.removeItem(key);

            localStorage.setItem(key, JSON.stringify({
                data: value,
                expire: Date.now() + time
            }));
        },
        getLocalStorageCache: function (key) {
            let cacheInformation = localStorage.getItem(key);

            if (cacheInformation) {
                cacheInformation = JSON.parse(cacheInformation);

                if (cacheInformation.expire - Date.now() > 0) {
                    return cacheInformation;
                } else {
                    if (cacheInformation.data.length) {
                        $.ajax({
                            method: 'get',
                            dataType: 'json',
                            url: ui.urlGetProducts,
                            data: {
                                idsProduct: _.map(cacheInformation.data, 'id')
                            }
                        }).done(response => {
                            this.setLocalStorageCache(key, response, ui.timeExpire);

                            this.productsInCart = response;

                            //TODO: return data after refresh.
                        }).fail(xhr => {

                        });
                    } else {
                        return null;
                    }
                }
            } else {
                return null;
            }
        },
        getDefaultCart: function () {
            let storeProduct = this.getLocalStorageCache('cart');

            if (storeProduct) {
                return storeProduct.data;
            }

            return [];
        },
        getTotalMoney: function (products) {
            let prices = _.map(products, function (item) {
                return Number(item.quantity) * item.price;
            });

            if (prices.length) {
                return _.sum(prices);
            }

            return 0;
        },
        getBalanceSale: function (products) {
            let totalMoney = 0;

            let prices = _.map(products, function (item) {
                return Number(item.quantity) * item.price;
            });

            if (prices.length) {
                totalMoney = _.sum(prices);

                return this.couponCodeSale * totalMoney / 100;
            }

            return 0;
        },
        addToCard: function (productId, event) {
            let localStoreProduct = this.getLocalStorageCache('cart');

            let newProduct = {
                id: productId,
                quantity: 1,
                name: $(event.target).data('name'),
                price: $(event.target).data('price'),
                thumb: $(event.target).data('thumb'),
                url: $(event.target).data('url')
            };

            if (localStoreProduct === null) {
                // add to products in cart.
                this.productsInCart.push(newProduct);

                // save to cache data cart.
                this.setLocalStorageCache('cart', this.productsInCart, ui.timeExpire);
            } else {
                // get current products in cart.
                let storeProduct = localStoreProduct.data;

                // get id products in cart.
                let idsProduct = _.map(storeProduct, 'id');

                // check exist product in cart.
                if (!_.includes(idsProduct, productId)) {
                    // add to cart.
                    this.productsInCart.push(newProduct);

                    // save to cache data cart.
                    this.setLocalStorageCache('cart', this.productsInCart, ui.timeExpire);
                }
            }
        },
        removeFromCart: function (index, event) {
            this.productsInCart.splice(index, 1);

            // save to cache data cart.
            this.setLocalStorageCache('cart', this.productsInCart, ui.timeExpire);
        },
        submitSearchForm: function (event) {
            if (this.textSearch !== '') {
                if (!this.idCatalog) {
                    return false;
                }

                window.location = location.protocol + '//' + location.host + '/search?name=' + this.textSearch + '&catalog=' + this.idCatalog;
            }
        },
        onClickSelectCatalog: function (event) {
            this.idCatalog = $(event.target).data('id');

            this.nameCatalog = $(event.target).data('name');
        },
        setNameCatalog: function () {
            let idCatalog = getParameterByName('catalog');

            if (idCatalog && idCatalog !== '-1') {
                return catalogs[idCatalog];
            } else {
                return 'All Categories';
            }
        },
        checkCouponCode: function (event) {
            if (this.couponCode !== '') {
                $.ajax({
                    method: 'get',
                    url: ui.urlCheckCouponCode,
                    data: {
                        couponCode: this.couponCode
                    }
                })
                    .done(response => {
                        this.couponCodeSale = response.value;
                    })
                    .fail(xhr => {
                        this.isCoupon = false;
                    });
            }
        },
        saveOrder: function (event) {
            let valid = $(ui.formOrder).valid();

            if (valid) {
                this.isLoading = true;

                $.ajax({
                    method: 'post',
                    url: ui.urlSaveOrder,
                    data: {
                        name: this.name,
                        telephone: this.telephone,
                        address: this.address,
                        note: this.note,
                        products: this.productsInCart,
                        couponCode: this.couponCode,
                        couponCodeSale: this.couponCodeSale
                    }
                }).done(response => {
                    if (response) {
                        this.removeLocalStorageCache('cart');

                        $(ui.modalSuccess).modal('show');
                    } else {
                        alert('Something errors');
                    }
                }).fail(xhr => {
                    console.log(xhr);
                }).always(() => {
                    this.isLoading = false;
                });
            }
        },
        saveCustomer: function (event) {
            let valid = $(ui.formCrawl).valid();

            if (valid) {
                $.ajax({
                    method: 'post',
                    url: ui.urlCrawlInformation,
                    data: {
                        name: this.name,
                        mobile: this.telephone,
                        email: this.email
                    }
                }).done(respon => {
                    $(ui.modalCrawl).modal('toggle');

                    $(ui.modalConfirmCrawl).modal('show');
                }).fail(xhr => {
                    switch (xhr.status) {
                        case 504:
                            this.errorMessage = 'Connection timeout. Please try again later!';
                            break;
                        case 422:
                            let errors = [];

                            if (typeof xhr.responseJSON === 'string') {
                                errors.push(xhr.responseJSON);
                            } else {
                                _.forEach(xhr.responseJSON.errors, error => {
                                    errors.push(error.join(', '));
                                });
                            }

                            this.errorMessage = errors.join(', ');

                            break;
                        default:
                            this.errorMessage = 'Internal Server Error';
                            break;
                    }

                    setTimeout(() => {
                        this.errorMessage = '';
                    }, 5000)
                }).always(function () {

                });
            }
        },
        reFormatPrice: function (price) {
            return number_format(price)
        },
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

            if (getParameterByName('name')) {
                params['name'] = getParameterByName('name');
            }

            if (getParameterByName('catalog')) {
                params['catalog'] = getParameterByName('catalog');
            }

            if (isSearchPrice) {
                let rangePrice = $(ui.inputRange).slider('getValue');
                params['min'] = rangePrice[0];
                params['max'] = rangePrice[1];
            }

            let currentURL = location.protocol + '//' + location.host + location.pathname;

            window.location = currentURL + '?' + $.param(params);
        },
        getMinRangePrice: function () {
            let minPrice = 200000;

            if (getParameterByName('min')) {
                minPrice = getParameterByName('min');
            }

            return number_format(minPrice);
        },
        getMaxRangePrice: function () {
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
    $(ui.modalSuccess).on('hidden.bs.modal', function () {
        window.location = '/';
    });

    $(ui.formOrder).validate({
        rules: {
            telephone: {
                'validatePhone': true,
                required: true
            },
            name: 'required',
            address: 'required'
        },
        messages: {
            name: "Vui lòng nhập họ tên",
            address: "Vui lòng nhập địa chỉ",
            telephone: {
                required: "Vui lòng nhập số điện thoại"
            }
        }
    });

    $(ui.formCrawl).validate({
        rules: {
            mobile: {
                'validatePhone': true,
                required: true
            },
            name: 'required',
            email: 'required'
        },
        messages: {
            name: "Vui lòng nhập họ tên",
            email: "Vui lòng nhập email",
            mobile: {
                required: "Vui lòng nhập số điện thoại"
            }
        }
    });


    setTimeout(function () {
        if (!_cookie('dialog')) {

            _cookie('dialog', 'dialog1', 1);

            $(ui.modalCrawl).modal('show');
        }

    }, 3000); // milliseconds


    $.validator.addMethod('validatePhone', function (value) {
        return /^0([0-9]{9})$/.test(value);
    }, 'Vui lòng nhập chính xác số điện thoại.');

    // Price Slider
    if ($(ui.inputRange).length) {
        $(ui.inputRange).slider({
            range: false,
            min: 100000,
            max: 600000,
            step: 50000,
            value: [toNumber(vmCard.minPrice), toNumber(vmCard.maxPrice)],
            handle: "square",
        }).on('slide', function (event) {
            $('.price-range-holder .min-max .pull-left').text(number_format(event.value[0]));
            $('.price-range-holder .min-max .pull-right').text(number_format(event.value[1]));
        });
    }
});