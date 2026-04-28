<?php
namespace TMS\Theme\MuumiB2B\ACF;

use Geniem\ACF\Field;

/**
 * Class ComponentCommonFields
 *
 * Adds shared fields to all ACF flexible component layouts.
 */
class ComponentCommonFields {

    /**
     * ComponentCommonFields constructor.
     */
    public function __construct() {
        \add_filter(
            'tms/acf/layout/common/fields',
            \Closure::fromCallable( [ $this, 'add_common_fields_filter' ] ),
            10,
            3
        );
    }

    /**
     * Filter callback wrapper.
     *
     * @param array  $fields   Existing layout fields.
     * @param string $key      Full layout key.
     * @param string $base_key Layout base key.
     *
     * @return array
     */
    public function add_common_fields_filter( array $fields, string $key, string $base_key ) : array {
        return self::add_common_fields( $fields, $key, $base_key );
    }

    /**
     * Add shared fields for all component layouts.
     *
     * @param array  $fields   Existing layout fields.
     * @param string $key      Full layout key.
     * @param string $base_key Layout base key.
     *
     * @return array
     */
    public static function add_common_fields( array $fields, string $key, string $base_key = '' ) : array {
        $strings = [
            'background_color'        => [
                'label'        => 'Taustaväri',
                'instructions' => '',
            ],
            'before_background_color' => [
                'label'        => 'Edellisen komponentin taustaväri',
                'instructions' => 'Tätä väriä käytetään yhdistämään komponenttien välisien muotojen taustat.',
            ],
            'next_background_color'   => [
                'label'        => 'Seuraavan komponentin taustaväri',
                'instructions' => 'Tätä väriä käytetään yhdistämään komponenttien välisien muotojen taustat.',
            ],
            'shape_top'               => [
                'label'        => 'Muoto yläreunaan',
                'instructions' => 'Valitse muoto käytettäväksi komponentille',
            ],
            'shape_bottom'            => [
                'label'        => 'Muoto alareunaan',
                'instructions' => 'Valitse muoto käytettäväksi komponentille',
            ],
        ];

        $background_color = ( new Field\Select( $strings['background_color']['label'] ) )
            ->set_key( "{$key}_common_background_color" )
            ->set_name( 'common_background_color' )
            ->set_instructions( $strings['background_color']['instructions'] )
            ->set_choices( [
                'has-background-white'      => 'Valkoinen',
                'has-background-yellow'     => 'Keltainen',
                'has-background-magenta'    => 'Magenta',
                'has-background-pink'       => 'Pinkki',
                'has-background-light-pink' => 'Vaaleanpunainen',
                'has-background-orange'     => 'Oranssi',
                'has-background-blue'       => 'Sininen',
                'has-background-bluegray'   => 'Siniharmaa',
                'has-background-gray'       => 'Harmaa',
            ] )
            ->set_default_value( 'has-background-white' );

        $before_background_color = ( new Field\Select( $strings['before_background_color']['label'] ) )
            ->set_key( "{$key}_common_before_background_color" )
            ->set_name( 'common_before_background_color' )
            ->set_instructions( $strings['before_background_color']['instructions'] )
            ->set_choices( [
                'before-has-background-white'      => 'Valkoinen',
                'before-has-background-yellow'     => 'Keltainen',
                'before-has-background-magenta'    => 'Magenta',
                'before-has-background-pink'       => 'Pinkki',
                'before-has-background-light-pink' => 'Vaaleanpunainen',
                'before-has-background-orange'     => 'Oranssi',
                'before-has-background-blue'       => 'Sininen',
                'before-has-background-bluegray'   => 'Siniharmaa',
                'before-has-background-gray'       => 'Harmaa',
            ] )
            ->set_default_value( 'before-has-background-white' );

        $next_background_color = ( new Field\Select( $strings['next_background_color']['label'] ) )
            ->set_key( "{$key}_common_next_background_color" )
            ->set_name( 'common_next_background_color' )
            ->set_instructions( $strings['next_background_color']['instructions'] )
            ->set_choices( [
                'next-has-background-white'      => 'Valkoinen',
                'next-has-background-yellow'     => 'Keltainen',
                'next-has-background-magenta'    => 'Magenta',
                'next-has-background-pink'       => 'Pinkki',
                'next-has-background-light-pink' => 'Vaaleanpunainen',
                'next-has-background-orange'     => 'Oranssi',
                'next-has-background-blue'       => 'Sininen',
                'next-has-background-bluegray'   => 'Siniharmaa',
                'next-has-background-gray'       => 'Harmaa',
            ] )
            ->set_default_value( 'next-has-background-white' );

        $shape_top_field = ( new Field\Select( $strings['shape_top']['label'] ) )
            ->set_key( "{$key}_common_shape_top" )
            ->set_name( 'common_shape_top' )
            ->set_instructions( $strings['shape_top']['instructions'] )
            ->set_choices( [
                'shape-none'                                             => 'Ei muotoa',
                'border-shape border-shape--wave-top'                    => 'Leveä aalto',
                'border-shape border-shape--wave-top-reverse'            => 'Leveä aalto käännettynä',
                'border-shape border-shape--wave-top-character-reverse'  => 'Leveä aalto käännettynä ja Hahmo',
            ] )
            ->set_default_value( 'shape-none' );

        $shape_bottom_field = ( new Field\Select( $strings['shape_bottom']['label'] ) )
            ->set_key( "{$key}_common_shape_bottom" )
            ->set_name( 'common_shape_bottom' )
            ->set_instructions( $strings['shape_bottom']['instructions'] )
            ->set_choices( [
                'shape-none'                                          => 'Ei muotoa',
                'border-shape border-shape--wave-bottom'              => 'Leveä aalto',
                'border-shape border-shape--wave-bottom-reverse'      => 'Leveä aalto käännettynä',
                'border-shape border-shape--sea-waves-bottom'         => 'Aallokko',
                'border-shape border-shape--sea-waves-bottom-reverse' => 'Aallokko käännettynä',
            ] )
            ->set_default_value( 'shape-none' );

        return array_merge( $fields, [
            $background_color,
            $before_background_color,
            $shape_top_field,
            $next_background_color,
            $shape_bottom_field,
        ] );
    }
}

( new ComponentCommonFields() );
