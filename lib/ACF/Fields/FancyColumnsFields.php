<?php
namespace TMS\Theme\MuumiB2B\ACF\Fields;

use Geniem\ACF\Exception;
use Geniem\ACF\Field;
use TMS\Theme\MuumiB2B\Logger;

/**
 * Class FancyColumnsFields
 *
 * @package TMS\Theme\MuumiB2B\ACF\Fields
 */
class FancyColumnsFields extends Field\Group {

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
            'title'       => [
                'label'        => 'Otsikko',
                'instructions' => '',
            ],
            'description' => [
                'label'        => 'Teksti',
                'instructions' => '',
            ],
            'button'      => [
                'label'        => 'Painike',
                'instructions' => '',
            ],
            'image'       => [
                'label'        => 'Kuva',
                'instructions' => '',
            ],
        ];

        $key = $this->get_key();

        $title_field = ( new Field\Text( $strings['title']['label'] ) )
            ->set_key( "{$key}_title" )
            ->set_name( 'title' )
            ->redipress_include_search()
            ->set_instructions( $strings['title']['instructions'] );

        $description_field = ( new Field\Wysiwyg( $strings['description']['label'] ) )
            ->set_key( "{$key}_description" )
            ->set_name( 'description' )
            ->set_toolbar( [ 'bold', 'italic' ] )
            ->disable_media_upload()
            ->redipress_include_search()
            ->set_instructions( $strings['description']['instructions'] );

        $button_field = ( new Field\Link( $strings['button']['label'] ) )
            ->set_key( "{$key}_button" )
            ->set_name( 'button' )
            ->set_instructions( $strings['button']['instructions'] );

        $image_field = ( new Field\Image( $strings['image']['label'] ) )
            ->set_key( "{$key}_image" )
            ->set_name( 'image' )
            ->set_instructions( $strings['image']['instructions'] );

        return [
            $title_field,
            $description_field,
            $button_field,
            $image_field,
        ];
    }
}
