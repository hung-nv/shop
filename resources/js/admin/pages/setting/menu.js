import {doException} from "../../helpers/helpers";

"use strict";

const ui = {
    urlCreateMenu: '/api/create-menu',
    urlGetAllMenu: '/api/get-list-menu',
    urlAddCategory: '/api/add-category',
    urlAddPage: '/api/add-page',
    urlAddCustom: '/api/add-custom',
    urlGetMenuNestable: '/api/get-menu/',
    urlDeleteMenu: '/api/delete-menu',
    elementNestable: '.dd-list',
    divNestable: '#nestable_list_2'
};

$(function () {
    let wrapCategory, wrapCustom, wrapPages, url, domain, menuGroup;
    url = window.location;
    wrapCategory = $('.wrap-menu-category');
    wrapPages = $('.wrap-menu-pages');
    wrapCustom = $('.wrap-menu-custom');
    menuGroup = $('#list-menu-item').val();

    if (url.port) {
        domain = url.protocol + '//' + url.hostname + ':' + url.port
    } else {
        domain = url.protocol + '//' + url.hostname;
    }

    $('#theme-select-menu').on('click', function () {
        menuGroup = $('#list-menu-item').val();
        if (menuGroup !== null && menuGroup !== '') {
            location.href = domain + '/administrator/menu?menu_group=' + menuGroup;
        }
    });

    $('#modalAddMenu').on('click', '#ajax-add-menu', function () {
        $.ajax({
            url: ui.urlCreateMenu,
            type: 'post',
            dataType: 'json',
            data: {
                name: $('#menu-name').val()
            },
            success: function (data) {
                toastr.info(data.message);
            }, error: function (xhr) {
                doException(xhr, {elementShowError: '.show-error'});
            }, complete: function () {
                // reload list menu group.
                $('#selected-menu').load(ui.urlGetAllMenu + '?menu_group=' + menuGroup);
                // close modal.
                $('#modalAddMenu').modal('toggle');
            }
        });
    });

    if (wrapCategory.length) {
        wrapCategory.on('click', '#add-category', function () {
            let idsCategory;
            if (menuGroup === null || menuGroup === '') {
                callBeforeAddMenu();
                return false;
            }
            idsCategory = $('input[name="parent[]"]:checkbox:checked').map(function () {
                return $(this).val();
            }).get();

            if (idsCategory.length) {
                $.ajax({
                    type: "post",
                    dataType: 'json',
                    url: ui.urlAddCategory,
                    data: {
                        ids: idsCategory,
                        idMenuGroup: menuGroup
                    }
                }).done(respon => {
                    // reload menu after change.
                    $(ui.divNestable).load(ui.urlGetMenuNestable + menuGroup);
                }).fail(xhr => {
                    doException(xhr);
                });
            }
        });
    }

    if (wrapPages.length) {
        wrapPages.on('click', '#add-page', function () {
            let idsPages;
            if (menuGroup === null || menuGroup === '') {
                callBeforeAddMenu();
                return false;
            }
            idsPages = $('input[name="page[]"]:checkbox:checked').map(function () {
                return $(this).val();
            }).get();

            if (idsPages.length) {
                $.ajax({
                    type: "post",
                    dataType: 'json',
                    url: ui.urlAddPage,
                    data: {ids: idsPages, idMenuGroup: menuGroup},
                    success: function (result) {
                        // reload menu after change.
                        $(ui.divNestable).load(ui.urlGetMenuNestable + menuGroup);
                    },
                    error: function () {
                        doException(xhr);
                    }
                });
            }
        });
    }

    if (wrapCustom.length) {
        wrapCustom.on('click', '#add-custom', function () {
            let label, direct, formCustom;
            if (menuGroup === null || menuGroup === '') {
                callBeforeAddMenu();
                return false;
            }
            label = wrapCustom.find('.custom-label');
            direct = wrapCustom.find('.custom-url');

            formCustom = $('#frmCustom');

            formCustom.validate();

            if (formCustom.valid()) {
                $.ajax({
                    type: "post",
                    dataType: 'json',
                    url: ui.urlAddCustom,
                    data: {
                        label: label.val(),
                        url: direct.val(),
                        idMenuGroup: menuGroup
                    },
                    success: function (result) {
                        // reload menu after change.
                        $(ui.divNestable).load(ui.urlGetMenuNestable + menuGroup);
                    },
                    error: function () {
                        doException(xhr);
                    }
                });
            }
        });
    }

    $('#nestable_list_2').on('click', '.delete-item', function () {
        let id = $(this).data('id');
        swal({
            title: 'Are you sure?',
            type: 'warning',
            showCancelButton: true,
            customClass: 'nvh-dialog',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then(function () {
            $.ajax({
                type: "post",
                dataType: 'json',
                url: ui.urlDeleteMenu,
                data: {id: id},
                success: function (result) {
                    toastr.info(result.message);
                    $(ui.divNestable).load(ui.urlGetMenuNestable + menuGroup);
                },
                error: function () {
                    doException(xhr);
                }
            });
        });
    });

    function callBeforeAddMenu() {
        swal(
            'Invalid',
            'Please create menu before to do this action!',
            'error'
        );
    }
});