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
                'label'             => 'Kuva',
                'instructions' => '',
            ],
            'width' => [
                'label'             => 'Leveys',
                'instructions' => '',
            ],
            'next_background_color' => [
                'label'        => 'Seuraavan komponentin taustaväri',
                'instructions' => 'Tätä väriä käytetään yhdistämään komponenttien välisien muotojen taustat.',
            ],
            'shape_bottom'         => [
                'label'        => 'Muoto alareunaan',
                'instructions' => 'Valitse muoto käytettäväksi komponentille',
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

        $shape_bottom_field = ( new Field\Select( $strings['shape_bottom']['label'] ) )
            ->set_key( "{$key}_common_shape_bottom" )
            ->set_name( 'common_shape_bottom' )
            ->set_instructions( $strings['shape_bottom']['instructions'] )
            ->set_choices( [
                'shape-none'                                          => 'Ei muotoa',
                'border-shape border-shape--wave-bottom'              => 'Leveä aalto',
                'border-shape border-shape--wave-bottom-reverse'      => 'Leveä aalto käännettynä (korkea puoli vasemmalla)',
                'border-shape border-shape--sea-waves-bottom'         => 'Aallokko',
                'border-shape border-shape--sea-waves-bottom-reverse' => 'Aallokko käännettynä',
            ] )
            ->set_default_value( 'shape-none' );

        $next_background_color = ( new Field\Select( $strings['next_background_color']['label'] ) )
            ->set_key( "{$key}_common_next_background_color" )
            ->set_name( 'common_next_background_color' )
            ->set_instructions( $strings['next_background_color']['instructions'] )
            ->set_choices( \apply_filters( 'tms/acf/choices/background/next', [] ) )
            ->set_default_value( 'next-has-background-white' );

        return [
            $image_field,
            $width_field,
            $shape_bottom_field,
            $next_background_color,
        ];
    }
}
