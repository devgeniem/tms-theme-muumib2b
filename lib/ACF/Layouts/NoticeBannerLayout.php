<?php
/**
 * Copyright (c) 2021. Geniem Oy
 */

namespace TMS\Theme\MuumiB2B\ACF\Layouts;

use Geniem\ACF\Exception;
use TMS\Theme\MuumiB2B\ACF\Fields\NoticeBannerFields;
use TMS\Theme\MuumiB2B\Logger;

/**
 * Class NoticeBannerLayout
 *
 * @package TMS\Theme\MuumiB2B\ACF\Layouts
 */
class NoticeBannerLayout extends BaseLayout {

    /**
     * Layout key
     */
    const KEY = '_notice_banner';

    /**
     * Create the layout
     *
     * @param string $key Key from the flexible content.
     */
    public function __construct( string $key ) {
        parent::__construct(
            'Huomiobanneri',
            $key . self::KEY,
            'notice_banner'
        );

        $this->add_layout_fields();
    }

    /**
     * Add layout fields
     *
     * @return void
     */
    private function add_layout_fields() : void {
        $fields = new NoticeBannerFields(
            $this->get_label(),
            $this->get_key(),
            $this->get_name()
        );

        try {
            $this->add_fields(
                $this->filter_layout_fields( $fields->get_fields(), $this->get_key(), self::KEY )
            );
        }
        catch ( Exception $e ) {
            ( new Logger() )->error( $e->getMessage(), $e->getTrace() );
        }
    }
}
