<?php


namespace TMS\Theme\MuumiB2B\ACF\Layouts;

use Geniem\ACF\Exception;
use Geniem\ACF\Field;
use TMS\Theme\MuumiB2B\ACF\Fields\ImageGalleryFields;
use TMS\Theme\MuumiB2B\Logger;

/**
 * Class ImageGalleryLayout
 *
 * @package TMS\Theme\MuumiB2B\ACF\Layouts
 */
class ImageGalleryLayout extends BaseLayout {

    /**
     * Layout key
     */
    const KEY = '_image_gallery';

    /**
     * Create the layout
     *
     * @param string $key Key from the flexible content.
     */
    public function __construct( string $key ) {
        parent::__construct(
            'Kuvagalleria pystykuvilla',
            $key . self::KEY,
            'image_gallery'
        );

        $this->add_layout_fields();
    }

    /**
     * Add layout fields
     *
     * @return void
     */
    private function add_layout_fields() : void {
        $instructions_field = ( new Field\Message( 'Komponentin tiedot' ) )
            ->set_key( $this->get_key() . '_image_gallery_instructions' )
            ->set_name( 'image_gallery_instructions' )
            ->set_message( 'Kuvagalleria, jossa kuvat näytetään pystykuvina ja koko osion leveydellä. Kuville voi asettaa suuremmaksi klikattavan ominaisuuden.' );

        $fields = new ImageGalleryFields(
            $this->get_label(),
            $this->get_key(),
            $this->get_name()
        );

        $layout_fields = [
            $instructions_field,
            ...$fields->get_fields(),
        ];

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
