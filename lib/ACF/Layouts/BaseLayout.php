<?php


namespace TMS\Theme\MuumiB2B\ACF\Layouts;

use TMS\Theme\MuumiB2B\ACF\ComponentCommonFields;

/**
 * BaseLayout
 */
class BaseLayout extends \Geniem\ACF\Field\Flexible\Layout {
    /**
     * Add shared component fields to current layout.
     *
     * @param array  $fields   Existing layout fields.
     * @param string $base_key Layout self::KEY.
     *
     * @return array
     */
    protected function with_common_fields( array $fields, string $base_key = '' ) : array {
        return ComponentCommonFields::add_common_fields( $fields, $this->get_key(), $base_key );
    }

    /**
     * Run default filters to our fields.
     *
     * @param array  $fields   ACF Fields.
     * @param string $key      ACF Group Key.
     * @param string $base_key Layout self::KEY.
     *
     * @return array
     */
    public function filter_layout_fields( $fields, $key, $base_key = '' ) : array {
        if ( $base_key !== $key && ! empty( $base_key ) ) {
            $fields = \apply_filters( 'tms/acf/layout/' . $base_key . '/fields', $fields, $key );
        }

        return \apply_filters( 'tms/acf/layout/' . $key . '/fields', $fields, $key );
    }
}
