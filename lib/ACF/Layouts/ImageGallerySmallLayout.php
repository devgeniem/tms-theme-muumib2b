<?php


namespace TMS\Theme\MuumiB2B\ACF\Layouts;

use Geniem\ACF\Exception;
use Geniem\ACF\Field;
use TMS\Theme\MuumiB2B\ACF\Fields\ImageGalleryFields;
use TMS\Theme\MuumiB2B\Logger;

/**
 * Class ImageGallerySmallLayout
 *
 * @package TMS\Theme\MuumiB2B\ACF\Layouts
 */
class ImageGallerySmallLayout extends BaseLayout {

    /**
     * Layout key
     */
    const KEY = '_image_gallery_small';

    /**
     * Create the layout
     *
     * @param string $key Key from the flexible content.
     */
    public function __construct( string $key ) {
        parent::__construct(
            'Kuvagalleria pyöristetyillä kuvilla',
            $key . self::KEY,
            'image_gallery_small'
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
            ->set_key( $this->get_key() . '_image_gallery_small_instructions' )
            ->set_name( 'image_gallery_small_instructions' )
            ->set_message( 'Kuvagalleria, jossa kuvat näytetään pienempinä, ja kuvilla on pyöristetyt reunat. Kuville ei voi asettaa suuremmaksi klikattavaa ominaisuutta, vaikka kyseinen kenttä löytyykin.' );

        $fields = new ImageGalleryFields(
            $this->get_label(),
            $this->get_key(),
            $this->get_name()
        );

        $layout_fields = [
            $instructions_field,
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
