<?php
/**
 *  Copyright (c) 2021. Geniem Oy
 */

namespace TMS\Theme\MuumiB2B\Formatters;

use TMS\Theme\MuumiB2B\Traits\Components;

/**
 * Class AccordionFormatter
 *
 * @package TMS\Theme\MuumiB2B\Formatters
 */
class AccordionFormatter implements \TMS\Theme\MuumiB2B\Interfaces\Formatter {

    use Components;

    /**
     * Define formatter name
     */
    const NAME = 'Accordion';

    /**
     * Hooks
     */
    public function hooks() : void {
        add_filter(
            'tms/acf/block/accordion/data',
            [ $this, 'format' ]
        );
    }

    /**
     * Format block data
     *
     * @param array $data ACF Block data.
     *
     * @return array
     */
    public function format( array $data ) : array {
        if ( empty( $data['sections'] ) ) {
            return $data;
        }

        $sections = $data['sections'] ?? [];
        $sections = array_filter( $sections, fn( $item ) => ! empty( $item['section_content'] ) );

        $data['sections'] = array_map( function ( $section ) {
            $section['ID']              = wp_unique_id();
            $section['section_content'] = $this->handle_layouts( $section['section_content'] );

            return $section;
        }, $sections );

        $data['strings'] = [
            'expand'       => \_x( 'Expand', 'theme-frontend', 'tms-theme-muumib2b' ),
            'collapse'     => \_x( 'Collapse', 'theme-frontend', 'tms-theme-muumib2b' ),
            'expand_all'   => \_x( 'Expand all sections', 'theme-frontend', 'tms-theme-muumib2b' ),
            'collapse_all' => \_x( 'Collapse all sections', 'theme-frontend', 'tms-theme-muumib2b' ),
        ];

        return $data;
    }
}
