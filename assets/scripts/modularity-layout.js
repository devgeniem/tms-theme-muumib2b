// Use jQuery as $ within this file scope.
const $ = jQuery; // eslint-disable-line no-unused-vars

/**
 * Export the class reference.
 */
export default class ModularityLayout {

    constructor() {
        // Reuse one bound handler and cache target lookups to reduce repeated work.
        this.boundButtonClick = this.ButtonClick.bind( this );
        this.targetCache = {};
        this.imageItems = $( '.layout-modularity__items .modularity-image' );
    }

    /**
     * Show image when button is clicked
     *
     * @param {Event} event - The click event
     */
    ButtonClick( event ) {
        // Keep exactly one image visible: hide all, then reveal only the target image.
        const targetId = String( $( event.currentTarget ).data( 'target' ) );
        const target = this.targetCache[ targetId ] || (
            this.targetCache[ targetId ] = $( `[data-id="${ targetId }"]` )
        );

        if ( target.length ) {
            this.imageItems.addClass( 'is-hidden' );
            target.removeClass( 'is-hidden' );
        }
    }

    /**
     * Run when the document is ready.
     *
     * @return {void}
     */
    docReady() {
        $( '.modularity-button' ).on( 'click', this.boundButtonClick );
    }
}
