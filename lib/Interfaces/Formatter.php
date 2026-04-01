<?php
/**
 * Copyright (c) 2021. Geniem Oy
 */

namespace TMS\Theme\MuumiB2B\Interfaces;

/**
 * Interface Formatter
 *
 * @package TMS\Theme\MuumiB2B\Interfaces
 */
interface Formatter {

    /**
     * Add hooks and filters from this formatter
     *
     * @return void
     */
    public function hooks() : void;
}
