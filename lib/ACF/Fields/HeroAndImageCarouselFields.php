<?php


namespace TMS\Theme\MuumiB2B\ACF\Fields;

use Geniem\ACF\ConditionalLogicGroup;
use Geniem\ACF\Exception;
use Geniem\ACF\Field;
use TMS\Theme\MuumiB2B\Logger;

/**
 * Class HeroAndImageCarouselFields
 *
 * @package TMS\Theme\MuumiB2B\ACF\Fields
 */
class HeroAndImageCarouselFields extends Field\Group {

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
     * Get component sub fields.
     *
     * @return array
     * @throws Exception In case of invalid ACF option.
     */
    protected function sub_fields() : array {
        $strings = [
            'instructions'            => [
                'label'        => 'Komponentin tiedot',
                'instructions' => 'Hero, johon on yhdistettynä kuvakaruselli.
                Käytössä vain The door is always open-näyttelyn sivupohjalla.
                Komponentin taustavärin yhteyteen tulee automaattisesti taustakuvitukset.
                Kuvakarusellin alaosaan tulee automaattisesti pinkki aalto-muoto, joten seuraavan komponentin taustavärin tulee olla pinkki.',
            ],
        ];

        $key = $this->get_key();

        $instructions_field = ( new Field\Message( $strings['instructions']['label'] ) )
            ->set_key( "{$key}_hero_and_image_carousel_instructions" )
            ->set_name( 'hero_and_image_carousel_instructions' )
            ->set_message( $strings['instructions']['instructions'] );

        $heading_style_field = ( new Field\Select( 'Otsikon tyyli' ) )
            ->set_key( "{$key}_heading_style" )
            ->set_name( 'heading_style' )
            ->set_choices( [
                'layout-right' => 'Otsikko oikealla',
                'layout-wide'  => 'Leveämpi otsikko',
            ] )
            ->set_default_value( 'layout-right' )
            ->set_wrapper_width( 100 );

        $hero_field = new HeroFields(
            'Hero',
            "{$key}_hero",
            'hero'
        );

        $wide_layout_rule_group = ( new ConditionalLogicGroup() )
            ->add_rule( $heading_style_field, '==', 'layout-wide' );

        if ( isset( $hero_field->sub_fields['subtitle'] ) ) {
            $hero_field->sub_fields['subtitle']->add_conditional_logic( $wide_layout_rule_group );
        }

        $top_description_field = ( new Field\Textarea( 'Yläosan kuvausteksti' ) )
            ->set_key( "{$key}_hero_top_description" )
            ->set_name( 'top_description' )
            ->set_rows( 3 )
            ->set_new_lines( '' )
            ->set_wrapper_width( 100 );
        $top_description_field->add_conditional_logic( $wide_layout_rule_group );

        $description_heading_field = ( new Field\Text( 'Kuvauksen otsikko' ) )
            ->set_key( "{$key}_hero_description_heading" )
            ->set_name( 'description_heading' )
            ->set_wrapper_width( 100 );
        $description_heading_field->add_conditional_logic( $wide_layout_rule_group );

        $hero_field->sub_fields['top_description'] = $top_description_field;
        $hero_field->sub_fields['description_heading'] = $description_heading_field;

        unset( $hero_field->sub_fields['hero_instructions'] );
        unset( $hero_field->sub_fields['image'] );
        unset( $hero_field->sub_fields['link'] );
        unset( $hero_field->sub_fields['use_button_icon'] );
        unset( $hero_field->sub_fields['button_icon'] );
        unset( $hero_field->sub_fields['hero_img_position'] );
        unset( $hero_field->sub_fields['hero_img_object_fit'] );
        unset( $hero_field->sub_fields['hero_img_shape'] );
        unset( $hero_field->sub_fields['common_background_color'] );
        unset( $hero_field->sub_fields['common_next_background_color'] );
        unset( $hero_field->sub_fields['common_shape_bottom'] );

        // Define field order for editor UX in this layout variant.
        $ordered_hero_sub_fields = [];
        $hero_field_order = [
            'full_size_image',
            'subtitle',
            'title',
            'top_description',
            'description_heading',
            'description',
        ];

        foreach ( $hero_field_order as $hero_field_key ) {
            if ( isset( $hero_field->sub_fields[ $hero_field_key ] ) ) {
                $ordered_hero_sub_fields[ $hero_field_key ] = $hero_field->sub_fields[ $hero_field_key ];
            }
        }

        $hero_field->sub_fields = $ordered_hero_sub_fields;

        $image_carousel_field = new ImageCarouselFields(
            'Kuvakaruselli',
            "{$key}_image_carousel",
            'image_carousel'
        );

        unset( $image_carousel_field->sub_fields['title'] );
        unset( $image_carousel_field->sub_fields['description'] );
        unset( $image_carousel_field->sub_fields['common_background_color'] );

        return [
            $instructions_field,
            $heading_style_field,
            $hero_field,
            $image_carousel_field,
        ];
    }
}