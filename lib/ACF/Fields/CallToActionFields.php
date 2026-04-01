<?php
/**
 * Copyright (c) 2021. Geniem Oy
 */

namespace TMS\Theme\MuumiB2B\ACF\Fields;

use Geniem\ACF\Exception;
use Geniem\ACF\Field;
use TMS\Theme\MuumiB2B\Logger;

/**
 * Class CallToActionFields
 *
 * @package TMS\Theme\MuumiB2B\ACF\Fields
 */
class CallToActionFields extends Field\Group {

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
            'rows'           => [
                'label'        => 'Nostot',
                'instructions' => '',
                'button'       => 'Lisää rivi',
            ],
            'image'          => [
                'label'        => 'Kuva',
                'instructions' => '',
            ],
            'subtitle'          => [
                'label'        => 'Apuotsikko',
                'instructions' => '',
            ],
            'title'          => [
                'label'        => 'Otsikko',
                'instructions' => '',
            ],
            'description'    => [
                'label'        => 'Teksti',
                'instructions' => '',
            ],
            'link'           => [
                'label'        => 'Linkki',
                'instructions' => '',
            ],
        ];

        $key = $this->get_key();

        $rows_field = ( new Field\Repeater( $strings['rows']['label'] ) )
            ->set_key( "{$key}_rows" )
            ->set_name( 'rows' )
            ->set_min( 1 )
            ->set_max( 6 )
            ->set_layout( 'block' )
            ->set_button_label( $strings['rows']['button'] )
            ->set_instructions( $strings['rows']['instructions'] );

        $layout_title_field = ( new Field\Text( $strings['title']['label'] ) )
            ->set_key( "{$key}_layout_title" )
            ->set_name( 'layout_title' )
            ->redipress_include_search()
            ->set_instructions( $strings['title']['instructions'] );

        $image_field = ( new Field\Image( $strings['image']['label'] ) )
            ->set_key( "{$key}_numbers" )
            ->set_name( 'image' )
            ->set_wrapper_width( 50 )
            ->set_instructions( $strings['image']['instructions'] );

        $subtitle_field = ( new Field\Text( $strings['subtitle']['label'] ) )
            ->set_key( "{$key}_subtitle" )
            ->set_name( 'subtitle' )
            ->set_wrapper_width( 50 )
            ->redipress_include_search()
            ->set_instructions( $strings['subtitle']['instructions'] );

        $title_field = ( new Field\Text( $strings['title']['label'] ) )
            ->set_key( "{$key}_title" )
            ->set_name( 'title' )
            ->set_wrapper_width( 50 )
            ->redipress_include_search()
            ->set_instructions( $strings['title']['instructions'] );

        $description_field = ( new Field\Wysiwyg( $strings['description']['label'] ) )
            ->set_key( "{$key}_description" )
            ->set_name( 'description' )
            ->set_toolbar( [ 'bold', 'italic' ] )
            ->disable_media_upload()
            ->redipress_include_search()
            ->set_instructions( $strings['description']['instructions'] );

        $link_field = ( new Field\Link( $strings['link']['label'] ) )
            ->set_key( "{$key}_link" )
            ->set_name( 'link' )
            ->set_wrapper_width( 50 )
            ->set_instructions( $strings['link']['instructions'] );

        $rows_field->add_fields( [
            $image_field,
            $subtitle_field,
            $title_field,
            $description_field,
            $link_field,
        ] );

        return [
            $layout_title_field,
            $rows_field,
        ];
    }
}
