<?php
namespace TMS\Theme\MuumiB2B\ACF\Layouts;

use Geniem\ACF\Exception;
use Geniem\ACF\Field;
use TMS\Theme\MuumiB2B\ACF\Fields\ContentColumnsFields;
use TMS\Theme\MuumiB2B\Logger;

/**
 * Class ContentColumnsExhibitionOne
 *
 * @package TMS\Theme\MuumiB2B\ACF\Layouts
 */
class ContentColumnsExhibitionOne extends BaseLayout {

    /**
     * Layout key
     */
    const KEY = '_content_columns_exhibition_one';

    /**
     * Create the layout
     *
     * @param string $key Key from the flexible content.
     */
    public function __construct( string $key ) {
        parent::__construct(
            'Palstat näyttelysivulle',
            $key . self::KEY,
            'content_columns_exhibition_one'
        );

        $this->add_layout_fields();
    }

    /**
     * Add layout fields
     *
     * @return void
     */
    private function add_layout_fields() : void {
        $fields = new ContentColumnsFields(
            $this->get_label(),
            $this->get_key(),
            $this->get_name()
        );

        $message_field = ( new Field\Message( 'Komponentin tiedot' ) )
            ->set_key( "{$this->get_key()}_message" )
            ->set_name( 'message' )
            ->set_message( 'Pinkillä taustavärillä olevalle komponentille tulee oikeaan reunaan rappusten kuvitus.
            Käytä normaalia "Palstat"-komponenttia jos tarvitset pinkin taustavärin ilman kuvitusta.' );

        $layout_fields = [
            $message_field,
            ...$fields->get_fields(),
        ];

        $layout_fields = $this->with_common_fields( $layout_fields, self::KEY );

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
