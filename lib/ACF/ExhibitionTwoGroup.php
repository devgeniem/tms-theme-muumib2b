<?php


namespace TMS\Theme\MuumiB2B\ACF;

use Geniem\ACF\Exception;
use Geniem\ACF\Group;
use Geniem\ACF\RuleGroup;
use Geniem\ACF\Field;
use PageExhibitionOne;
use TMS\Theme\MuumiB2B\ACF\Layouts;
use TMS\Theme\MuumiB2B\Logger;

/**
 * Class ExhibitionTwoGroup
 *
 * @package TMS\Theme\MuumiB2B\ACF
 */
class ExhibitionTwoGroup {
    /**
     * Available components in key-value (component key => component class) format.
     * Filled in the construct, overridable with 'tms/acf/exhibition_two_layouts' filter.
     *
     * @var array
     */
    public array $components = [];

    /**
     * PageGroup constructor.
     */
    public function __construct() {
        \add_action(
            'init',
            \Closure::fromCallable( [ $this, 'register_fields' ] )
        );

        $this->components = \apply_filters(
            'tms/acf/exhibition_two_layouts',
            [
                'hero'            => Layouts\HeroAndImageCarouselLayout::class,
                'call_to_action'  => Layouts\CallToActionLayout::class,
                'content_columns' => Layouts\ContentColumnsLayout::class,
                'logo_wall'       => Layouts\LogoWallLayout::class,
                'text_block'      => Layouts\TextBlockLayout::class,
                'linked_pages'    => Layouts\LinkedPagesLayout::class,
            ]
        );
    }

    /**
     * Register fields
     */
    protected function register_fields() : void {

        try {
            $group_title = _x( 'Page Components', 'theme ACF', 'tms-theme-muumib2b' );

            $field_group = ( new Group( $group_title ) )
                ->set_key( 'fg_exhibition_one_components' );

            $rule_group = ( new RuleGroup() )
                ->add_rule( 'page_template', '==', PageExhibitionOne::TEMPLATE );

            $field_group
                ->add_rule_group( $rule_group )
                ->set_position( 'normal' )
                ->set_hidden_elements(
                    [
                        'discussion',
                        'comments',
                        'format',
                        'send-trackbacks',
                        'editor',
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
     * Get header fields
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
            ->set_instructions( $strings['components']['instructions'] );

        $component_layouts = \apply_filters(
            'tms/acf/field/' . $components_field->get_key() . '/layouts',
            array_values( $this->components ),
            $key
        );

        foreach ( $component_layouts as $component_layout ) {
            if ( ! empty( $component_layout ) ) {
                $components_field->add_layout( new $component_layout( $key ) );
            }
        }

        return $components_field;
    }
}

( new ExhibitionTwoGroup() );
