<?php


namespace TMS\Theme\MuumiB2B\ACF\Layouts;

use Geniem\ACF\Exception;
use TMS\Theme\MuumiB2B\ACF\Fields\HeroAndImageCarouselFields;
use TMS\Theme\MuumiB2B\Logger;

/**
 * Class HeroAndImageCarouselLayout
 *
 * @package TMS\Theme\MuumiB2B\ACF\Layouts
 */
class HeroAndImageCarouselLayout extends BaseLayout {

    /**
     * Layout key
     */
    const KEY = '_hero_and_image_carousel';

    /**
     * Create the layout
     *
     * @param string $key Key from the flexible content.
     */
    public function __construct( string $key ) {
        parent::__construct(
            'Hero & kuvakaruselli',
            $key . self::KEY,
            'hero_and_image_carousel'
        );

        $this->add_layout_fields();
    }

    /**
     * Add layout fields
     *
     * @return void
     */
    private function add_layout_fields() : void {
        $fields = new HeroAndImageCarouselFields(
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