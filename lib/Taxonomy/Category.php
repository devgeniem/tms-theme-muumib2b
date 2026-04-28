<?php


namespace TMS\Theme\MuumiB2B\Taxonomy;

use \TMS\Theme\MuumiB2B\Interfaces\Taxonomy;
use TMS\Theme\MuumiB2B\Traits\Categories;

/**
 * This class defines the taxonomy.
 *
 * @package TMS\Theme\MuumiB2B\Taxonomy
 */
class Category implements Taxonomy {

    use Categories;

    /**
     * This defines the slug of this taxonomy.
     */
    const SLUG = 'category';

    /**
     * Add hooks and filters from this controller
     *
     * @return void
     */
    public function hooks() : void {}
}
