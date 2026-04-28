/**
 * Mirror video frames into a blurred background canvas.
 */

export default class VideoBgMirror {

    /**
     * Run when the document is ready.
     *
     * @return {void}
     */
    docReady() {
        const containers = document.querySelectorAll( '.layout-video .is-embed-container' );

        if ( containers.length === 0 ) {
            return;
        }

        containers.forEach( ( container ) => this.initContainer( container ) );
    }

    /**
     * Initialize a mirrored background canvas for one video container.
     *
     * @param {HTMLElement} container Video wrapper.
     * @return {void}
     */
    initContainer( container ) {
        const video = container.querySelector( 'video.video-embed' );

        if ( ! video ) {
            return;
        }

        const canvas = document.createElement( 'canvas' );
        canvas.className = 'video-embed-bg-canvas';
        canvas.setAttribute( 'aria-hidden', 'true' );
        container.prepend( canvas );

        const context = canvas.getContext( '2d', { alpha: false } );

        if ( ! context ) {
            canvas.remove();
            return;
        }

        const state = {
            rafId: 0,
            lastFrameAt: 0,
            isRunning: false,
            needsMirror: true,
        };

        const stopMirrorLoop = () => {
            state.isRunning = false;

            if ( state.rafId ) {
                window.cancelAnimationFrame( state.rafId );
                state.rafId = 0;
            }
        };

        const syncCanvasSize = () => {
            const rect = container.getBoundingClientRect();
            const ratio = Math.min( window.devicePixelRatio || 1, 2 );
            const width = Math.max( 1, Math.round( rect.width * ratio ) );
            const height = Math.max( 1, Math.round( rect.height * ratio ) );

            if ( canvas.width !== width || canvas.height !== height ) {
                canvas.width = width;
                canvas.height = height;
            }
        };

        const updateNeedMirror = () => {
            if ( ! video.videoWidth || ! video.videoHeight ) {
                state.needsMirror = true;
                return;
            }

            const containerRatio = container.clientWidth / container.clientHeight;
            const videoRatio = video.videoWidth / video.videoHeight;

            // If ratios are almost equal, contain-fit already fills area well.
            state.needsMirror = Math.abs( containerRatio - videoRatio ) > 0.02;
            canvas.style.display = state.needsMirror ? 'block' : 'none';

            if ( ! state.needsMirror ) {
                stopMirrorLoop();
            }
        };

        const drawFrame = () => {
            if ( ! state.needsMirror || video.readyState < 2 || ! video.videoWidth || ! video.videoHeight ) {
                return;
            }

            const targetWidth = canvas.width;
            const targetHeight = canvas.height;
            const sourceWidth = video.videoWidth;
            const sourceHeight = video.videoHeight;
            const scale = Math.max( targetWidth / sourceWidth, targetHeight / sourceHeight );
            const drawWidth = sourceWidth * scale;
            const drawHeight = sourceHeight * scale;
            const offsetX = ( targetWidth - drawWidth ) / 2;
            const offsetY = ( targetHeight - drawHeight ) / 2;

            context.drawImage( video, offsetX, offsetY, drawWidth, drawHeight );
        };

        const startMirrorLoop = () => {
            if ( state.isRunning || ! state.needsMirror ) {
                return;
            }

            state.isRunning = true;

            const renderWithRaf = ( now ) => {
                if ( ! state.isRunning || video.paused || video.ended ) {
                    return;
                }

                // Limit fallback rendering to ~30fps for lower CPU usage.
                if ( now - state.lastFrameAt >= 33 ) {
                    drawFrame();
                    state.lastFrameAt = now;
                }

                state.rafId = window.requestAnimationFrame( renderWithRaf );
            };

            state.rafId = window.requestAnimationFrame( renderWithRaf );
        };

        const handleResize = () => {
            syncCanvasSize();
            updateNeedMirror();
            drawFrame();
        };

        if ( 'ResizeObserver' in window ) {
            const observer = new window.ResizeObserver( handleResize );
            observer.observe( container );
        }
        else {
            window.addEventListener( 'resize', handleResize );
        }

        video.addEventListener( 'play', startMirrorLoop );
        video.addEventListener( 'pause', stopMirrorLoop );
        video.addEventListener( 'ended', stopMirrorLoop );
        video.addEventListener( 'loadedmetadata', () => {
            syncCanvasSize();
            updateNeedMirror();
            drawFrame();
        } );
        video.addEventListener( 'loadeddata', () => {
            updateNeedMirror();
            drawFrame();
        } );
        video.addEventListener( 'seeked', () => {
            updateNeedMirror();
            drawFrame();
        } );

        syncCanvasSize();
        updateNeedMirror();
        drawFrame();

        if ( state.needsMirror && ! video.paused && ! video.ended ) {
            startMirrorLoop();
        }
    }
}
