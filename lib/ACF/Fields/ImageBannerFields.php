<?php


namespace TMS\Theme\MuumiB2B\ACF\Fields;

use Geniem\ACF\Field;
use TMS\Theme\MuumiB2B\Logger;

/**
 * Class ImageBannerFields
 *
 * @package TMS\Theme\MuumiB2B\ACF\Fields
 */
class ImageBannerFields extends \Geniem\ACF\Field\Group {

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
     * @throws \Geniem\ACF\Exception In case of invalid ACF option.
     */
    protected function sub_fields() : array {
        $strings = [
            'image' => [
                'label'        => 'Kuva',
                'instructions' => '',
            ],
            'width' => [
                'label'        => 'Leveys',
                'instructions' => '',
            ],
        ];

        $key = $this->get_key();

        $image_field = ( new Field\Image( $strings['image']['label'] ) )
            ->set_key( "{$key}_image" )
            ->set_name( 'image' )
            ->set_required()
            ->set_wrapper_width( 50 )
            ->set_instructions( $strings['image']['instructions'] );

        $width_field = ( new Field\Radio( $strings['width']['label'] ) )
            ->set_key( "{$key}_width" )
            ->set_name( 'width' )
            ->set_choices( [
                'has-width-100' => '100%',
                'has-width-85'  => '85%',
                'has-width-60'  => '60%',
            ] )
            ->set_wrapper_width( 50 )
            ->set_instructions( $strings['width']['instructions'] );

        return [
            $image_field,
            $width_field,
        ];
    }
}
