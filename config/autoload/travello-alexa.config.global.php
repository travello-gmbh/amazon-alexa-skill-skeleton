<?php
/**
 * PHP skeleton application for Amazon Alexa Skills
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/travello-gmbh/amazon-alexa-skill-skeleton
 * @link       https://www.travello.de/
 */

return [
    'travello_alexa' => [
        'validate_signature' => true,
        'log_requests'       => false,
        'cache_flag'         => true,
        'cache_dir'          => PROJECT_ROOT . '/data/cache/',
    ],
];
