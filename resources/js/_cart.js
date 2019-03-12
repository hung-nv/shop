import {getParameterByName, _cookie} from "./admin/helpers/helpers";
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
    modalConfirmCrawl: '.modal-confirm-crawl'
};

window.vmCard = new Vue({
    el: '#mainApp',
    data: {
        totalMoney: 0,
        productsInCart: [],
        textSearch: getParameterByName('search') ? getParameterByName('search') : '',
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
        email: ''
    },
    created: function () {
        // set name catalog.
        this.nameCatalog = this.setNameCatalog();

        this.productsInCart = this.getDefaultCart();

        this.totalMoney = this.getTotalMoney(this.productsInCart);
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
                        }).fail(xhr => {

                        });
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
            let storeProduct = this.getLocalStorageCache('cart');

            let newProduct = {
                id: productId,
                quantity: 1,
                name: $(event.target).data('name'),
                price: $(event.target).data('price'),
                thumb: $(event.target).data('thumb'),
                url: $(event.target).data('url')
            };

            if (storeProduct === null) {
                // add to products in cart.
                this.productsInCart.push(newProduct);

                // save to cache data cart.
                this.setLocalStorageCache('cart', this.productsInCart, ui.timeExpire);
            } else {
                // get current products in cart.
                storeProduct = storeProduct.data;

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
                    this.removeLocalStorageCache('cart');

                    $(ui.modalSuccess).modal('show');
                }).fail(xhr => {
                    console.log(xhr);
                }).always(() => {
                    this.isLoading = false;
                });
            }
        },
        saveCustomer: function (event) {
            let valid = $(ui.formCrawl).valid();

            if (!valid) {
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
                    let messages = '';
                    switch (xhr.status) {
                        case 504:
                            messages = 'Connection timeout. Please try again later!';
                            break;
                        case 422:
                            messages = typeof xhr.responseJSON === 'string' ? xhr.responseJSON : xhr.responseJSON.message;
                            break;
                        default:
                            messages = 'Internal Server Error';
                            break;
                    }

                }).always(function () {

                });
            }
        },
        reFormatPrice: function (price) {
            return number_format(price)
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
});