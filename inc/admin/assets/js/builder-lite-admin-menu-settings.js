/**
 * Install BuilderLite Starter Sites
 *
 *
 * @since 1.2.4
 */

(function ($) {

    BuilderLiteThemeAdmin = {

        init: function () {
            this._bind();
        },


        /**
         * Binds events for the BuilderLite Theme.
         *
         * @since 1.0.0
         * @access private
         * @method _bind
         */
        _bind: function () {
            $(document).on('click', '.bul-sites-notinstalled', BuilderLiteThemeAdmin._installNow);
            $(document).on('click', '.bul-sites-inactive', BuilderLiteThemeAdmin._activatePlugin);
            $(document).on('wp-plugin-install-success', BuilderLiteThemeAdmin._activatePlugin);
            $(document).on('wp-plugin-installing', BuilderLiteThemeAdmin._pluginInstalling);
            $(document).on('wp-plugin-install-error', BuilderLiteThemeAdmin._installError);
        },

        /**
         * Plugin Installation Error.
         */
        _installError: function (event, response) {

            var $card = jQuery('.bul-sites-notinstalled');

            $card
                .removeClass('button-primary')
                .addClass('disabled')
                .html(wp.updates.l10n.installFailedShort);
        },

        /**
         * Installing Plugin
         */
        _pluginInstalling: function (event, args) {
            event.preventDefault();

            var $card = jQuery('.bul-sites-notinstalled');

            $card.addClass('updating-message');

        },
        /**
         * Activate Success
         */
        _activatePlugin: function (event, response) {

            event.preventDefault();

            var $message = $('.bul-sites-notinstalled');
            if (0 === $message.length) {
                $message = $('.bul-sites-inactive');
            }

            // Transform the 'Install' button into an 'Activate' button.
            var $init = $message.data('init');

            $message.removeClass('install-now installed button-disabled updated-message')
                .addClass('updating-message')
                .html(builder_lite.btnActivating);

            // WordPress adds "Activate" button after waiting for 1000ms. So we will run our activation after that.
            setTimeout(function () {

                $.ajax({
                    url: builder_lite.ajaxUrl,
                    type: 'POST',
                    data: {
                        'action': 'themeegg-toolkit-plugin-activate',
                        'init': $init,
                    },
                })
                    .done(function (result) {

                        if (result.success) {
                            var output = '<a href="' + builder_lite.builderLiteSitesLink + '" aria-label="' + builder_lite.builderLiteSitesLinkTitle + '">' + builder_lite.builderLiteSitesLinkTitle + ' </a>'
                            $message.removeClass('bul-sites-inactive bul-sites-notinstalled button button-primary install-now activate-now updating-message')
                                .html(output);

                        } else {

                            $message.removeClass('updating-message');

                        }

                    });

            }, 1200);

        },

        /**
         * Install Now
         */
        _installNow: function (event) {
            event.preventDefault();

            var $button = jQuery(event.target),
                $document = jQuery(document);

            if ($button.hasClass('updating-message') || $button.hasClass('button-disabled')) {
                return;
            }

            if (wp.updates.shouldRequestFilesystemCredentials && !wp.updates.ajaxLocked) {
                wp.updates.requestFilesystemCredentials(event);

                $document.on('credential-modal-cancel', function () {
                    var $message = $('.bul-sites-notinstalled.updating-message');

                    $message
                        .addClass('bul-sites-inactive')
                        .removeClass('updating-message bul-sites-notinstalled')
                        .text(wp.updates.l10n.installNow);

                    wp.a11y.speak(wp.updates.l10n.updateCancel, 'polite');
                });
            }

            wp.updates.installPlugin({
                slug: $button.data('slug')
            });
        },
    };

    /**
     * Initialize BuilderLiteThemeAdmin
     */
    $(function () {
        BuilderLiteThemeAdmin.init();
    });

})(jQuery);