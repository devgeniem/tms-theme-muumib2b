<?php
/**
 * Copyright (c) 2021. Geniem Oy
 */

namespace TMS\Theme\MuumiB2B\Interfaces;

/**
 * Interface PostType
 *
 * @package TMS\Theme\MuumiB2B\Interfaces
 */
interface PostType {
    /**
     * Add hooks and filters from this controller
     *
     * @return void
     */
    public function hooks() : void;
}
