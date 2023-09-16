jQuery(document).ready(function ($) {

    (function () {

        var select = 'select[name*="maintenance_type"]',
            value = $(select).val();

        /**
         * Get value of select tag and open its table
         */
        if ('page' == value) {
            $('.form-table.' + value + '_type').addClass('active');
        }
        else if ('redirect' == value) {
            $('.form-table.' + value + '_type').addClass('active');

        }

        /**
         * On select change
         */
        $(select).change(function () {
            value = this.value;

            $('.form-table').filter(function () {
                return $(this).hasClass('active');
            }).removeClass('active');

            if ('page' == value) {
                $('.form-table.' + value + '_type').addClass('active');
            }
            else if ('redirect' == value) {
                $('.form-table.' + value + '_type').addClass('active');

            }
        });

        /**
         * From here and on we deal with the tabs module.
         */
        function s_s_display_section(_this) {

            $('.section', '.wp-manutencao form').removeClass('active');

            selector = _this.attr('href');

            $(selector).addClass('active');

        }

        $('body').on('click', 'a[href$="-tab"]', function (e) {

            e.preventDefault();

            $this = $(this);

            $('a', '.wp-manutencao .nav-tab-wrapper').removeClass('nav-tab-active');

            $this.addClass('nav-tab-active');

            s_s_display_section($this);

        });

    })();

});