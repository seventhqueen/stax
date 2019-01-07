jQuery(document).ready(function ($) {
    $(document).on('click', 'a, button, input', function (e) {
        e.stopPropagation();
        e.preventDefault();
    });

    $(document).on('click', '*', function (e) {
        e.stopPropagation();
        if (!$(this).is('.hb-element, .editColumn, .duplicateColumn, .deleteColumn, .editHeader, .duplicateHeader, .deleteHeader')) {
            if (typeof(Event) === 'function') {
                document.dispatchEvent(new Event('item-deselect'));
            } else {
                var evt = document.createEvent('Event');
                evt.initEvent('item-deselect', true, false);
                document.dispatchEvent(evt);
            }
        }
    });
});
