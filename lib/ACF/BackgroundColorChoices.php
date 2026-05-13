<?php

namespace TMS\Theme\MuumiB2B\ACF;

/**
 * Class BackgroundColorChoices
 *
 * Centralized background color choices for ACF fields.
 */
class BackgroundColorChoices {

    /**
     * BackgroundColorChoices constructor.
     */
    public function __construct() {
        \add_filter(
            'tms/acf/choices/background/has',
            \Closure::fromCallable( [ self::class, 'get_has_background_choices' ] )
        );

        \add_filter(
            'tms/acf/choices/background/before',
            \Closure::fromCallable( [ self::class, 'get_before_background_choices' ] )
        );

        \add_filter(
            'tms/acf/choices/background/next',
            \Closure::fromCallable( [ self::class, 'get_next_background_choices' ] )
        );
    }

    /**
     * Filter callback for has-background choices.
     *
     * @param array<string, string> $choices Existing choices.
     *
     * @return array<string, string>
     */
    public static function get_has_background_choices( array $choices ) : array {
        return $choices ?: [
            'has-background-white'      => 'Valkoinen',
            'has-background-yellow'     => 'Keltainen',
            'has-background-green'      => 'Vihreä',
            'has-background-lightgreen' => 'Vaaleanvihreä',
            'has-background-teal'       => 'Sinivihreä',
            'has-background-magenta'    => 'Magenta',
            'has-background-pink'       => 'Pinkki',
            'has-background-light-pink' => 'Vaaleanpunainen',
            'has-background-orange'     => 'Oranssi',
            'has-background-blue'       => 'Sininen',
            'has-background-bluegray'   => 'Siniharmaa',
            'has-background-gray'       => 'Harmaa',
        ];
    }

    /**
     * Filter callback for before-has-background choices.
     *
     * @param array<string, string> $choices Existing choices.
     *
     * @return array<string, string>
     */
    public static function get_before_background_choices( array $choices ) : array {
        return $choices ?: [
            'before-has-background-white'      => 'Valkoinen',
            'before-has-background-yellow'     => 'Keltainen',
            'before-has-background-green'      => 'Vihreä',
            'before-has-background-lightgreen' => 'Vaaleanvihreä',
            'before-has-background-teal'       => 'Sinivihreä',
            'before-has-background-magenta'    => 'Magenta',
            'before-has-background-pink'       => 'Pinkki',
            'before-has-background-light-pink' => 'Vaaleanpunainen',
            'before-has-background-orange'     => 'Oranssi',
            'before-has-background-blue'       => 'Sininen',
            'before-has-background-bluegray'   => 'Siniharmaa',
            'before-has-background-gray'       => 'Harmaa',
        ];
    }

    /**
     * Filter callback for next-has-background choices.
     *
     * @param array<string, string> $choices Existing choices.
     *
     * @return array<string, string>
     */
    public static function get_next_background_choices( array $choices ) : array {
        return $choices ?: [
            'next-has-background-white'      => 'Valkoinen',
            'next-has-background-yellow'     => 'Keltainen',
            'next-has-background-green'      => 'Vihreä',
            'next-has-background-lightgreen' => 'Vaaleanvihreä',
            'next-has-background-teal'       => 'Sinivihreä',
            'next-has-background-magenta'    => 'Magenta',
            'next-has-background-pink'       => 'Pinkki',
            'next-has-background-light-pink' => 'Vaaleanpunainen',
            'next-has-background-orange'     => 'Oranssi',
            'next-has-background-blue'       => 'Sininen',
            'next-has-background-bluegray'   => 'Siniharmaa',
            'next-has-background-gray'       => 'Harmaa',
        ];
    }
}

( new BackgroundColorChoices() );