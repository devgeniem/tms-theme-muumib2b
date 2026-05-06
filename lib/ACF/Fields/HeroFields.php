<?php


namespace TMS\Theme\MuumiB2B\ACF\Fields;

use Geniem\ACF\Field;
use TMS\Theme\MuumiB2B\Logger;

/**
 * Class HeroFields
 *
 * @package TMS\Theme\MuumiB2B\ACF\Fields
 */
class HeroFields extends \Geniem\ACF\Field\Group {

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
            'image'                 => [
                'label'        => 'Kuva',
                'instructions' => 'Heron vasempaan reunaan sijoittuva kuva.',
            ],
            'full_size_image'       => [
                'label'        => 'Heron täysikokoinen taustakuva',
                'instructions' => 'Käytä sivulle sijoittuvan kuvan sijasta koko taustan täyttävää kuvaa.',
            ],
            'video'                 => [
                'label'        => 'Videotiedosto',
                'instructions' => '',
            ],
            'video_caption'         => [
                'label'        => 'Videon tekstivastine',
                'instructions' => 'Tarkoitettu ruudunlukijoille, ei näytetä sivustolla.',
            ],
            'autoplay_video'        => [
                'label'        => 'Käynnistä video heti sivunlatauksessa',
                'instructions' => '',
            ],
            'title'                 => [
                'label'        => 'Otsikko',
                'instructions' => '',
            ],
            'subtitle'              => [
                'label'        => 'Apuotsikko',
                'instructions' => '',
            ],
            'description'           => [
                'label'        => 'Kuvaus',
                'instructions' => '',
            ],
            'link'                  => [
                'label'        => 'Painike',
                'instructions' => '',
            ],
            'align'                 => [
                'label'        => 'Tekstin tasaus',
                'instructions' => '',
            ],
            'use_box'               => [
                'label'        => 'Teksti värilaatikossa',
                'instructions' => '',
            ],
            'use_button_icon'       => [
                'label'        => 'Käytä painikkeessa ikonia',
                'instructions' => '',
            ],
            'button_icon'           => [
                'label'        => 'Painikkeen ikoni',
                'instructions' => '',
            ],
            'background_color'      => [
                'label'        => 'Taustaväri',
                'instructions' => '',
            ],
            'hero_img_position'     => [
                'label'        => 'Hero taustakuvan sijainti',
                'instructions' => '',
            ],
            'hero_img_shape'     => [
                'label'        => 'Hero kuvan muodot',
                'instructions' => 'Valitse heron kuvalle käytettävä muoto',
            ],
            'next_background_color' => [
                'label'        => 'Seuraavan komponentin taustaväri',
                'instructions' => 'Tätä väriä käytetään yhdistämään komponenttien välisien muotojen taustat.',
            ],
            'shape_bottom'          => [
                'label'        => 'Muoto alareunaan',
                'instructions' => 'Valitse muoto käytettäväksi komponentille',
            ],
        ];

        $key = $this->get_key();

        $image_field = ( new Field\Image( $strings['image']['label'] ) )
            ->set_key( "{$key}_image" )
            ->set_name( 'image' )
            ->set_return_format( 'id' )
            ->set_wrapper_width( 50 )
            ->set_instructions( $strings['image']['instructions'] );

        $full_size_image_field = ( new Field\Image( $strings['full_size_image']['label'] ) )
            ->set_key( "{$key}_full_size_image" )
            ->set_name( 'full_size_image' )
            ->set_return_format( 'id' )
            ->set_wrapper_width( 50 )
            ->set_instructions( $strings['full_size_image']['instructions'] );

        $video_field = ( new Field\File( $strings['video']['label'] ) )
            ->set_key( "{$key}_video_file" )
            ->set_name( 'video_file' )
            ->set_mime_types( [ 'mp4' ] )
            ->set_wrapper_width( 33 )
            ->set_instructions( $strings['video']['instructions'] );

        $video_caption_field = ( new Field\Textarea( $strings['video_caption']['label'] ) )
            ->set_key( "{$key}_video_caption" )
            ->set_name( 'video_caption' )
            ->set_wrapper_width( 33 )
            ->set_instructions( $strings['video_caption']['instructions'] );

        $autoplay_video_field = ( new Field\TrueFalse( $strings['autoplay_video']['label'] ) )
            ->set_key( "{$key}_autoplay_video" )
            ->set_name( 'autoplay_video' )
            ->use_ui()
            ->set_wrapper_width( 33 )
            ->set_instructions( $strings['autoplay_video']['instructions'] );

        $title_field = ( new Field\Text( $strings['title']['label'] ) )
            ->set_key( "{$key}_title" )
            ->set_name( 'title' )
            ->set_wrapper_width( 50 )
            ->set_instructions( $strings['title']['instructions'] );

        $subtitle_field = ( new Field\Text( $strings['subtitle']['label'] ) )
            ->set_key( "{$key}_subtitle" )
            ->set_name( 'subtitle' )
            ->set_wrapper_width( 50 )
            ->set_instructions( $strings['subtitle']['instructions'] );

        $description_field = ( new Field\Textarea( $strings['description']['label'] ) )
            ->set_key( "{$key}_description" )
            ->set_name( 'description' )
            ->set_rows( 4 )
            ->set_new_lines( 'wpautop' )
            ->set_wrapper_width( 100 )
            ->set_instructions( $strings['description']['instructions'] );

        $link_field = ( new Field\Link( $strings['link']['label'] ) )
            ->set_key( "{$key}_link" )
            ->set_name( 'link' )
            ->set_wrapper_width( 100 )
            ->set_instructions( $strings['link']['instructions'] );

        $align_field = ( new Field\Select( $strings['align']['label'] ) )
            ->set_key( "{$key}_align" )
            ->set_name( 'align' )
            ->set_choices( [
                'left'   => 'Vasen',
                'right'  => 'Oikea',
                'center' => 'Keskitetty',
            ] )
            ->set_default_value( 'has-text-centered-desktop' )
            ->set_wrapper_width( 30 )
            ->set_instructions( $strings['align']['instructions'] );

        $use_box_field = ( new Field\TrueFalse( $strings['use_box']['label'] ) )
            ->set_key( "{$key}_use_box" )
            ->set_name( 'use_box' )
            ->use_ui()
            ->set_wrapper_width( 30 )
            ->set_instructions( $strings['use_box']['instructions'] );

        $use_button_icon_field = ( new Field\TrueFalse( $strings['use_button_icon']['label'] ) )
            ->set_key( "{$key}_use_button_icon" )
            ->set_name( 'use_button_icon' )
            ->use_ui()
            ->set_wrapper_width( 50 )
            ->set_instructions( $strings['use_button_icon']['instructions'] );

        $button_icon_field = ( new Field\Image( $strings['button_icon']['label'] ) )
            ->set_key( "{$key}_button_icon" )
            ->set_name( 'button_icon' )
            ->set_return_format( 'id' )
            ->set_wrapper_width( 50 )
            ->set_mime_types( [ 'svg', 'png' ] )
            ->set_instructions( $strings['button_icon']['instructions'] );

        $hero_img_position_field = ( new Field\Select( $strings['hero_img_position']['label'] ) )
            ->set_key( "{$key}_hero_img_position" )
            ->set_name( 'hero_img_position' )
            ->set_choices( [
                'has-text-left'     => 'Vasen',
                'has-text-right'    => 'Oikea',
                'has-text-centered' => 'Keskitetty',
            ] )
            ->set_default_value( 'has-text-centered-desktop' )
            ->set_instructions( $strings['hero_img_position']['instructions'] );

        $hero_img_shape_field = ( new Field\Select( $strings['hero_img_shape']['label'] ) )
            ->set_key( "{$key}_hero_img_shape" )
            ->set_name( 'hero_img_shape' )
            ->set_choices( [
                'hero-image--default' => 'Ei muotoa',
                'hero-image--rounded' => 'Pyöristetyt reunat',
                'hero-image--wavy'    => 'Aaltoilevat reunat',
            ] )
            ->set_instructions( $strings['hero_img_shape']['instructions'] );;

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

        return [
            $image_field,
            $full_size_image_field,
            $subtitle_field,
            $title_field,
            $description_field,
            $link_field,
            $use_button_icon_field,
            $button_icon_field,
            $hero_img_position_field,
            $hero_img_shape_field,
            $background_color,
            $next_background_color,
            $shape_bottom_field,
        ];
    }
}
