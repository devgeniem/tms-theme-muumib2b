
( function( document, $, acf ) {

    /**
     * Initialize an object that contains
     * all code and functions inside this IIFE.
     */
    const app = {};

    // Run object methods inside init method.
    app.init = () => {

        app.handleBlockSettingsToggles();
        app.handlePreviewImageToggles();
    };

    app.handlePreviewImageToggles = () => {

        $( '.acf-field-flexible-content' ).on(
            'click',
            '.preview-image-toggle',
            function( e ) {

                e.preventDefault();

                $( this ).find( '.toggleable-preview-image' ).toggleClass( 'hidden' );
                $( this ).find( '.show-preview-image' ).toggleClass( 'clicked' );
            }
        );
    };

    app.handleBlockSettingsToggles = () => {

        $( '.acf-field-flexible-content' ).on(
            'click',
            '.block-settings-toggle',
            function( e ) {

                e.preventDefault();

                $( this ).next( '.toggleable-block-settings' ).toggleClass( 'hidden' );
                $( this ).find( '.show-block-settings' ).toggleClass( 'clicked' );
            }
        );
    };

    // Run object's init method on document ready.
    $( document ).ready( () => {
        app.init();
    } );

// Close scope.
}( document, jQuery, window.acf ) );
