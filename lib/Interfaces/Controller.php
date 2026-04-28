<?php


namespace TMS\Theme\MuumiB2B\Interfaces;

/**
 * Interface Controller
 *
 * @package TMS\Theme\MuumiB2B\Interfaces
 */
interface Controller {

    /**
     * Add hooks and filters from this controller
     *
     * @return void
     */
    public function hooks() : void;
}
