// Use jQuery as $ within this file scope.
const $ = jQuery; // eslint-disable-line no-unused-vars

/**
 * Export the class reference.
 */
export default class RollingText {

    constructor() {
        this.rows = [];
        this.raf = null;
        this.isAnimating = false;
        this.isPaused = false;
        this.lastFrameTime = null;
        this.defaultSpeed = 40;
        this.visibilityObserver = null;
        this.toggleButtons = [];

        this.animate = this.animate.bind( this );
        this.rebuildRows = this.rebuildRows.bind( this );
        this.onIntersection = this.onIntersection.bind( this );
        this.togglePause = this.togglePause.bind( this );
    }

    /**
     * Build DOM structure for each row and calculate animation values.
     *
     * @param {Element} row Row element.
     * @return {?Object} Row state or null.
     */
    setupRow( row ) {
        if ( ! row ) {
            return null;
        }

        let track = row.querySelector( '.rolling-text__track' );
        let baseSequence = null;

        if ( ! track ) {
            track = document.createElement( 'div' );
            track.className = 'rolling-text__track';

            baseSequence = document.createElement( 'div' );
            baseSequence.className = 'rolling-text__sequence rolling-text__sequence--base';

            while ( row.firstChild ) {
                baseSequence.appendChild( row.firstChild );
            }

            track.appendChild( baseSequence );
            row.appendChild( track );
        }

        baseSequence = track.querySelector( '.rolling-text__sequence--base' );

        // Ensure no previously generated clones remain before re-measuring.
        Array.from( track.querySelectorAll( '.rolling-text__sequence--clone' ) )
            .forEach( ( clone ) => clone.remove() );

        if ( ! baseSequence ) {
            return null;
        }

        const baseItemsCount = Array.from( baseSequence.children )
            .filter( ( element ) => element.classList.contains( 'rolling-text__item' ) ).length;

        if ( ! baseItemsCount ) {
            return null;
        }

        const baseWidth = baseSequence.getBoundingClientRect().width;

        if ( ! baseWidth ) {
            return null;
        }

        const rowWidth = Math.max( row.getBoundingClientRect().width, window.innerWidth );
        const clonesAfterBase = Math.max( 2, Math.ceil( rowWidth / baseWidth ) + 2 );

        const prependClone = baseSequence.cloneNode( true );
        prependClone.classList.remove( 'rolling-text__sequence--base' );
        prependClone.classList.add( 'rolling-text__sequence--clone' );
        prependClone.setAttribute( 'aria-hidden', 'true' );
        prependClone.querySelectorAll( '.rolling-text__item' ).forEach( ( item ) => {
            item.setAttribute( 'aria-hidden', 'true' );
        } );
        track.insertBefore( prependClone, baseSequence );

        for ( let iteration = 0; iteration < clonesAfterBase; iteration++ ) {
            const clone = baseSequence.cloneNode( true );
            clone.classList.remove( 'rolling-text__sequence--base' );
            clone.classList.add( 'rolling-text__sequence--clone' );
            clone.setAttribute( 'aria-hidden', 'true' );
            clone.querySelectorAll( '.rolling-text__item' ).forEach( ( item ) => {
                item.setAttribute( 'aria-hidden', 'true' );
            } );
            track.appendChild( clone );
        }

        const isRightDirection = row.classList.contains( 'rolling-text__row--right' );
        const speed = Number.parseFloat( row.dataset.rollingSpeed ) || this.defaultSpeed;
        const offset = -baseWidth;

        track.style.transform = `translate3d(${ offset }px, 0, 0)`;

        return {
            row,
            container: row.closest( '.rolling-text' ) || row,
            track,
            isRightDirection,
            speed,
            baseWidth,
            offset,
            isVisible: false,
        };
    }

    /**
     * Toggle the paused state of the animation.
     *
     * @return {void}
     */
    togglePause() {
        this.isPaused = ! this.isPaused;

        this.rows.forEach( ( rowState ) => {
            rowState.container.classList.toggle( 'is-paused', this.isPaused );
        } );

        this.toggleButtons.forEach( ( button ) => {
            const label = this.isPaused
                ? button.dataset.labelPlay
                : button.dataset.labelPause;
            button.setAttribute( 'aria-label', label );
        } );

        if ( this.isPaused ) {
            this.stopAnimation();
        }
        else {
            const anyVisible = this.rows.some( ( rowState ) => rowState.isVisible );

            if ( anyVisible ) {
                this.startAnimation();
            }
        }
    }

    /**
     * Recalculate rolling rows. Used on init and resize.
     *
     * @return {void}
     */
    rebuildRows() {
        const rows = Array.from( document.querySelectorAll( '.rolling-text__row' ) );
        this.rows = rows.map( ( row ) => this.setupRow( row ) ).filter( Boolean );

        if ( this.visibilityObserver ) {
            this.visibilityObserver.disconnect();
            this.rows.forEach( ( rowState ) => this.visibilityObserver.observe( rowState.container ) );
        }

        if ( ! this.visibilityObserver ) {
            return;
        }

        const anyVisible = this.rows.some( ( rowState ) => rowState.isVisible );

        if ( anyVisible && ! this.isPaused ) {
            this.startAnimation();
        }
        else {
            this.stopAnimation();
        }
    }

    /**
     * Handle intersection updates and toggle animation state.
     *
     * @param {IntersectionObserverEntry[]} entries Observer entries.
     * @return {void}
     */
    onIntersection( entries ) {
        entries.forEach( ( entry ) => {
            this.rows.forEach( ( rowState ) => {
                if ( rowState.container === entry.target ) {
                    rowState.isVisible = entry.isIntersecting;
                }
            } );
        } );

        const anyVisible = this.rows.some( ( rowState ) => rowState.isVisible );

        if ( anyVisible && ! this.isPaused ) {
            this.startAnimation();
        }
        else {
            this.stopAnimation();
        }
    }

    /**
     * Start requestAnimationFrame loop.
     *
     * @return {void}
     */
    startAnimation() {
        if ( this.isAnimating ) {
            return;
        }

        this.isAnimating = true;
        this.lastFrameTime = null;
        this.raf = window.requestAnimationFrame( this.animate );
    }

    /**
     * Stop requestAnimationFrame loop.
     *
     * @return {void}
     */
    stopAnimation() {
        if ( ! this.isAnimating ) {
            return;
        }

        this.isAnimating = false;

        if ( this.raf ) {
            window.cancelAnimationFrame( this.raf );
            this.raf = null;
        }
    }

    /**
     * Keep offset in one seamless loop range.
     *
     * @param {number} value Current offset value.
     * @param {number} width Width of one base sequence.
     * @return {number} Wrapped offset between -width and 0.
     */
    wrapOffset( value, width ) {
        return ( ( ( value % width ) + width ) % width ) - width;
    }

    /**
     * Animate all rows with requestAnimationFrame.
     *
     * @param {number} timestamp RAF timestamp.
     * @return {void}
     */
    animate( timestamp ) {
        if ( ! this.isAnimating ) {
            return;
        }

        if ( this.lastFrameTime === null ) {
            this.lastFrameTime = timestamp;
        }

        const delta = ( timestamp - this.lastFrameTime ) / 1000;
        this.lastFrameTime = timestamp;

        this.rows.forEach( ( rowState ) => {
            if ( ! rowState.isVisible && this.visibilityObserver ) {
                return;
            }

            const direction = rowState.isRightDirection ? 1 : -1;
            const movement = direction * rowState.speed * delta;
            rowState.offset = this.wrapOffset( rowState.offset + movement, rowState.baseWidth );

            rowState.track.style.transform = `translate3d(${ rowState.offset }px, 0, 0)`;
        } );

        this.raf = window.requestAnimationFrame( this.animate );
    }

    /**
     * Run when the document is ready.
     *
     * @return {void}
     */
    docReady() {
        this.rebuildRows();

        if ( ! this.rows.length ) {
            return;
        }

        if ( 'IntersectionObserver' in window ) {
            this.visibilityObserver = new IntersectionObserver( this.onIntersection, {
                root: null,
                threshold: 0.1,
            } );

            this.rows.forEach( ( rowState ) => this.visibilityObserver.observe( rowState.container ) );
        }
        else {
            this.rows.forEach( ( rowState ) => {
                rowState.isVisible = true;
            } );
            this.startAnimation();
        }

        this.toggleButtons = Array.from( document.querySelectorAll( '.rolling-text__toggle' ) );
        this.toggleButtons.forEach( ( button ) => {
            button.addEventListener( 'click', this.togglePause );
        } );

        window.addEventListener( 'resize', this.rebuildRows );
    }
}
