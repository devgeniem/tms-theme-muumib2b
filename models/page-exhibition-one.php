<?php
/**
 * Template Name: The door is always open -näyttely
 */

use TMS\Theme\MuumiB2B\Traits\Components;

/**
 * The Exhibition class.
 */
class PageExhibitionOne extends BaseModel {

    use Components;

    /**
     * Template
     */
    const TEMPLATE = 'models/page-exhibition-one.php';

    /**
     * Hooks
     *
     * @return void
     */
    public function hooks() : void {
        \add_filter( 'tms/theme/breadcrumbs/show_breadcrumbs_in_header', '__return_false' );
    }

}
