<?php
/**
 * Copyright (c) 2021. Geniem Oy
 */

namespace TMS\Theme\MuumiB2B\PostType;

use \TMS\Theme\MuumiB2B\Interfaces\PostType;
use TMS\Theme\MuumiB2B\Taxonomy\Category;
use TMS\Theme\MuumiB2B\Traits\EnrichPost;

/**
 * This class defines the post type.
 *
 * @package TMS\Theme\MuumiB2B\PostType
 */
class Post implements PostType {

    use EnrichPost;

    /**
     * This defines the slug of this post type.
     */
    const SLUG = 'post';

    /**
     * Add hooks and filters from this controller
     *
     * @return void
     */
    public function hooks() : void {}

    /**
     * Get primary category.
     *
     * @param string $post_id Post ID.
     *
     * @return \WP_Term|null
     */
    public static function get_primary_category( $post_id ) {
        return Category::get_primary_category( $post_id );
    }
}
