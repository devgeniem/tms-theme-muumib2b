<?php
/**
 * Class Strings
 * UI Strings
 */

/**
 * Class Strings
 */
class Strings extends \DustPress\Model {

    /**
     * Constructor
     *
     * @param array $args   Model arguments.
     * @param mixed $parent Set model parent.
     */
    public function __construct( $args = [], $parent = null ) {
        parent::__construct( $args, $parent );

        $this->hooks();
    }

    /**
     * Hooks
     */
    public function hooks() : void {
        add_filter(
            'dustpress/pagination/data',
            \Closure::fromCallable( [ $this, 'add_pagination_translations' ] )
        );
    }

    /**
     * Translated strings
     *
     * @return array
     */
    public function s() : array {
        return [
            'header'             => [
                'skip_to_content'           => _x( 'Skip to content', 'theme-frontend', 'tms-theme-muumib2b' ),
                'main_navigation'           => _x( 'Main navigation', 'theme-frontend', 'tms-theme-muumib2b' ),
                'frequently_searched_pages' => _x( 'Frequently searched pages', 'theme-frontend', 'tms-theme-muumib2b' ),
                'open_menu'                 => _x( 'Open menu', 'theme-frontend', 'tms-theme-muumib2b' ),
                'close_menu'                => _x( 'Close menu', 'theme-frontend', 'tms-theme-muumib2b' ),
                'language_navigation'       => _x( 'Language navigation', 'theme-frontend', 'tms-theme-muumib2b' ),
                'open_search'               => _x( 'Open search form', 'theme-frontend', 'tms-theme-muumib2b' ),
                'open_lang_nav'             => _x( 'Open language navigation', 'theme-frontend', 'tms-theme-muumib2b' ),
                'current_lang'              => _x( 'Current language: ', 'theme-frontend', 'tms-theme-muumib2b' ),
                'search'                    => _x( 'Search', 'theme-frontend', 'tms-theme-muumib2b' ),
                'search_title'              => _x( 'Search', 'theme-frontend', 'tms-theme-muumib2b' ),
                'search_input_label'        => _x( 'Search from site', 'theme-frontend', 'tms-theme-muumib2b' ),
                'search_input_placeholder'  => _x( 'Search from site', 'theme-frontend', 'tms-theme-muumib2b' ),
                'exception_close_button'    => _x( 'Close', 'theme-frontend', 'tms-theme-muumib2b' ),
                'home'                      => _x( 'To home page', 'theme-frontend', 'tms-theme-muumib2b' ),
                'breadcrumbs'               => _x( 'Breadcrumbs', 'theme-frontend', 'tms-theme-muumib2b' ),
            ],
            '404'                => [
                'title'         => _x( 'Page not found', 'theme-frontend', 'tms-theme-muumib2b' ),
                'subtitle'      => _x(
                    'The content were looking for was not found',
                    'theme-frontend',
                    'tms-theme-muumib2b'
                ),
                'home_link_txt' => _x( 'To home page', 'theme-frontend', 'tms-theme-muumib2b' ),
            ],
            'video'              => [
                'skip_embed' => _x( 'Skip video embed', 'theme-frontend', 'tms-theme-muumib2b' ),
                'play'       => _x( 'Play video', 'theme-frontend', 'tms-theme-muumib2b' ),
                'pause'      => _x( 'Pause video', 'theme-frontend', 'tms-theme-muumib2b' ),
                'stop'       => _x( 'Stop video', 'theme-frontend', 'tms-theme-muumib2b' ),
                'mute'       => _x( 'Mute or unmute video', 'theme-frontend', 'tms-theme-muumib2b' ),
                'volume'     => _x( 'Video volume', 'theme-frontend', 'tms-theme-muumib2b' ),
            ],
            'social_media'       => [
                'skip_embed' => _x( 'Skip social media embed', 'theme-frontend', 'tms-theme-muumib2b' ),
            ],
            'rolling_text'       => [
                'pause' => _x( 'Pause animation', 'theme-frontend', 'tms-theme-muumib2b' ),
                'play'  => _x( 'Play animation', 'theme-frontend', 'tms-theme-muumib2b' ),
            ],
            'share'              => [
                'share_article'         => _x( 'Share Article', 'theme-frontend', 'tms-theme-muumib2b' ),
                'share_event'           => _x( 'Share Event', 'theme-frontend', 'tms-theme-muumib2b' ),
                'share_to_social_media' => _x( 'Share to social media', 'theme-frontend', 'tms-theme-muumib2b' ),
            ],
            'gallery'            => [
                'close'           => _x( 'Close', 'theme-frontend', 'tms-theme-muumib2b' ),
                'next'            => _x( 'Next', 'theme-frontend', 'tms-theme-muumib2b' ),
                'open'            => _x( 'Open', 'theme-frontend', 'tms-theme-muumib2b' ),
                'previous'        => _x( 'Previous', 'theme-frontend', 'tms-theme-muumib2b' ),
                'goto'            => _x( 'Go to slide', 'theme-frontend', 'tms-theme-muumib2b' ),
                'centered'        => _x( 'Centered', 'theme-frontend', 'tms-theme-muumib2b' ),
                'slide'           => _x( 'Slide', 'theme-frontend', 'tms-theme-muumib2b' ),
                'image_carousel'  => _x( 'Image carousel', 'theme-frontend', 'tms-theme-muumib2b' ),
                'modal_carousel'  => _x( 'Modal image carousel', 'theme-frontend', 'tms-theme-muumib2b' ),
                'browsing_images' => _x( 'Browsing images', 'theme-frontend', 'tms-theme-muumib2b' ),
                'main_carousel'   => _x( 'Main image carousel', 'theme-frontend', 'tms-theme-muumib2b' ),
                'expand'          => _x( 'Expand', 'theme-frontend', 'tms-theme-muumib2b' ),
            ],
            'footer'             => [
                'to_main_site' => _x( 'Move to tampere.fi', 'theme-frontend', 'tms-theme-muumib2b' ),
                'back_to_top'  => _x( 'Back to top', 'theme-frontend', 'tms-theme-muumib2b' ),
            ],
            'common'             => [
                'target_blank'  => _x( 'Opens in a new window', 'theme-frontend', 'tms-theme-muumib2b' ),
                'external_link' => _x( 'The link takes you to an external website', 'theme-frontend', 'tms-theme-muumib2b' ),
                'all'           => _x( 'All', 'theme-frontend', 'tms-theme-muumib2b' ),
                'read_more'     => _x( 'Read more', 'theme-frontend', 'tms-theme-muumib2b' ),
            ],
            'single'             => [
                'image_credits'   => _x( 'Image:', 'theme-frontend', 'tms-theme-muumib2b' ),
                'writing_credits' => _x( 'Text:', 'theme-frontend', 'tms-theme-muumib2b' ),
                'article_type'    => _x( 'Articletype:', 'theme-frontend', 'tms-theme-muumib2b' ),
            ],
            'home'               => [
                'month'              => _x( 'Month', 'theme-frontend', 'tms-theme-muumib2b' ),
                'year'               => _x( 'Year', 'theme-frontend', 'tms-theme-muumib2b' ),
                'no_results'         => _x( 'No results', 'theme-frontend', 'tms-theme-muumib2b' ),
                'filter_by_category' => _x( 'Filter by Category', 'theme-frontend', 'tms-theme-muumib2b' ),
                'description'        => _x( 'The page reloads after the selection.', 'theme-frontend', 'tms-theme-muumib2b' ),
            ],
            'months'             => [
                'january'   => _x( 'January', 'theme-frontend', 'tms-theme-muumib2b' ),
                'february'  => _x( 'February', 'theme-frontend', 'tms-theme-muumib2b' ),
                'march'     => _x( 'March', 'theme-frontend', 'tms-theme-muumib2b' ),
                'april'     => _x( 'April', 'theme-frontend', 'tms-theme-muumib2b' ),
                'may'       => _x( 'May', 'theme-frontend', 'tms-theme-muumib2b' ),
                'june'      => _x( 'June', 'theme-frontend', 'tms-theme-muumib2b' ),
                'july'      => _x( 'July', 'theme-frontend', 'tms-theme-muumib2b' ),
                'august'    => _x( 'August', 'theme-frontend', 'tms-theme-muumib2b' ),
                'september' => _x( 'September', 'theme-frontend', 'tms-theme-muumib2b' ),
                'october'   => _x( 'October', 'theme-frontend', 'tms-theme-muumib2b' ),
                'november'  => _x( 'November', 'theme-frontend', 'tms-theme-muumib2b' ),
                'december'  => _x( 'December', 'theme-frontend', 'tms-theme-muumib2b' ),
            ],
            'password_protected' => [
                'input_label'       => _x( 'Password:', 'theme-frontend', 'tms-theme-muumib2b' ),
                'input_placeholder' => _x( 'Password', 'theme-frontend', 'tms-theme-muumib2b' ),
                'button_text'       => _x( 'Log in', 'theme-frontend', 'tms-theme-muumib2b' ),
                'message'           => _x(
                    'This content is password protected. To view it please enter your password below:',
                    'theme-frontend',
                    'tms-theme-muumib2b'
                ),
            ],
            'sibling_navigation' => [
                'sibling_navigation' => _x( 'Sibling pages', 'theme-frontend', 'tms-theme-muumib2b' ),
            ],
            'comments'           => [
                'comments_title' => _x( 'Comments', 'theme-frontend', 'tms-theme-muumib2b' ),
                'close_notice'   => _x( 'Close', 'theme-frontend', 'tms-theme-muumib2b' ),
            ],
            'blog_article'       => [
                'toggle_details'    => _x( 'Show description', 'theme-frontend', 'tms-theme-muumib2b' ),
                'archive_link_text' => _x( 'All articles', 'theme-frontend', 'tms-theme-muumib2b' ),
            ],
            'event'              => [
                'date'     => _x( 'Event date', 'theme-frontend', 'tms-theme-muumib2b' ),
                'time'     => _x( 'Event time', 'theme-frontend', 'tms-theme-muumib2b' ),
                'location' => _x( 'Event location', 'theme-frontend', 'tms-theme-muumib2b' ),
                'price'    => _x( 'Event price', 'theme-frontend', 'tms-theme-muumib2b' ),
            ],
            'sitemap'            => [
                'open'  => _x( 'Open', 'theme-frontend', 'tms-theme-muumib2b' ),
                'close' => _x( 'Close', 'theme-frontend', 'tms-theme-muumib2b' ),
            ],
            'contact_search'     => [
                'label'             => _x( 'Search contacts', 'theme-frontend', 'tms-theme-muumib2b' ),
                'input_placeholder' => _x( 'Search', 'theme-frontend', 'tms-theme-muumib2b' ),
                'submit_value'      => _x( 'Search', 'theme-frontend', 'tms-theme-muumib2b' ),
            ],
            'artist'             => [
                'open'            => _x( 'Open', 'theme-frontend', 'tms-theme-muumib2b' ),
                'close'           => _x( 'Close', 'theme-frontend', 'tms-theme-muumib2b' ),
                'related_artwork' => _x( 'Related artwork', 'theme-frontend', 'tms-theme-muumib2b' ),
            ],
            'artwork'            => [
                'artist_link'     => _x( 'Show artist', 'theme-frontend', 'tms-theme-muumib2b' ),
                'related_art'     => _x( 'Artwork by the same artist', 'theme-frontend', 'tms-theme-muumib2b' ),
                'related_artwork' => _x( 'Related artwork', 'theme-frontend', 'tms-theme-muumib2b' ),
            ],
            'search'             => [
                'filter_by_post_type' => _x( 'Filter by type', 'theme-frontend', 'tms-theme-muumib2b' ),
                'filter_by_date'      => _x( 'Publish date', 'theme-frontend', 'tms-theme-muumib2b' ),
                'breadcrumbs'         => _x( 'Page location:', 'theme-frontend', 'tms-theme-muumib2b' ),
                'clear'               => _x( 'Clear the form', 'theme-frontend', 'tms-theme-muumib2b' )
            ],
            // Use the Duet Date Picker keys for strings
            'datepicker'         => [
                'buttonLabel'         => _x( 'Pick a date', 'theme-frontend', 'tms-theme-muumib2b' ),
                'placeholder'         => _x( 'dd.mm.yyyy', 'theme-frontend', 'tms-theme-muumib2b' ),
                'selectedDateMessage' => _x( 'The chosen date is', 'theme-frontend', 'tms-theme-muumib2b' ),
                'prevMonthLabel'      => _x( 'Previous month', 'theme-frontend', 'tms-theme-muumib2b' ),
                'nextMonthLabel'      => _x( 'Next month', 'theme-frontend', 'tms-theme-muumib2b' ),
                'monthSelectLabel'    => _x( 'Month', 'theme-frontend', 'tms-theme-muumib2b' ),
                'yearSelectLabel'     => _x( 'Year', 'theme-frontend', 'tms-theme-muumib2b' ),
                'closeLabel'          => _x( 'Close window', 'theme-frontend', 'tms-theme-muumib2b' ),
                'calendarHeading'     => _x( 'Pick a date', 'theme-frontend', 'tms-theme-muumib2b' ),
                'dayNames'            => [
                    _x( 'Sunday', 'theme-frontend', 'tms-theme-muumib2b' ),
                    _x( 'Monday', 'theme-frontend', 'tms-theme-muumib2b' ),
                    _x( 'Tuesday', 'theme-frontend', 'tms-theme-muumib2b' ),
                    _x( 'Wednesday', 'theme-frontend', 'tms-theme-muumib2b' ),
                    _x( 'Thursday', 'theme-frontend', 'tms-theme-muumib2b' ),
                    _x( 'Friday', 'theme-frontend', 'tms-theme-muumib2b' ),
                    _x( 'Saturday', 'theme-frontend', 'tms-theme-muumib2b' ),
                ],
                'monthNames'          => [
                    _x( 'January', 'theme-frontend', 'tms-theme-muumib2b' ),
                    _x( 'February', 'theme-frontend', 'tms-theme-muumib2b' ),
                    _x( 'March', 'theme-frontend', 'tms-theme-muumib2b' ),
                    _x( 'April', 'theme-frontend', 'tms-theme-muumib2b' ),
                    _x( 'May', 'theme-frontend', 'tms-theme-muumib2b' ),
                    _x( 'June', 'theme-frontend', 'tms-theme-muumib2b' ),
                    _x( 'July', 'theme-frontend', 'tms-theme-muumib2b' ),
                    _x( 'August', 'theme-frontend', 'tms-theme-muumib2b' ),
                    _x( 'September', 'theme-frontend', 'tms-theme-muumib2b' ),
                    _x( 'October', 'theme-frontend', 'tms-theme-muumib2b' ),
                    _x( 'November', 'theme-frontend', 'tms-theme-muumib2b' ),
                    _x( 'December', 'theme-frontend', 'tms-theme-muumib2b' ),
                ],
                'monthNamesShort'     => [
                    _x( 'Jan', 'theme-frontend', 'tms-theme-muumib2b' ),
                    _x( 'Feb', 'theme-frontend', 'tms-theme-muumib2b' ),
                    _x( 'Mar', 'theme-frontend', 'tms-theme-muumib2b' ),
                    _x( 'Apr', 'theme-frontend', 'tms-theme-muumib2b' ),
                    _x( 'May', 'theme-frontend', 'tms-theme-muumib2b' ),
                    _x( 'Jun', 'theme-frontend', 'tms-theme-muumib2b' ),
                    _x( 'Jul', 'theme-frontend', 'tms-theme-muumib2b' ),
                    _x( 'Aug', 'theme-frontend', 'tms-theme-muumib2b' ),
                    _x( 'Sept', 'theme-frontend', 'tms-theme-muumib2b' ),
                    _x( 'Oct', 'theme-frontend', 'tms-theme-muumib2b' ),
                    _x( 'Nov', 'theme-frontend', 'tms-theme-muumib2b' ),
                    _x( 'Dec', 'theme-frontend', 'tms-theme-muumib2b' ),
                ],
            ],
            'countdown'          => [
                'days'    => _x( 'Days', 'theme-frontend', 'tms-theme-muumib2b' ),
                'hours'   => _x( 'Hours', 'theme-frontend', 'tms-theme-muumib2b' ),
                'minutes' => _x( 'Minutes', 'theme-frontend', 'tms-theme-muumib2b' ),
                'seconds' => _x( 'Seconds', 'theme-frontend', 'tms-theme-muumib2b' ),
            ],
            'modaal'             => [
                'accessible_title' => _x( 'Enlarged image', 'theme-frontend', 'tms-theme-muumib2b' ),
                'close'            => _x( 'Close', 'theme-frontend', 'tms-theme-muumib2b' ),
            ],
        ];
    }

    /**
     * Add translations to pagination
     *
     * @param object $data Pagination data.
     *
     * @return object
     */
    public function add_pagination_translations( $data ) {
        $data->S->aria_label = __( 'Pagination', 'tms-theme-muumib2b' ); // phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase

        return $data;
    }
}
