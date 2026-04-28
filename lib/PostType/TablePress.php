<?php


namespace TMS\Theme\MuumiB2B\PostType;

use \TMS\Theme\MuumiB2B\Interfaces\PostType;

/**
 * This class defines the TablePress type.
 *
 * @package TMS\Theme\MuumiB2B\PostType
 */
class TablePress implements PostType {

    /**
     * This defines the slug of this post type.
     */
    const SLUG = 'tablepress_table';

    /**
     * Add hooks and filters from this controller
     *
     * @return void
     */
    public function hooks() : void {}
}
