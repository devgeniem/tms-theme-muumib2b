<?php
namespace TMS\Theme\MuumiB2B\ACF\Fields;

use Geniem\ACF\Exception;
use Geniem\ACF\Field;
use TMS\Theme\MuumiB2B\Logger;

/**
 * Class RollingTextFields
 *
 * @package TMS\Theme\MuumiB2B\ACF\Fields
 */
class RollingTextFields extends Field\Group {

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
            'rows_right'       => [
                'label'        => 'Yksittäiset tekstit',
                'instructions' => 'Oikealle rullaavat tekstit.',
                'button'       => 'Lisää uusi',
            ],
            'rows_left'        => [
                'label'        => 'Yksittäiset tekstit',
                'instructions' => 'Vasemmalle rullaavat tekstit.',
                'button'       => 'Lisää uusi',
            ],
            'text'             => [
                'label'        => 'Teksti',
                'instructions' => '',
            ],
            'background_color' => [
                'label'        => 'Taustaväri',
                'instructions' => '',
            ],
        ];

        $key = $this->get_key();

        $rows_right_field = ( new Field\Repeater( $strings['rows_right']['label'] ) )
            ->set_key( "{$key}_rows_right" )
            ->set_name( 'rows_right' )
            ->set_min( 2 )
            ->set_layout( 'block' )
            ->set_button_label( $strings['rows_right']['button'] )
            ->set_instructions( $strings['rows_right']['instructions'] );

        $rows_left_field = ( new Field\Repeater( $strings['rows_left']['label'] ) )
            ->set_key( "{$key}_rows_left" )
            ->set_name( 'rows_left' )
            ->set_min( 2 )
            ->set_layout( 'block' )
            ->set_button_label( $strings['rows_left']['button'] )
            ->set_instructions( $strings['rows_left']['instructions'] );

        $text_field = ( new Field\Text( $strings['text']['label'] ) )
            ->set_key( "{$key}_text" )
            ->set_name( 'text' )
            ->set_instructions( $strings['text']['instructions'] );

        $background_color = ( new Field\Select( $strings['background_color']['label'] ) )
            ->set_key( "{$key}_common_background_color" )
            ->set_name( 'common_background_color' )
            ->set_instructions( $strings['background_color']['instructions'] )
            ->set_choices( [
                'has-background-white'    => 'Valkoinen',
                'has-background-yellow'   => 'Keltainen',
                'has-background-magenta'  => 'Magenta',
                'has-background-orange'   => 'Oranssi',
                'has-background-blue'     => 'Sininen',
                'has-background-bluegray' => 'Siniharmaa',
            ] )
            ->set_default_value( 'has-background-white' );

        $rows_right_field->add_fields( [
            $text_field,
        ] );

        $rows_left_field->add_fields( [
            $text_field,
        ] );

        return [
            $rows_right_field,
            $rows_left_field,
            $background_color,
        ];
    }
}
