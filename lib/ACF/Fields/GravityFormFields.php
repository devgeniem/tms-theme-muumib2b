<?php


namespace TMS\Theme\MuumiB2B\ACF\Fields;

use Geniem\ACF\Exception;
use Geniem\ACF\Field;
use TMS\Theme\MuumiB2B\Logger;

/**
 * Class GravityFormFields
 *
 * @package TMS\Theme\MuumiB2B\ACF\Fields
 */
class GravityFormFields extends Field\Group {

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
            'form' => [
                'label'        => 'Lomake',
                'instructions' => '',
            ],
            'heading' => [
                'label'        => 'Otsikko',
                'instructions' => '',
            ],
            'text' => [
                'label'        => 'Teksti',
                'instructions' => '',
            ],
        ];

        $key = $this->get_key();

        $form = ( new Field\GravityForms( $strings['form']['label'] ) )
            ->set_key( "{$key}_form" )
            ->set_name( 'form' )
            ->set_required()
            ->set_instructions( $strings['form']['instructions'] );

        $heading = ( new Field\Text( $strings['heading']['label'] ) )
            ->set_key( "{$key}_heading" )
            ->set_name( 'heading' )
            ->set_required()
            ->set_instructions( $strings['heading']['instructions'] );

        $text = ( new Field\Textarea( $strings['text']['label'] ) )
            ->set_key( "{$key}_text" )
            ->set_name( 'text' )
            ->set_new_lines( 'br' )
            ->set_required()
            ->set_instructions( $strings['text']['instructions'] );

        return [
            $heading,
            $text,
            $form,
        ];
    }
}
