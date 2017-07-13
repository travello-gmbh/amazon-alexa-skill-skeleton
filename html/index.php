<?php
/**
 * PHP skeleton application for Amazon Alexa Skills
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/travello-gmbh/amazon-alexa-skill-skeleton
 * @link       https://www.travello.de/
 */

use Interop\Container\ContainerInterface;
use Zend\Expressive\Application;

define('PROJECT_ROOT', realpath(__DIR__ . '/..'));

define(
    'APPLICATION_ENV',
    getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'
);

chdir(dirname(__DIR__));
require PROJECT_ROOT . '/vendor/autoload.php';

/** @var ContainerInterface $container */
$container = require PROJECT_ROOT . '/config/container.php';

/** @var Application $app */
$app = $container->get(Application::class);
$app->run();
