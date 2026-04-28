<?php


namespace TMS\Theme\MuumiB2B\Helpers;

/**
 * Class InlineBackgroundHelper
 *
 * Usage {@inlinebg id=id size="large" /}
 *
 * @package TMS\Theme\MuumiB2B\Helpers
 */
class InlineBackgroundHelper extends \DustPress\Helper {

    /**
     * Returns the helper html.
     *
     * @return mixed|string
     */
    public function output() {
        if ( isset( $this->params->url ) ) {
            return sprintf(
                'style="background-image: url(\'%s\')"',
                esc_url( $this->params->url )
            );
        }
        else {
            if ( ! isset( $this->params->id ) ) {
                return 'DustPress InlineBackground helper error: no image ID defined.';
            }

            if ( ! isset( $this->params->size ) ) {
                return 'DustPress InlineBackground helper error: no image size defined.';
            }

            return sprintf(
                'style="background-image: url(%s)"',
                wp_get_attachment_image_url(
                    $this->params->id,
                    $this->params->size
                ),
            );
        }
    }
}
