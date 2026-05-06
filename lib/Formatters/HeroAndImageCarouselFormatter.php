<?php
/**
 * Copyright (c) 2021. Geniem Oy
 */

namespace TMS\Theme\MuumiB2B\Formatters;

/**
 * Class HeroAndImageCarouselFormatter
 *
 * @package TMS\Theme\MuumiB2B\Formatters
 */
class HeroAndImageCarouselFormatter implements \TMS\Theme\MuumiB2B\Interfaces\Formatter {

    /**
     * Define formatter name
     */
    const NAME = 'HeroAndImageCarousel';

    /**
     * Hooks
     */
    public function hooks() : void {
        add_filter(
            'tms/acf/layout/hero_and_image_carousel/data',
            [ $this, 'format' ]
        );
    }

    /**
     * Format layout data.
     *
     * @param array $layout ACF Layout data.
     *
     * @return array
     */
    public function format( array $layout ) : array {
        $hero_formatter           = new HeroFormatter();
        $image_carousel_formatter = new ImageCarouselFormatter();

        $layout['hero'] = is_array( $layout['hero'] ?? null )
            ? $hero_formatter->format( $layout['hero'] )
            : [];

        $layout['image_carousel'] = is_array( $layout['image_carousel'] ?? null )
            ? $image_carousel_formatter->format( $layout['image_carousel'] )
            : [];

        return $layout;
    }
}