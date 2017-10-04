<?php
/**
 * PHP skeleton application for Amazon Alexa Skills
 *
 * @author     Ralf Eggert <ralf@travello.audio>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/travello-gmbh/amazon-alexa-skill-skeleton
 * @link       https://www.travello.audio/
 */

return [
    'debug' => false,

    'config_cache_enabled' => false,

    'zend-expressive' => [
        'programmatic_pipeline' => true,
        'raise_throwables'      => true,
        'error_handler'         => [
            'template_404'   => 'error::404',
            'template_error' => 'error::error',
        ],
    ],
];
