<?php
/**
 * Define the generic Page class.
 */

use TMS\Theme\MuumiB2B\Traits\Components;
use TMS\Theme\MuumiB2B\Settings;

/**
 * The Page class.
 */
class PageExtend extends BaseModel {

    use Components;

    /**
     * Hooks
     */
    public function hooks() : void {
        \add_filter( 'tms/theme/breadcrumbs/show_breadcrumbs_in_header', fn() => false );
    }

    /**
     * Hero image
     *
     * @return int|null
     */
    public function hero_image() : ?int {
        return \has_post_thumbnail()
            ? \get_post_thumbnail_id()
            : null;
    }

    /**
     * Check if the page has any Gutenberg block content.
     *
     * @return bool
     */
    public function has_content() : bool {
        return \has_blocks( \get_the_ID() );
    }

    /**
     * Check if page has a hero flexible content layout.
     *
     * @return bool
     */
    public function has_hero_layout() : bool {
        $content = \get_field( 'components' ) ?? [];

        if ( empty( $content ) || ! \is_array( $content ) ) {
            return false;
        }

        $hero_layouts = [
            'hero',
            'hero_and_image_carousel',
        ];

        foreach ( $content as $layout ) {
            if ( empty( $layout['acf_fc_layout'] ) ) {
                continue;
            }

            if ( \in_array( $layout['acf_fc_layout'], $hero_layouts, true ) ) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get post siblings.
     *
     * @return array|array[]|false
     */
    public function post_siblings() {
        $current_post_id = \get_the_ID();
        $parent_post_id  = \wp_get_post_parent_id( $current_post_id );

        if ( ! Settings::get_setting( 'enable_sibling_navigation' ) || $parent_post_id === 0 ) {
            return false;
        }

        $query_args = [
            'post_type'              => 'page',
            'posts_per_page'         => 100,
            'post_parent'            => $parent_post_id,
            'update_post_meta_cache' => false,
            'update_post_term_cache' => false,
            'no_found_rows'          => true,
            'orderby'                => 'menu_order title',
            'order'                  => 'ASC',
        ];

        $wp_query = new \WP_Query( $query_args );

        if ( 1 >= count( $wp_query->posts ) ) {
            return false;
        }

        return array_map( function ( $post ) use ( $current_post_id ) {
            $post->permalink  = \get_the_permalink( $post->ID );
            $post->is_current = $post->ID === $current_post_id;

            return $post;
        }, $wp_query->posts );
    }

    /**
     * Check if password protected page.
     *
     * @return bool
     */
    public function is_password_protected_page() : bool {
        return post_password_required() ? true : false;
    }

    /**
     * Get post password form action URL.
     *
     * @return string
     */
    public function password_form_action() : string {
        return \esc_url( \site_url( 'wp-login.php?action=postpass', 'login_post' ) );
    }

    /**
     * Get Password protected page hero image
     *
     * @return mixed|null
     */
    public function password_page_hero_img() {
        return Settings::get_setting( 'password_page_hero_img' ) ?? null;
    }

    /**
     * Get Password protected page info text
     *
     * @return mixed|null
     */
    public function password_page_info_text() {
        return Settings::get_setting( 'password_page_info_text' ) ?? null;
    }
}
