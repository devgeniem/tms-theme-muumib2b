<?php


namespace TMS\Theme\MuumiB2B\ACF\Layouts;

use Geniem\ACF\Exception;
use TMS\Theme\MuumiB2B\ACF\Fields\LogoWallFields;
use TMS\Theme\MuumiB2B\Logger;

/**
 * Class LogoWallLayout
 *
 * @package TMS\Theme\MuumiB2B\ACF\Layouts
 */
class LogoWallLayout extends BaseLayout {

    /**
     * Layout key
     */
    const KEY = '_logo_wall';

    /**
     * Create the layout
     *
     * @param string $key Key from the flexible content.
     */
    public function __construct( string $key ) {
        parent::__construct(
            'Logoseinä',
            $key . self::KEY,
            'logo_wall'
        );

        $this->add_layout_fields();
    }

    /**
     * Add layout fields
     *
     * @return void
     */
    private function add_layout_fields() : void {
        $fields = new LogoWallFields(
            $this->get_label(),
            $this->get_key(),
            $this->get_name()
        );

        $layout_fields = $this->with_common_fields( $fields->get_fields(), self::KEY );

        try {
            $this->add_fields(
                $this->filter_layout_fields( $layout_fields, $this->get_key(), self::KEY )
            );
        }
        catch ( Exception $e ) {
            ( new Logger() )->error( $e->getMessage(), $e->getTrace() );
        }
    }
}
