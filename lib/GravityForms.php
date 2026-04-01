<?php
/**
 *  Copyright (c) 2021. Geniem Oy
 */

namespace TMS\Theme\MuumiB2B;

use TMS\Theme\MuumiB2B\Interfaces\Controller;

/**
 * Class GravityForms
 *
 * @package TMS\Theme\MuumiB2B
 */
class GravityForms implements Controller {

    /**
     * Hooks
     */
    public function hooks() : void {
        add_filter( 'gform_confirmation_anchor', '__return_true' );
        add_filter( 'gform_submit_button',
            \Closure::fromCallable( [ $this, 'form_submit_button' ] ),
        10, 2 );
    }

    /**
     * Change submit input to button.
     *
     * @param string $button Submit's HTML.
     * @param array  $form Form data in array.
     *
     * @return string
     */
    protected function form_submit_button( $button, $form ) {
        return "<button type='submit' class='button gform_button is-primary-invert' id='gform_submit_button_{$form['id']}'><span>{$form['button']['text']}</span></button>"; // phpcs:ignore
    }

}
