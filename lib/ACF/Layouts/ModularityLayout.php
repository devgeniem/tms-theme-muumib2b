<?php
/**
 * Copyright (c) 2021. Geniem Oy
 */

namespace TMS\Theme\MuumiB2B\ACF\Layouts;

use Geniem\ACF\Exception;
use TMS\Theme\MuumiB2B\ACF\Fields\ImageBannerFields;
use TMS\Theme\MuumiB2B\ACF\Fields\ModularityFields;
use TMS\Theme\MuumiB2B\Logger;

/**
 * Class ModularityLayout
 *
 * @package TMS\Theme\MuumiB2B\ACF\Layouts
 */
class ModularityLayout extends BaseLayout {

    /**
     * Layout key
     */
    const KEY = '_modularity';

    /**
     * Create the layout
     *
     * @param string $key Key from the flexible content.
     */
    public function __construct( string $key ) {
        parent::__construct(
            'Modulaariset kuvitukset',
            $key . self::KEY,
            'modularity'
        );

        $this->add_layout_fields();
    }

    /**
     * Add layout fields
     *
     * @return void
     */
    private function add_layout_fields() : void {
        $fields = new ModularityFields(
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
