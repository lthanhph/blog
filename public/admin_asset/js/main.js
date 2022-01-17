//  const { get } = require("lodash");

$(document).ready(function () {
    uploaderSetup({
        uploadBtn: $('.thumbnail-box .upload'),
        removeBtn: $('.thumbnail-box .remove-thumbnail'),
        fileInput: $('.thumbnail-box input[name="thumbnail"]'),
        fileIdInput: $('.thumbnail-box input[name="thumbnail_id"]'),
        previewImg: $('.thumbnail-box .thumbnail-preview img'),
        tokenInput: $('.thumbnail-box input[name="_token"]'),
    });
    uploaderSetup({
        uploadBtn: $('#user-create-edit .upload'),
        removeBtn: $('#user-create-edit .remove-avatar'),
        fileInput: $('#user-create-edit input[name="avatar"]'),
        fileIdInput: $('#user-create-edit input[name="avatar_id"]'),
        previewImg: $('#user-create-edit .avatar-preview img'),
        tokenInput: $('#user-create-edit input[name="_token"]'),
    });
    tagInput($('input[name="tag"]'));
    deletePopupSubmit();
    menuConfig();
    ajaxPagination();
    menuToggleOnWindowResize();
    hamburgerMenu();
});

/**
 * 
 * @param {object} elements Default arg: {
 *                                          uploadBtn: '', 
 *                                          removeBtn: '',
 *                                          fileInput: '',
 *                                          fileIdInput: '',
 *                                          previewImg: '',
 *                                          tokenInput: '',
 *                                       }
 */
function uploaderSetup(elements) {
    var placeholder = '/image/placeholder/1.png';

    // upload btn
    elements.uploadBtn.click(function (event) {
        event.preventDefault();
        elements.fileInput.click();
    });

    // remove btn
    elements.removeBtn.click(function (event) {
        event.preventDefault();
        elements.fileInput.val('');
        elements.fileIdInput.val('');
        elements.previewImg.attr('src', placeholder);
    });

    // upload
    elements.fileInput.change(function () {
        var file = $(this)[0].files[0];
        $(this).val('');
        var token = elements.tokenInput.val();
        upload(file, token, function (data) {
            elements.previewImg.attr('src', data['url']);
            elements.fileIdInput.val(data['id']);
        });
    });
}

function upload(file, token, success) {
    formData = new FormData();
    formData.append('image', file);
    formData.append('_token', token);
    $.ajax({
        url: '/admin/upload',
        data: formData,
        method: 'POST',
        contentType: false,
        processData: false,
        success: success,
    });
}

function tagInput(input) {
    // prevent default enter submit
    $(window).keydown(function (event) {
        if (event.keyCode == 13) {
            event.preventDefault();
        }
    });

    // add tag
    input.keydown(function (event) {
        if (event.keyCode == 13) {
            addTag(input);
        }
    })
    $('.tag-box .add').click(function (event) {
        event.preventDefault();
        addTag(input);
    })

    // remove tag
    $('.tag-box').on('click', '.tag .remove', function (event) {
        $(this).parents('.tag-wrapper').remove();
    });
}

function addTag(input) {
    var tagHtml = '<div class="tag-wrapper">' +
                        '<span class="tag badge bg-success me-2 mt-2 user-select-none">' +
                            'tag-title' +
                            '<i class="remove text-light fas fa-times ms-2"></i>' +
                        '</span>' +
                        '<input type="hidden" name="tag_titles[]" value="tag-title">'
                    '</div>';
    var title = input.val().trim();
    if (title) {
        var tag = tagHtml.replace(new RegExp('tag-title', 'g'), title)
        $('.tag-added').append(tag);
    }
    input.val('');
}



function deletePopupSubmit() {
    var form;
    $('.manager').on('click', '.table .delete', function(event) {
        event.preventDefault();
        form = $(this).parents('.delete-form');
    })
    $('#delete-popup .confirm').click(function(){
        if (form) {
            form.submit();
        }
    });
}


// because custom link not have id, so we define manually
// to determine if someone add multiple custom link
if (typeof customLinkId == 'undefined') {
    var customLinkId = 0;
}
function menuConfig() {
    $('#menu-config .add-to-menu').click(function (event) {
        event.preventDefault();
        var itemData = [];
        var itemList = $(this).parents('.collapse').find('.item-list');

        // checkbox
        itemChecked = itemList.find('input[type="checkbox"]:checked');
        if (itemChecked.length > 0) {
            itemChecked.each(function() {
                // get data
                itemData.push({
                    url: $(this).attr('data-url'),
                    title: $(this).attr('data-title'),
                    type: $(this).attr('data-type'),
                    id: $(this).attr('data-id'),
                })

                // clear check
                $(this).prop('checked', false);
            })
        }

        // custom link
        var customLink = itemList.find('input[name="custom_link"]');
        if (customLink.length > 0) {
             // get data
            itemData.push({
                url: customLink.val().trim(),
                title: customLink.attr('data-title'),
                type: customLink.attr('data-type'),
                id: customLinkId,
            })
            customLink.val('');
            customLinkId++;
        }
        addToMenu(itemData);
    })

    // remove menu item
    removeItem();
    removeAllItem();

    // save menu
    $('#menu-config .save').click(function(event) {
        event.preventDefault();
        $('#menu-config form').submit();
    });

    // drag and drop
    $('#menu-config .menu > ul').sortable({
        placeholder: 'border border-secondary',
        forcePlaceholderSize: true
    });
    
}

function addToMenu(itemData) {
    var menuItems = [];
    var menu = $('#menu-config .menu .list-group');
    var itemHtml =  '<li class="menu-item">' +
                        '<div class="list-group-item list-group-item-action list-group-item-secondary">' +
                            '<div class="btn-group w-100 h-100 d-flex justify-content-between">' +
                                '<button type="button" class="border-0 bg-transparent">' +
                                    'item-title' +
                                '</button>' +
                                '<div class="flex-grow-1" style="cursor:move"></div>' +
                                '<button type="button" class="border-0 bg-transparent" data-bs-toggle="collapse"  data-bs-target="#item-config-item-type-item-id" aria-expanded="false" aria-controls="item-config-item-type-item-id">' +
                                    '<i class="fas fa-sort-down float-end"></i>' +
                                '</button>' +
                            '</div>' +
                        '</div>' +
                        '<div class="collapse" id="item-config-item-type-item-id">' +
                            '<div class="card">' +
                                '<div class="card-body">' +
                                    '<input type="text" name="item_title[]" class="form-control mb-2" placeholder="Title" value="item-title">' +
                                    '<input type="text" name="item_url[]" class="form-control mb-2" placeholder="Url" value="item-url">' +
                                    '<div class="remove-item text-end">' +
                                        '<button class="btn btn-danger">Remove</button>' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    '</li>';
    // add data to item
    $.each(itemData, function(index, data) {
        var dataAdded = replaceAll(itemHtml, {
            'item-url': data.url,
            'item-title': data.title,
            'item-type': data.type,
            'item-id': data.id,
        })
        menuItems.push(dataAdded);
    });
    // append to menu
    $.each(menuItems, function(index, menuItem) {
        menu.append(menuItem);
    });
}

function removeItem() {
    $('#menu-config .menu').on('click', '.remove-item', function() {
        $(this).parents('.menu-item').remove();
    });
}

function removeAllItem() {
    $('#menu-config .remove-all-item').click(function() {
        $('#menu-config .menu .menu-item').remove();
    });
}

function replaceAll(string, object) {
    if (!object) {
        return;
    }
    $.each(object, function(key, value) {
        string = string.replace(new RegExp(key, 'g'), value);
    });
    return string;
}

function ajaxPagination() {
    $('.manager').on('click', '.pagination a.page-link', function(event) {
        event.preventDefault();
        var url = $(this).attr('href');
        var urlSplit = url.split('?');
        url = urlSplit[0]+'?ajax_pagination=true&'+urlSplit[1];
        $.ajax({
            url: url,
            data: null,
            beforeSend: function() {
                // show loading
                $('.manager .loading').css('visibility', 'visible');
            },
            method: 'GET',
            success: function(table) {
                // fill table
                $('.manager .table-wrapper').html(table);
            },
            complete: function() {
                // hide loading
                $('.manager .loading').css('visibility', 'hidden');
            },
        });
    })
}

function menuToggleOnWindowResize() {
    $(window).on('resize', function() {
        var win = $(this);
        if (win.width() <= 767) {
            $('.menu-col').css('left', '-204px');
        } else {
            $('.menu-col').css('left', 0);
        }
    });
}

function hamburgerMenu() {
    $('.hamburger-btn').click(function() {
        var menu = $('.menu-col');
        var menuHide = menu.css('left') == '-204px';
        if (menuHide) {
            menu.animate({left: 0});
        } else {
            menu.animate({left: '-204px'});
        }
    });
}

