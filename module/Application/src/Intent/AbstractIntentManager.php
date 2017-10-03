<?php
/**
 * PHP skeleton application for Amazon Alexa Skills
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/travello-gmbh/amazon-alexa-skill-skeleton
 * @link       https://www.travello.de/
 */

namespace Application\Intent;

use TravelloAlexaLibrary\Intent\CancelIntent;
use TravelloAlexaLibrary\Intent\HelpIntent;
use TravelloAlexaLibrary\Intent\IntentInterface;
use TravelloAlexaLibrary\Intent\LaunchIntent;
use TravelloAlexaLibrary\Intent\StopIntent;
use TravelloAlexaLibrary\Request\RequestType\LaunchRequestType;
use TravelloAlexaLibrary\Request\RequestType\SessionEndedRequestType;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\Exception\InvalidServiceException;
use Zend\ServiceManager\Factory\InvokableFactory;

/**
 * Class IntentManager
 *
 * @package Application\Intent
 */
abstract class AbstractIntentManager extends AbstractPluginManager
{
    /**
     * @var array
     */
    protected $aliases
        = [
            LaunchRequestType::NAME       => LaunchIntent::class,
            SessionEndedRequestType::NAME => StopIntent::class,
            HelpIntent::NAME              => HelpIntent::class,
            StopIntent::NAME              => StopIntent::class,
            CancelIntent::NAME            => CancelIntent::class,
        ];

    protected $factories
        = [
            LaunchIntent::class => AbstractIntentFactory::class,
            HelpIntent::class   => AbstractIntentFactory::class,
            StopIntent::class   => AbstractIntentFactory::class,
            CancelIntent::class => AbstractIntentFactory::class,
        ];

    /**
     * Validate the plugin is of the expected type (v3).
     *
     * Validates against callables and HelperInterface implementations.
     *
     * @param mixed $instance
     *
     * @throws InvalidServiceException
     */
    public function validate($instance)
    {
        if (!is_callable($instance) && !$instance instanceof IntentInterface) {
            throw new InvalidServiceException(
                sprintf(
                    '%s can only create instances of %s and/or callables; %s is invalid',
                    get_class($this),
                    IntentInterface::class,
                    (is_object($instance) ? get_class($instance) : gettype($instance))
                )
            );
        }
    }
}
