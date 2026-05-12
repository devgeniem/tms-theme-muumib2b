<?php
/**
 *  Copyright (c) 2021. Geniem Oy
 */

namespace TMS\Theme\MuumiB2B\Formatters;

/**
 * Class HeroFormatter
 *
 * @package TMS\Theme\MuumiB2B\Formatters
 */
class HeroFormatter implements \TMS\Theme\MuumiB2B\Interfaces\Formatter {

    /**
     * Define formatter name
     */
    const NAME = 'Hero';

    /**
     * Hooks
     */
    public function hooks() : void {
        add_filter(
            'tms/acf/layout/hero/data',
            [ $this, 'format' ]
        );
    }

    /**
     * Format layout data
     *
     * @param array $layout ACF Layout data.
     *
     * @return array
     */
    public function format( array $layout ) : array {
        $button_classes = [ 'mt-4' ];
        $box_classes    = [];

        $layout['button_classes'] = implode( ' ', $button_classes );
        $layout['box_classes']    = implode( ' ', $box_classes );

        return $layout;
    }

    /**
     * Has filled text fields
     *
     * @param array $layout ACF Layout data.
     *
     * @return bool
     */
    protected function has_filled_text_fields( array $layout ) : bool {
        $fields = [
            'title',
            'description',
            'link',
        ];

        foreach ( $fields as $field_key ) {
            if ( ! empty( $layout[ $field_key ] ) ) {
                return true;
            }
        }

        return false;
    }
}
