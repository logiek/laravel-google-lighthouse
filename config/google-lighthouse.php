<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Executable Paths
    |--------------------------------------------------------------------------
    |
    | Here you may configure an array of paths that will be used for execution
    | of the Google Lighthouse.
    |
    */
    'paths' => [
        'node' => null,
        'lighthouse' => './node_modules/lighthouse/lighthouse-cli/index.js',
    ],

    /*
    |--------------------------------------------------------------------------
    | Process Timeout
    |--------------------------------------------------------------------------
    |
    | Here you may define the amount of seconds before the process will be
    | considered unsuccessful.
    |
    */
    'timeout' => 60,

    /*
    |--------------------------------------------------------------------------
    | Export Formats
    |--------------------------------------------------------------------------
    |
    | This option defines the possible formats that can be used for the export.
    | These options are dependent on the export types provided by Google
    | Lighthouse.
    |
    */
    'formats' => [
        'json',
        'html',
        'csv',
    ],

    /*
    |--------------------------------------------------------------------------
    | Chrome Flags
    |--------------------------------------------------------------------------
    |
    | This option defines the custom flags to pass to Chrome (space-delimited).
    | For a full list of flags, see https://bit.ly/chrome-flags.
    |
    */
    'flags' => '--headless --disable-gpu --no-sandbox',

    /*
    |--------------------------------------------------------------------------
    | Options
    |--------------------------------------------------------------------------
    |
    | This option defines the options to configure Google Lighthouse to your
    | liking.
    |
    */
    'options' => [
        '--quiet',
    ],
];
