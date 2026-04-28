<?php


namespace TMS\Theme\MuumiB2B\PostType;

use \TMS\Theme\MuumiB2B\Interfaces\PostType;

/**
 * This class defines the post type.
 *
 * @package TMS\Theme\MuumiB2B\PostType
 */
class Page implements PostType {

    /**
     * This defines the slug of this post type.
     */
    const SLUG = 'page';

    /**
     * Add hooks and filters from this controller
     *
     * @return void
     */
    public function hooks() : void {}
}
