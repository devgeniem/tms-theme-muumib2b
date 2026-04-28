<?php


namespace TMS\Theme\MuumiB2B\ACF\Fields\Settings;

use Geniem\ACF\Exception;
use Geniem\ACF\Field;
use Geniem\ACF\Field\Tab;
use TMS\Theme\MuumiB2B\Logger;

/**
 * Class PasswordPageSettingsTab
 *
 * @package TMS\Theme\MuumiB2B\ACF\Tab
 */
class PasswordPageSettingsTab extends Tab {

    /**
     * Where should the tab switcher be located
     *
     * @var string
     */
    protected $placement = 'left';

    /**
     * Tab strings.
     *
     * @var array
     */
    protected $strings = [
        'tab'              => 'Salasanasuojattu sivu',
        'hero_img'        => [
            'title'        => 'Salasanasuojatun sivun hero-kuva',
            'instructions' => '',
        ],
        'info_text'        => [
            'title'        => 'Teksti salasanasuojatun sivun yläosaan',
            'instructions' => '',
        ],
    ];

    /**
     * The constructor for tab.
     *
     * @param string $label Label.
     * @param null   $key   Key.
     * @param null   $name  Name.
     */
    public function __construct( $label = '', $key = null, $name = null ) { // phpcs:ignore
        $label = $this->strings['tab'];

        parent::__construct( $label );

        $this->sub_fields( $key );
    }

    /**
     * Register sub fields.
     *
     * @param string $key Field tab key.
     */
    public function sub_fields( $key ) {
        $strings = $this->strings;

        try {
            $hero_img_field = ( new Field\Image( $strings['hero_img']['title'] ) )
                ->set_key( "{$key}_password_page_hero_img" )
                ->set_name( 'password_page_hero_img' )
                ->set_return_format( 'id' )
                ->set_instructions( $strings['hero_img']['instructions'] );

            $info_text_field = ( new Field\Text( $strings['info_text']['title'] ) )
                ->set_key( "{$key}_password_page_info_text" )
                ->set_name( 'password_page_info_text' )
                ->set_instructions( $strings['info_text']['instructions'] );

            $this->add_fields( [
                $hero_img_field,
                $info_text_field,
            ] );
        }
        catch ( Exception $e ) {
            ( new Logger() )->error( $e->getMessage(), $e->getTrace() );
        }
    }
}
