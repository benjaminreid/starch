jQuery(function ($) {
    'use strict';

    var id = 1,
        uploads = $('.media-upload'),
        hijacked = 0,
        items = {},

        parse = function (val) {
            var match = val.match(/Attachment\(([0-9]+)\)/);
            return match[1] ? match[1] : null;
        },

        refresh = function (id) {
            var item = items[id];

            if (!item) { return; }

            if (item.input.val()) {
                item.title.show();
                item.remove.css('display', 'inline-block');
                item.select.text('Change File');
            } else {
                item.title.hide();
                item.remove.hide();
                item.select.text('Select File');
            }

            if (item.thumb.attr('src')) {
                item.thumb.show();
            } else {
                item.thumb.hide();
            }
        },

        updateButton = function (id, attach) {
            var item = items[id];

            if (!item) { return; }

            item.title.text(attach.title);
            item.input.val('Attachment(' + attach.id + ')');

            if (attach.sizes && attach.sizes.thumbnail && attach.sizes.thumbnail.url && item.showThumb) {
                item.thumb.attr('src', attach.sizes.thumbnail.url);
            } else if (attach.icon) {
                item.thumb.attr('src', attach.icon);
            } else {
                item.thumb.removeAttr('src');
            }

            refresh(id);
        },

        removeItem = function (id) {
            var item = items[id];

            item.thumb.removeAttr('src');
            item.input.val('');

            refresh(id);
        },

        create = function () {
            var parent = $(this),

                input = $(parent.find('input.file-upload')[0]),
                select = $('<a />').html('Select File').addClass('select button'),
                remove = $('<a />').html('&times; Remove File').addClass('remove button').hide(),

                thumb = parent.find('img.thumb')[0],
                title = parent.find('p.title')[0],

                showThumb = parent.hasClass('show-thumb'),

                bID = id++;

            thumb = thumb ? $(thumb) : $('<img />');
            title = title ? $(title) : $('<p />');

            input.after(thumb, title, remove, select);

            items[bID] = {
                input: input,
                title: title,
                remove: remove,
                select: select,
                thumb: thumb,
                showThumb: showThumb
            };

            select.on('click', function () {
                wp.media.editor.open(bID, true);
                return false;
            });

            remove.on('click', function () {
                removeItem(bID);
                return false;
            });

            refresh(bID);
        },

        setup = function () {
            uploads.each(create);
            $('.js-warning').remove();
        },

        originalOpen,
        originalSend;

    if (typeof wp !== 'undefined' && wp.media && wp.media.editor) {
        originalOpen = wp.media.editor.open,
        originalSend = wp.media.editor.send.attachment;

        wp.media.editor.send.attachment = function(options, attachment) {
            if (hijacked) {
                updateButton(hijacked, attachment);
            } else {
                originalSend.call(this, arguments);
            }
        };

        wp.media.editor.open = function (id, custom) {
            if (custom) {
                hijacked = id;
            } else {
                hijacked = 0;
            }

            originalOpen(id);
        };

        if (uploads.length) {
            setup();
        }
    }
});