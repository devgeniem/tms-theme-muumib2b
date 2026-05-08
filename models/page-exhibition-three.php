<?php
/**
 * Template Name: Moomin Animations -näyttely
 */

use TMS\Theme\MuumiB2B\Traits\Components;

/**
 * The Exhibition class.
 */
class PageExhibitionThree extends BaseModel {

    use Components;

    /**
     * Template
     */
    const TEMPLATE = 'models/page-exhibition-three.php';

    /**
     * Hooks
     *
     * @return void
     */
    public function hooks() : void {
        \add_filter( 'tms/theme/breadcrumbs/show_breadcrumbs_in_header', '__return_false' );
    }

}
