<?php
/**
 * PHP skeleton application for Amazon Alexa Skills
 *
 * @author     Ralf Eggert <ralf@travello.audio>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/travello-gmbh/amazon-alexa-skill-skeleton
 * @link       https://www.travello.audio/
 */

namespace ApplicationTest\Config;

use Application\Config\PipelineDelegatorFactory;
use Interop\Container\ContainerInterface;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\MethodProphecy;
use Prophecy\Prophecy\ObjectProphecy;
use TravelloAlexaZf\Middleware\CheckApplicationMiddleware;
use TravelloAlexaZf\Middleware\ConfigureSkillMiddleware;
use TravelloAlexaZf\Middleware\LogAlexaRequestMiddleware;
use TravelloAlexaZf\Middleware\SetLocaleMiddleware;
use TravelloAlexaZf\Middleware\ValidateCertificateMiddleware;
use Zend\Expressive\Application;
use Zend\Expressive\Middleware\ImplicitHeadMiddleware;
use Zend\Expressive\Middleware\ImplicitOptionsMiddleware;
use Zend\Expressive\Middleware\NotFoundHandler;
use Zend\Stratigility\Middleware\ErrorHandler;
use Zend\Stratigility\Middleware\OriginalMessages;

/**
 * Class PipelineDelegatorFactoryTest
 *
 * @package ApplicationTest\Config
 */
class PipelineDelegatorFactoryTest extends TestCase
{
    /**
     *
     */
    public function testFactory()
    {
        /** @var ContainerInterface|ObjectProphecy $container */
        $container = $this->prophesize(ContainerInterface::class);

        /** @var Application|ObjectProphecy $application */
        $application = $this->prophesize(Application::class);

        /** @var MethodProphecy $pipeMethod */
        $pipeMethod = $application->pipe(OriginalMessages::class);
        $pipeMethod->shouldBeCalled();

        /** @var MethodProphecy $pipeMethod */
        $pipeMethod = $application->pipe(ErrorHandler::class);
        $pipeMethod->shouldBeCalled();

        /** @var MethodProphecy $pipeMethod */
        $pipeMethod = $application->pipeRoutingMiddleware();
        $pipeMethod->shouldBeCalled();

        /** @var MethodProphecy $pipeMethod */
        $pipeMethod = $application->pipe(ConfigureSkillMiddleware::class);
        $pipeMethod->shouldBeCalled();

        /** @var MethodProphecy $pipeMethod */
        $pipeMethod = $application->pipe(LogAlexaRequestMiddleware::class);
        $pipeMethod->shouldBeCalled();

        /** @var MethodProphecy $pipeMethod */
        $pipeMethod = $application->pipe(CheckApplicationMiddleware::class);
        $pipeMethod->shouldBeCalled();

        /** @var MethodProphecy $pipeMethod */
        $pipeMethod = $application->pipe(ValidateCertificateMiddleware::class);
        $pipeMethod->shouldBeCalled();

        /** @var MethodProphecy $pipeMethod */
        $pipeMethod = $application->pipe(SetLocaleMiddleware::class);
        $pipeMethod->shouldBeCalled();

        /** @var MethodProphecy $pipeMethod */
        $pipeMethod = $application->pipe(ImplicitHeadMiddleware::class);
        $pipeMethod->shouldBeCalled();

        /** @var MethodProphecy $pipeMethod */
        $pipeMethod = $application->pipe(ImplicitOptionsMiddleware::class);
        $pipeMethod->shouldBeCalled();

        /** @var MethodProphecy $pipeMethod */
        $pipeMethod = $application->pipeDispatchMiddleware();
        $pipeMethod->shouldBeCalled();

        /** @var MethodProphecy $pipeMethod */
        $pipeMethod = $application->pipe(NotFoundHandler::class);
        $pipeMethod->shouldBeCalled();

        $callable = function () use ($application) {
            return $application->reveal();
        };

        $factory = new PipelineDelegatorFactory();

        $applicationReturn = $factory($container->reveal(), Application::class, $callable);

        $this->assertEquals($applicationReturn, $application->reveal());
    }
}
