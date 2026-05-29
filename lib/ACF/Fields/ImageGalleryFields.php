<?php


namespace TMS\Theme\MuumiB2B\ACF\Fields;

use Geniem\ACF\Exception;
use Geniem\ACF\Field;
use TMS\Theme\MuumiB2B\Logger;

/**
 * Class ImageGalleryFields
 *
 * @package TMS\Theme\MuumiB2B\ACF\Fields
 */
class ImageGalleryFields extends Field\Group {

    /**
     * The constructor for field.
     *
     * @param string $label Label.
     * @param null   $key   Key.
     * @param null   $name  Name.
     */
    public function __construct( $label = '', $key = null, $name = null ) {
        parent::__construct( $label, $key, $name );

        try {
            $this->add_fields( $this->sub_fields() );
        }
        catch ( \Exception $e ) {
            ( new Logger() )->error( $e->getMessage(), $e->getTrace() );
        }
    }

    /**
     * This returns all sub fields of the parent groupable.
     *
     * @return array
     * @throws Exception In case of invalid ACF option.
     */
    protected function sub_fields() : array {
        $strings = [
            'instructions'            => [
                'label'        => 'Komponentin tiedot',
                'instructions' => 'Kuvagalleria, jossa kuvat näytetään pienempinä, ja kuvilla on pyöristetyt reunat.
                Kuville ei voi asettaa suuremmaksi klikattavaa ominaisuutta, vaikka kyseinen kenttä löytyykin.',
            ],
            'rows' => [
                'label'        => 'Kuvagalleria',
                'instructions' => '',
                'button'       => 'Lisää kuva',
            ],
            'image' => [
                'label'        => 'Kuva',
                'instructions' => '',
            ],
        ];

        $key = $this->get_key();

        $instructions_field = ( new Field\Message( $strings['instructions']['label'] ) )
            ->set_key( "{$key}_image_gallery_small_instructions" )
            ->set_name( 'image_gallery_small_instructions' )
            ->set_message( $strings['instructions']['instructions'] );

        $rows_field = ( new Field\Repeater( $strings['rows']['label'] ) )
            ->set_key( "{$key}_rows" )
            ->set_name( 'rows' )
            ->set_min( 1 )
            ->set_layout( 'block' )
            ->set_button_label( $strings['rows']['button'] )
            ->set_instructions( $strings['rows']['instructions'] );

        $image_field = ( new ImageFields( $strings['image']['label'], "{$key}_image", 'image' ) );

        $rows_field->add_fields( $image_field->get_fields() );

        return [
            $instructions_field,
            $rows_field,
        ];
    }
}
