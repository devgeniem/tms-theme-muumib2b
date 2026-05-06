<?php


namespace TMS\Theme\MuumiB2B\ACF\Fields;

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
        $key = $this->get_key();

        $hero_field = new HeroFields(
            'Hero',
            "{$key}_hero",
            'hero'
        );

        unset( $hero_field->sub_fields['image'] );
        unset( $hero_field->sub_fields['subheading'] );
        unset( $hero_field->sub_fields['link'] );
        unset( $hero_field->sub_fields['use_button_icon'] );
        unset( $hero_field->sub_fields['button_icon'] );
        unset( $hero_field->sub_fields['hero_img_position'] );
        unset( $hero_field->sub_fields['hero_img_shape'] );
        unset( $hero_field->sub_fields['common_background_color'] );
        unset( $hero_field->sub_fields['common_next_background_color'] );
        unset( $hero_field->sub_fields['common_shape_bottom'] );

        $image_carousel_field = new ImageCarouselFields(
            'Kuvakaruselli',
            "{$key}_image_carousel",
            'image_carousel'
        );

        unset( $image_carousel_field->sub_fields['title'] );
        unset( $image_carousel_field->sub_fields['description'] );

        return [
            $hero_field,
            $image_carousel_field,
        ];
    }
}