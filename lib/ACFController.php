<?php


namespace TMS\Theme\MuumiB2B;

/**
 * Class ACFController
 *
 * @package TMS\Theme\MuumiB2B
 */
class ACFController implements Interfaces\Controller {

    /**
     * Initialize the class' variables and add methods
     * to the correct action hooks.
     *
     * @return void
     */
    public function hooks() : void {
        \add_action(
            'acf/init',
            \Closure::fromCallable( [ $this, 'require_acf_files' ] )
        );

        \add_filter(
            'acf/prepare_field/type=message',
            \Closure::fromCallable( [ $this, 'append_preview_image_to_message_field' ] )
        );

        \add_filter( 'acf/settings/show_admin', '__return_false' );
    }

    /**
     * Append a preview image to instructions message fields when available.
     *
     * Expected image naming: {component-name}-preview.png
     * Example: content-columns-preview.png
     *
     * @param array $field ACF field data.
     * @return array
     */
    protected function append_preview_image_to_message_field( array $field ) : array {
        $component = $this->resolve_component_name_from_message_field( $field );

        if ( empty( $component ) ) {
            return $field;
        }

        $preview_file = $component . '-preview.png';
        $preview_path = \get_template_directory() . '/assets/images/admin/' . $preview_file;

        if ( ! file_exists( $preview_path ) ) {
            return $field;
        }

        $preview_url = \get_template_directory_uri() . '/assets/images/admin/' . $preview_file;

        // Prevent duplicate image injection when ACF prepares fields multiple times.
        if ( ! empty( $field['message'] ) && strpos( $field['message'], $preview_file ) !== false ) {
            return $field;
        }

        // ACF message fields may escape HTML by default, which would hide the preview markup.
        $field['esc_html'] = 0;

        $field['message'] = (string) ( $field['message'] ?? '' );
        $field['message'] .= sprintf(
            '<div class="preview-image-toggle">
                <button class="show-preview-image"><span class="text-show">%1$s</span><span class="text-hide">%2$s</span> <span class="arrow-down">&#9660;</span><span class="arrow-up">&#9650;</span></button>
                <div class="toggleable-preview-image hidden">
                    <img src="%3$s" alt="%4$s" style="max-width: 50%%;" />
                </div>
            </div>',
            \esc_html( 'Näytä esikatselu' ),
            \esc_html( 'Piilota esikatselu' ),
            \esc_url( $preview_url ),
            \esc_attr( 'Komponentin esikatselu' )
        );

        return $field;
    }

    /**
     * Resolve component name from a message field definition.
     *
     * Preferred approach: set the message field name to the component slug,
     * e.g. content-columns.
     *
     * @param array $field ACF field data.
     * @return string
     */
    protected function resolve_component_name_from_message_field( array $field ) : string {
        $name = (string) ( $field['_name'] ?? $field['name'] ?? '' );

        if ( empty( $name ) ) {
            return '';
        }

        $component = strtolower( $name );
        $component = preg_replace( '/_instructions$/', '', $component );
        $component = str_replace( '_', '-', $component );

        return (string) $component;
    }

    /**
     * This method loops through all files in the
     * ACF directory and requires them.
     */
    protected function require_acf_files() : void {
        $files = array_diff(
            scandir( $this->get_base_dir() ),
            [ '.', '..', 'Field', 'Fields', 'Layouts' ]
        );

        array_walk(
            $files,
            function ( $file ) {
                require_once $this->get_base_dir() . '/' . basename( $file );
            }
        );
    }

    /**
     * Get ACF base dir
     *
     * @return string
     */
    protected function get_base_dir() : string {
        return __DIR__ . '/ACF';
    }
}
