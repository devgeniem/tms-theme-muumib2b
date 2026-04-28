<?php


namespace TMS\Theme\MuumiB2B\ACF\Layouts;

use Geniem\ACF\Exception;
use TMS\Theme\MuumiB2B\ACF\Fields\CountdownFields;
use TMS\Theme\MuumiB2B\Logger;

/**
 * Class CountdownLayout
 *
 * @package TMS\Theme\MuumiB2B\ACF\Layouts
 */
class CountdownLayout extends BaseLayout {

    /**
     * Layout key
     */
    const KEY = '_countdown';

    /**
     * Create the layout
     *
     * @param string $key Key from the flexible content.
     */
    public function __construct( string $key ) {
        parent::__construct(
            'Countdown-laskuri',
            $key . self::KEY,
            'countdown'
        );

        $this->add_layout_fields();
    }

    /**
     * Add layout fields
     *
     * @return void
     */
    private function add_layout_fields() : void {
        $fields = new CountdownFields(
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
