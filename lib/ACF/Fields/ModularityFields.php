<?php


namespace TMS\Theme\MuumiB2B\ACF\Fields;

use Geniem\ACF\Field;
use TMS\Theme\MuumiB2B\Logger;

/**
 * Class ModularityFields
 *
 * @package TMS\Theme\MuumiB2B\ACF\Fields
 */
class ModularityFields extends \Geniem\ACF\Field\Group {

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
            'instructions'            => [
                'label'        => 'Komponentin tiedot',
                'instructions' => 'Komponentin yläosassa on aina valkoinen taustaväri, ja keskiosasta alkaa automaattisesti leveä aaltomuoto.
                Voit asettaa aaltomuodon alaosan värin "Seuraavan komponentin taustaväri"-kentässä.',
            ],
            'title'                   => [
                'label'        => 'Otsikko',
                'instructions' => '',
            ],
            'text'                    => [
                'label'        => 'Teksti',
                'instructions' => '',
            ],
            'repeater'                => [
                'label'        => 'Modulaarikuvitukset',
                'instructions' => '',
            ],
            'button_text'             => [
                'label'        => 'Painikkeen teksti',
                'instructions' => '',
            ],
            'image'                   => [
                'label'        => 'Kuvitus',
                'instructions' => '',
            ],
            'before_background_color' => [
                'label'        => 'Edellisen komponentin taustaväri',
                'instructions' => 'Tätä väriä käytetään yhdistämään komponenttien välisien muotojen taustat.',
            ],
            'shape_top'               => [
                'label'        => 'Muoto yläreunaan',
                'instructions' => 'Valitse muoto käytettäväksi komponentille',
            ],
            'next_background_color'   => [
                'label'        => 'Seuraavan komponentin taustaväri',
                'instructions' => 'Tätä väriä käytetään yhdistämään komponenttien välisien muotojen taustat.',
            ],
        ];

        $key = $this->get_key();

        $instructions_field = ( new Field\Message( $strings['instructions']['label'] ) )
            ->set_message( $strings['instructions']['instructions'] );

        $title_field = ( new Field\Text( $strings['title']['label'] ) )
            ->set_key( "{$key}_title" )
            ->set_name( 'title' )
            ->set_required()
            ->set_wrapper_width( 50 )
            ->set_instructions( $strings['title']['instructions'] );

        $text_field = ( new Field\Textarea( $strings['text']['label'] ) )
            ->set_key( "{$key}_text" )
            ->set_name( 'text' )
            ->set_required()
            ->set_wrapper_width( 50 )
            ->set_instructions( $strings['text']['instructions'] );

        $repeater_field = ( new Field\Repeater( $strings['repeater']['label'] ) )
            ->set_key( "{$key}_repeater" )
            ->set_name( 'repeater' )
            ->set_instructions( $strings['repeater']['instructions'] );


        $button_text_field = ( new Field\Text( $strings['button_text']['label'] ) )
            ->set_key( "{$key}_button_text" )
            ->set_name( 'button_text' )
            ->set_instructions( $strings['button_text']['instructions'] );

        $image_field = ( new Field\Image( $strings['image']['label'] ) )
            ->set_key( "{$key}_image" )
            ->set_name( 'image' )
            ->set_return_format( 'id' )
            ->set_instructions( $strings['image']['instructions'] );

        $before_background_color = ( new Field\Select( $strings['before_background_color']['label'] ) )
            ->set_key( "{$key}_common_before_background_color" )
            ->set_name( 'common_before_background_color' )
            ->set_instructions( $strings['before_background_color']['instructions'] )
            ->set_wrapper_width( 50 )
            ->set_choices( [
                'before-has-background-white'      => 'Valkoinen',
                'before-has-background-yellow'     => 'Keltainen',
                'before-has-background-green'      => 'Vihreä',
                'before-has-background-lightgreen' => 'Vaaleanvihreä',
                'before-has-background-magenta'    => 'Magenta',
                'before-has-background-pink'       => 'Pinkki',
                'before-has-background-light-pink' => 'Vaaleanpunainen',
                'before-has-background-orange'     => 'Oranssi',
                'before-has-background-blue'       => 'Sininen',
                'before-has-background-bluegray'   => 'Siniharmaa',
                'before-has-background-gray'       => 'Harmaa',
            ] )
            ->set_default_value( 'before-has-background-white' );

        $shape_top_field = ( new Field\Select( $strings['shape_top']['label'] ) )
            ->set_key( "{$key}_common_shape_top" )
            ->set_name( 'common_shape_top' )
            ->set_instructions( $strings['shape_top']['instructions'] )
            ->set_wrapper_width( 50 )
            ->set_choices( [
                'shape-none'                                             => 'Ei muotoa',
                'border-shape border-shape--wave-top'                    => 'Leveä aalto',
                'border-shape border-shape--wave-top-reverse'            => 'Leveä aalto käännettynä (korkea puoli vasemmalla)',
                'border-shape border-shape--wave-top-character-reverse'  => 'Leveä aalto käännettynä ja Hahmo',
            ] )
            ->set_default_value( 'shape-none' );

        $next_background_color = ( new Field\Select( $strings['next_background_color']['label'] ) )
            ->set_key( "{$key}_common_next_background_color" )
            ->set_name( 'common_next_background_color' )
            ->set_instructions( $strings['next_background_color']['instructions'] )
            ->set_choices( [
                'next-has-background-white'      => 'Valkoinen',
                'next-has-background-yellow'     => 'Keltainen',
                'next-has-background-green'      => 'Vihreä',
                'next-has-background-lightgreen' => 'Vaaleanvihreä',
                'next-has-background-magenta'    => 'Magenta',
                'next-has-background-pink'       => 'Pinkki',
                'next-has-background-light-pink' => 'Vaaleanpunainen',
                'next-has-background-orange'     => 'Oranssi',
                'next-has-background-blue'       => 'Sininen',
                'next-has-background-bluegray'   => 'Siniharmaa',
                'next-has-background-gray'       => 'Harmaa',
            ] )
            ->set_default_value( 'next-has-background-white' );

        $repeater_field->add_fields( [
            $button_text_field,
            $image_field,
        ] );

        return [
            $instructions_field,
            $title_field,
            $text_field,
            $repeater_field,
            $before_background_color,
            $shape_top_field,
            $next_background_color,
        ];
    }
}
