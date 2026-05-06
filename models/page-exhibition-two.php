<?php
/**
 * Template Name: Moomins Sea Adventure -näyttely
 */

use TMS\Theme\MuumiB2B\Traits\Components;

/**
 * The Exhibition class.
 */
class PageExhibitionTwo extends BaseModel {

    use Components;

    /**
     * Template
     */
    const TEMPLATE = 'models/page-exhibition-two.php';

    /**
     * Hooks
     *
     * @return void
     */
    public function hooks() : void {
        \add_filter( 'tms/theme/breadcrumbs/show_breadcrumbs_in_header', '__return_false' );
    }

}
