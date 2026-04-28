<?php
/**
 *  Copyright (c) 2021. Geniem Oy
 */

namespace TMS\Theme\MuumiB2B\Formatters;

/**
 * Class ImageCarouselFormatter
 *
 * @package TMS\Theme\MuumiB2B\Formatters
 */
class ImageCarouselFormatter implements \TMS\Theme\MuumiB2B\Interfaces\Formatter {

    /**
     * Define formatter name
     */
    const NAME = 'ImageCarousel';

    /**
     * Hooks
     */
    public function hooks() : void {
        add_filter(
            'tms/acf/block/image_carousel/data',
            [ $this, 'format' ]
        );
        add_filter(
            'tms/acf/layout/image_carousel/data',
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
        if ( empty( $data['rows'] ) || ! is_array( $data['rows'] ) || count( $data['rows'] ) < 2 ) {
            $data['rows'] = [];
            return $data;
        }

        $data['rows'] = array_map( static function ( $item ) {
            $item = \TMS\Theme\MuumiB2B\Formatters\ImageFormatter::format( $item );

            $item       = apply_filters( 'tms/acf/block/image/data', $item );
            $item['id'] = wp_unique_id( 'image-carousel-item-' );

            unset( $item['__filter_attributes'], $item['wrapper_class'] );

            return $item;
        }, $data['rows'] );

        unset( $data['__filter_attributes'] );

        $data['carousel_id']  = wp_unique_id( 'image-carousel-' );
        $data['translations'] = ( new \Strings() )->s()['gallery'] ?? [];

        return $data;
    }
}
