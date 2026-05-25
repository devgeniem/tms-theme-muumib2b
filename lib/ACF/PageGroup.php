<?php


namespace TMS\Theme\MuumiB2B\ACF;

use Geniem\ACF\Exception;
use Geniem\ACF\Group;
use Geniem\ACF\RuleGroup;
use Geniem\ACF\Field;
use TMS\Theme\MuumiB2B\ACF\Layouts;
use TMS\Theme\MuumiB2B\Logger;
use TMS\Theme\MuumiB2B\PostType;

/**
 * Class PageGroup
 *
 * @package TMS\Theme\MuumiB2B\ACF
 */
class PageGroup {

    /**
     * PageGroup constructor.
     */
    public function __construct() {
        \add_action(
            'init',
            \Closure::fromCallable( [ $this, 'register_fields' ] ),
            100
        );

        \add_action(
            'init',
            \Closure::fromCallable( [ $this, 'register_page_settings' ] ),
            100
        );

        // $this->add_anchor_fields();
    }

    /**
     * Register fields
     */
    protected function register_fields() : void {
        try {
            $group_title = _x( 'Page Components', 'theme ACF', 'tms-theme-muumib2b' );
            $key         = 'fg_page_components';

            $field_group = ( new Group( $group_title ) )
                ->set_key( $key );

            $rules = \apply_filters(
                'tms/acf/group/' . $key . '/rules',
                [
                    [
                        'param'    => 'post_type',
                        'operator' => '==',
                        'value'    => PostType\Page::SLUG,
                    ],
                    [
                        'param'    => 'page_template',
                        'operator' => '!=',
                        'value'    => \PageFrontPage::TEMPLATE,
                    ],
                    [
                        'param'    => 'page_template',
                        'operator' => '!=',
                        'value'    => \PageExhibitionOne::TEMPLATE,
                    ],
                    [
                        'param'    => 'page_template',
                        'operator' => '!=',
                        'value'    => \PageExhibitionTwo::TEMPLATE,
                    ],
                    [
                        'param'    => 'page_template',
                        'operator' => '!=',
                        'value'    => \PageExhibitionThree::TEMPLATE,
                    ],
                    [
                        'param'    => 'page_type',
                        'operator' => '!=',
                        'value'    => 'posts_page',
                    ],
                ]
            );

            $rule_group = new RuleGroup();

            foreach ( $rules as $rule ) {
                $rule_group->add_rule(
                    $rule['param'],
                    $rule['operator'],
                    $rule['value'],
                );
            }

            $field_group
                ->add_rule_group( $rule_group )
                ->set_position( 'normal' )
                ->set_hidden_elements(
                    [
                        'discussion',
                        'comments',
                        'format',
                        'send-trackbacks',
                    ]
                );

            $field_group->add_fields(
                \apply_filters(
                    'tms/acf/group/' . $field_group->get_key() . '/fields',
                    [
                        $this->get_components_field( $field_group->get_key() ),
                    ]
                )
            );

            $field_group = \apply_filters(
                'tms/acf/group/' . $field_group->get_key(),
                $field_group
            );

            $field_group->register();
        }
        catch ( Exception $e ) {
            ( new Logger() )->error( $e->getMessage(), $e->getTraceAsString() );
        }
    }

    /**
     * Register page settings fields
     */
    protected function register_page_settings() : void {
        try {
            $group_title = \_x( 'Page settings', 'theme ACF', 'tms-theme-muumib2b' );
            $key = 'fg_page_settings';

            $field_group = ( new Group( $group_title ) )
                ->set_key( $key );

            $rules = \apply_filters(
                'tms/acf/group/' . $key . '/rules',
                [
                    [
                        'param'    => 'post_type',
                        'operator' => '==',
                        'value'    => PostType\Page::SLUG,
                    ],
                    [
                        'param'    => 'page_template',
                        'operator' => '!=',
                        'value'    => \PageFrontPage::TEMPLATE,
                    ],
                    [
                        'param'    => 'page_template',
                        'operator' => '!=',
                        'value'    => \PageExhibitionOne::TEMPLATE,
                    ],
                    [
                        'param'    => 'page_template',
                        'operator' => '!=',
                        'value'    => \PageExhibitionTwo::TEMPLATE,
                    ],
                    [
                        'param'    => 'page_template',
                        'operator' => '!=',
                        'value'    => \PageExhibitionThree::TEMPLATE,
                    ],
                    [
                        'param'    => 'page_type',
                        'operator' => '!=',
                        'value'    => 'posts_page',
                    ],
                ]
            );

            $rule_group = new RuleGroup();

            foreach ( $rules as $rule ) {
                $rule_group->add_rule(
                    $rule['param'],
                    $rule['operator'],
                    $rule['value'],
                );
            }

            $field_group
                ->add_rule_group( $rule_group )
                ->set_position( 'side' );

            $field_group = \apply_filters(
                'tms/acf/group/' . $field_group->get_key(),
                $field_group
            );

            $field_group->register();
        }
        catch ( Exception $e ) {
            ( new Logger() )->error( $e->getMessage(), $e->getTraceAsString() );
        }
    }

    /**
     * Get components fields
     *
     * @param string $key Field group key.
     *
     * @return Field\FlexibleContent
     * @throws Exception In case of invalid option.
     */
    protected function get_components_field( string $key ) : Field\FlexibleContent {
        $strings = [
            'components' => [
                'title'        => \_x( 'Components', 'theme ACF', 'tms-theme-muumib2b' ),
                'instructions' => '',
            ],
        ];

        $components_field = ( new Field\FlexibleContent( $strings['components']['title'] ) )
            ->set_key( "{$key}_components" )
            ->set_name( 'components' )
            ->set_button_label( 'Lisää komponentti' )
            ->set_instructions( $strings['components']['instructions'] );

        $component_layouts = \apply_filters(
            'tms/acf/field/' . $components_field->get_key() . '/layouts',
            [
                Layouts\HeroLayout::class,
                Layouts\ImageBannerLayout::class,
                Layouts\CallToActionLayout::class,
                Layouts\LinkedPagesLayout::class,
                Layouts\ContentColumnsLayout::class,
                Layouts\SmallColumnsLayout::class,
                Layouts\ImageCarouselLayout::class,
                Layouts\ImageGalleryLayout::class,
                Layouts\ImageGallerySmallLayout::class,
                Layouts\TextBlockLayout::class,
                Layouts\GravityFormLayout::class,
                Layouts\VideoLayout::class,
                Layouts\ModularityLayout::class,
                Layouts\LogoWallLayout::class,

            ],
            $key
        );

        foreach ( $component_layouts as $component_layout ) {
            $components_field->add_layout( new $component_layout( $key ) );
        }

        return $components_field;
    }

    /**
     * Add HTML-anchor field to layout fields.
     */
    private function add_anchor_fields() : void {
        $keys = [
            'hero',
            'image_banner',
            'call_to_action',
            'content_columns',
            'logo_wall',
            'map',
            'icon_links',
            'social_media',
            'image_carousel',
            'subpages' ,
            'textblock',
            'grid',
            'articles',
            'sitemap',
            'notice_banner',
            'gravityform',
            'acc_icon_links',
            'share_links',
            'countdown',
            'video',
            'modularity',
            'some_link_list',
        ];

        foreach ( $keys as $component ) {
            if ( empty( $component ) ) {
                continue;
            }

            \add_filter(
                "tms/acf/layout/fg_page_components_$component/fields",
                function ( $fields ) use ( $component ) {
                    $anchor_field = ( new Field\Text( 'HTML-ankkuri' ) )
                        ->set_key( $component . '_anchor' )
                        ->set_name( 'anchor' )
                        ->set_instructions( 'Kirjoita sana tai pari, ilman välilyöntejä,
                         luodaksesi juuri tälle lohkolle uniikki verkko-osoite, jota kutsutaan "ankkuriksi".
                         Sen avulla voit luoda linkin suoraan tähän osioon sivullasi.' );

                    array_unshift( $fields, $anchor_field );

                    return $fields;
                },
                10,
                1
            );
        }
    }
}

( new PageGroup() );
