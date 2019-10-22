(function ($, window) {

    const hostname = window.location.hostname.replace('www.', '');

    function confirm() {
        var $this = $(this);
        $this.click(function () {
            return window.confirm($this.data('confirm'));
        });
    }

    function link() {
        if (this.hostname.replace('www.', '') === hostname) {
            return;
        }
        $(this).attr('target', '_blank');
    }

    function windowBeforeUnload(e) {
        var clean = true;
        $('form').each(function () {
            var $form = $(this);
            if ($form.data('dirty')) {
                clean = false;
            }
        });
        if (!clean) {
            var message = 'You have unsaved changes.';
            e.returnValue = message;
            return message;
        }
    }

    function formDirty() {
        var $form = $(this);
        $form.data('dirty', false);
        $form.on('change', function () {
            $form.data('dirty', true);
        });
        $form.on('submit', function () {
            $(window).unbind('beforeunload');
        });
    }

    function formPopup(e) {
        e.preventDefault();
        var url = $(this).prop('href');
        window.open(url, '_blank', 'toolbar=no,scrollbars=yes,resizable=yes,width=500,height=600');
    }

    function simpleCollection() {
        $('.collection-simple').collection({
            init_with_n_elements: 1,
            allow_up: false,
            allow_down: false,
            add: '<a href="#" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-plus"></span></a>',
            remove: '<a href="#" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-minus"></span></a>',
            add_at_the_end: false,
        });
    }

    function complexCollection() {
        $('.collection-complex').collection({
            init_with_n_elements: 1,
            allow_up: false,
            allow_down: false,
            add: '<a href="#" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-plus"></span></a>',
            remove: '<a href="#" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-minus"></span></a>',
            add_at_the_end: true,
            after_add: function (collection, element) {
                $(element).find('.select2entity').select2entity();
                $(element).find('.select2-container').css('width', '100%');
                $(element).find('a.popup').click(formPopup);
                window.tinymce.EditorManager.execCommand('mceAddEditor', false, $(element).find('.tinymce').attr('id'));
                return true;
            },
        });
    }
    $(document).ready(function () {
        $(window).bind('beforeunload', windowBeforeUnload);
        $('form').each(formDirty);
        $('a.popup').click(formPopup);
        $('a').each(link);
        $('*[data-confirm]').each(confirm);
        $('[data-toggle="popover"]').popover({
            container: 'body',
            trigger: 'hover',
            alignment: 'bottom',
        }); //add this line to enable bootstrap popover
        if (typeof $().collection === 'function') {
            simpleCollection();
            complexCollection();
        }
    });

})(jQuery, window);
