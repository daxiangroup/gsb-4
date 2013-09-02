var ContactFormWidget = {
    settings: {
        errors: [],
        lst_groups: $('#lst-groups'),
        /*
        form: $('#frm-contact'),
        submitButton: $('#btn-submit'),
        container: $('#cntr-contact-form'),
        */
    },

    init: function() {
        obj = this.settings;
        if (obj.lst_groups.length) {
            this.bindListClicks();
        }
        this.bindUIActions();
    },

    bindListClicks: function() {
        obj = this.settings;

        obj.lst_groups.children('.group-study').each(function() {
            $(this).bind('click', function() {
                document.location.href += '/' + $(this).data('id')
            });
        });
    },

    bindUIActions: function() {
        obj = this.settings;

        $('#mdl-join .btn-primary').bind('click', function() {

        });
    },
};

var GroupViewWidget = {
    settings: {
    },

    init: function() {
        if ($('body.group-view').length) {
            this.bindUIActions_view();
        }
    },

    bindUIActions_view: function() {
        $('.group-view .buddies-control .show-button').bind('click', function() {
            if ($(this).hasClass('icon-chevron-down')) {
                $(this).addClass('icon-chevron-up');
                $(this).removeClass('icon-chevron-down');
                $('.group-buddies').show('fast', 'swing');
            }
            else {
                $(this).addClass('icon-chevron-down');
                $(this).removeClass('icon-chevron-up');
                $('.group-buddies').hide('fast', 'swing');
            }
        });
    },
};


$(document).ready(function() {
    ContactFormWidget.init();

    GroupViewWidget.init();
});