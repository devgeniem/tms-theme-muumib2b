<?php
namespace TMS\Theme\MuumiB2B\Formatters;

/**
 * Class ModularityFormatter
 *
 * @package TMS\Theme\MuumiB2B\Formatters
 */
class ModularityFormatter implements \TMS\Theme\MuumiB2B\Interfaces\Formatter {

    /**
     * Define formatter name
     */
    const NAME = 'Modularity';

    /**
     * Hooks
     */
    public function hooks() : void {
        add_filter(
            'tms/acf/layout/modularity/data',
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
        // Count the repeater items and add ID & hidden-classes.
        if ( isset( $layout['repeater'] ) && is_array( $layout['repeater'] ) ) {
            $layout['repeater_count'] = count( $layout['repeater'] );

            foreach ( $layout['repeater'] as $index => $item ) {
                $layout['repeater'][ $index ]['unique_id'] = uniqid( 'modularity_item_' );
                $layout['repeater'][ $index ]['is_hidden'] = $index !== 0 ? 'is-hidden' : '';
            }
        }

        return $layout;
    }
}
