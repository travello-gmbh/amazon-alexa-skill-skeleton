<?php
/**
 * PHP skeleton application for Amazon Alexa Skills
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/travello-gmbh/amazon-alexa-skill-skeleton
 * @link       https://www.travello.de/
 */

namespace Application\Config;

use Interop\Container\ContainerInterface;
use TravelloAlexaLibrary\Middleware\InjectAlexaRequestMiddleware;
use TravelloAlexaLibrary\Middleware\InjectCertificateValidatorMiddleware;
use Zend\Expressive\Application;
use Zend\Expressive\Middleware\ImplicitHeadMiddleware;
use Zend\Expressive\Middleware\ImplicitOptionsMiddleware;
use Zend\Expressive\Middleware\NotFoundHandler;
use Zend\ServiceManager\Factory\DelegatorFactoryInterface;
use Zend\Stratigility\Middleware\ErrorHandler;
use Zend\Stratigility\Middleware\OriginalMessages;

/**
 * Class PipelineDelegatorFactory
 *
 * @package Application\Config
 */
class PipelineDelegatorFactory implements DelegatorFactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string             $name
     * @param callable           $callback
     * @param array|null|null    $options
     *
     * @return mixed
     */
    public function __invoke(ContainerInterface $container, $name, callable $callback, array $options = null)
    {
        /** @var Application $application */
        $application = $callback();

        $application->pipe(OriginalMessages::class);

        $application->pipe(ErrorHandler::class);
        $application->pipe(InjectAlexaRequestMiddleware::class);
        $application->pipe(InjectCertificateValidatorMiddleware::class);

        $application->pipeRoutingMiddleware();
        $application->pipe(ImplicitHeadMiddleware::class);
        $application->pipe(ImplicitOptionsMiddleware::class);
        $application->pipeDispatchMiddleware();

        $application->pipe(NotFoundHandler::class);

        return $application;
    }
}
