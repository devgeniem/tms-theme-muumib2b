<?php
/**
 *  Copyright (c) 2021. Geniem Oy
 */

namespace TMS\Theme\MuumiB2B\Formatters;

use TMS\Theme\MuumiB2B\Traits;

/**
 * Class ShareLinksFormatter
 *
 * @package TMS\Theme\MuumiB2B\Formatters
 */
class ShareLinksFormatter implements \TMS\Theme\MuumiB2B\Interfaces\Formatter {

    use Traits\Sharing;

    /**
     * Define formatter name
     */
    const NAME = 'ShareLinks';

    /**
     * Hooks
     */
    public function hooks() : void {
        add_filter(
            'tms/acf/layout/share_links/data',
            [ $this, 'format' ]
        );

        add_filter(
            'tms/acf/block/share_links/data',
            [ $this, 'format' ]
        );
    }

    /**
     * Format layout data
     *
     * @param array $layout ACF Layout data.
     *
     * @return array
     */
    public function format( array $layout ) : array {
        $layout['share_links']        = $this->get_share_links();
        $layout['share_link_classes'] = $this->share_link_classes();

        return $layout;
    }
}
