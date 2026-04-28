<?php


namespace TMS\Theme\MuumiB2B\PostType;

use \TMS\Theme\MuumiB2B\Interfaces\PostType;

/**
 * This class represents WordPress default post type 'attachment'.
 *
 * @package TMS\Theme\MuumiB2B\PostType
 */
class Attachment implements PostType {

    /**
     * This defines the slug of this post type.
     */
    const SLUG = 'attachment';

    /**
     * This is called in setup automatically.
     *
     * @return void
     */
    public function hooks() : void {}
}
