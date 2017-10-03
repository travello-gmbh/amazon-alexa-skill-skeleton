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

use Interop\Container\ContainerInterface;
use TravelloAlexaLibrary\Intent\IntentInterface;
use TravelloAlexaLibrary\Request\AlexaRequest;
use TravelloAlexaLibrary\Response\AlexaResponse;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class AbstractIntentFactory
 *
 * @package Application\Intent
 */
class AbstractIntentFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string             $requestedName
     * @param array|null         $options
     *
     * @return IntentInterface
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $alexaRequest  = $container->get(AlexaRequest::class);
        $alexaResponse = $container->get(AlexaResponse::class);

        /** @var IntentInterface $intent */
        $intent = new $requestedName($alexaRequest, $alexaResponse);

        return $intent;
    }
}
