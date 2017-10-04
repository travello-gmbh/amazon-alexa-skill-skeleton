<?php
/**
 * PHP skeleton application for Amazon Alexa Skills
 *
 * @author     Ralf Eggert <ralf@travello.audio>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/travello-gmbh/amazon-alexa-skill-skeleton
 * @link       https://www.travello.audio/
 */

namespace Hello\Application;

use Hello\Application\Helper\HelloTextHelper;
use Hello\Intent\IntentManager;
use Interop\Container\ContainerInterface;
use TravelloAlexaLibrary\Request\AlexaRequest;
use TravelloAlexaLibrary\Request\Certificate\CertificateValidator;
use TravelloAlexaLibrary\Response\AlexaResponse;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class HelloApplicationFactory
 *
 * @package Hello\Application
 */
class HelloApplicationFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string             $requestedName
     * @param array|null|null    $options
     *
     * @return HelloApplication
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): HelloApplication
    {
        $alexaResponse = $container->get(AlexaResponse::class);
        $intentManager = $container->get(IntentManager::class);
        $textHelper    = $container->get(HelloTextHelper::class);

        $helloApplication = new HelloApplication($alexaResponse, $intentManager, $textHelper);
        $helloApplication->setAlexaRequest($container->get(AlexaRequest::class));
        $helloApplication->setCertificateValidator($container->get(CertificateValidator::class));

        return $helloApplication;
    }
}
