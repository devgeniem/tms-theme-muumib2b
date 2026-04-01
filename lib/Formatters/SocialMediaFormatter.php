<?php
/**
 *  Copyright (c) 2021. Geniem Oy
 */

namespace TMS\Theme\MuumiB2B\Formatters;

use TMS\Theme\MuumiB2B\Traits\Components;

/**
 * Class SocialMediaFormatter
 *
 * @package TMS\Theme\MuumiB2B\Formatters
 */
class SocialMediaFormatter implements \TMS\Theme\MuumiB2B\Interfaces\Formatter {

    use Components;

    /**
     * Define formatter name
     */
    const NAME = 'SocialMedia';

    /**
     * Hooks
     */
    public function hooks() : void {
        add_filter(
            'tms/acf/layout/social_media/data',
            [ $this, 'format' ]
        );
    }

    /**
     * Format layout data
     *
     * @param array $data ACF Layout data.
     *
     * @return array
     */
    public function format( array $data ) : array {
        $data['id']        = wp_unique_id( 'social-media-' );
        $data['skip_text'] = ( new \Strings() )->s()['social_media']['skip_embed'];
        return $data;
    }
}
