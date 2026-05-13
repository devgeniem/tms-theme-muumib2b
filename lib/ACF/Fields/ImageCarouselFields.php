<?php


namespace TMS\Theme\MuumiB2B\ACF\Fields;

use Geniem\ACF\Exception;
use Geniem\ACF\Field;
use TMS\Theme\MuumiB2B\Logger;

/**
 * Class ImageCarouselFields
 *
 * @package TMS\Theme\MuumiB2B\ACF\Fields
 */
class ImageCarouselFields extends Field\Group {

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
            'title'            => [
                'label'        => 'Otsikko',
                'instructions' => '',
            ],
            'description'      => [
                'label'        => 'Kuvaus',
                'instructions' => '',
            ],
            'rows'             => [
                'label'        => 'Kuvakaruselli',
                'instructions' => 'Kuvakaruselli, jossa näytetään yksi kuva kerrallaan.',
                'button'       => 'Lisää rivi',
            ],
            'image'            => [
                'label'        => 'Kuva',
                'instructions' => '',
            ],
            'caption'          => [
                'label'        => 'Vapaaehtoinen kuvateksti',
                'instructions' => '',
            ],
            'background_color' => [
                'label'        => 'Taustaväri',
                'instructions' => '',
            ],
        ];

        $key = $this->get_key();

        $title_field = ( new Field\Text( $strings['title']['label'] ) )
            ->set_key( "{$key}_title" )
            ->set_name( 'title' )
            ->set_instructions( $strings['title']['instructions'] );

        $description_field = ( new Field\ExtendedWysiwyg( $strings['description']['label'] ) )
            ->set_key( "{$key}_description" )
            ->set_name( 'description' )
            ->set_tabs( 'visual' )
            ->set_toolbar(
                [
                    'bold',
                    'italic',
                    'link',
                    'pastetext',
                    'removeformat',
                ]
            )
            ->disable_media_upload()
            ->set_height( 100 )
            ->set_instructions( $strings['description']['instructions'] );

        $rows_field = ( new Field\Repeater( $strings['rows']['label'] ) )
            ->set_key( "{$key}_rows" )
            ->set_name( 'rows' )
            ->set_min( 2 )
            ->set_max( 20 )
            ->set_layout( 'block' )
            ->set_button_label( $strings['rows']['button'] )
            ->set_instructions( $strings['rows']['instructions'] );

        $image_field = ( new Field\Image( $strings['image']['label'] ) )
            ->set_key( "{$key}_image" )
            ->set_name( 'image' )
            ->set_required()
            ->set_wrapper_width( 40 )
            ->set_default_value( null )
            ->set_instructions( $strings['image']['instructions'] );

        $caption_field = ( new Field\ExtendedWysiwyg( $strings['caption']['label'] ) )
            ->set_key( "{$key}_caption" )
            ->set_name( 'caption' )
            ->set_tabs( 'visual' )
            ->set_toolbar( [ 'bold', 'italic', 'link' ] )
            ->set_wrapper_width( 60 )
            ->set_height( 100 )
            ->disable_media_upload()
            ->set_instructions( $strings['caption']['instructions'] );

        $background_color = ( new Field\Select( $strings['background_color']['label'] ) )
            ->set_key( "{$key}_common_background_color" )
            ->set_name( 'common_background_color' )
            ->set_instructions( $strings['background_color']['instructions'] )
            ->set_choices( \apply_filters( 'tms/acf/choices/background/has', [] ) )
            ->set_default_value( 'has-background-white' );

        $rows_field->add_fields( [
            $image_field,
        ] );

        return [
            $title_field,
            $description_field,
            $rows_field,
            $background_color,
        ];
    }
}
