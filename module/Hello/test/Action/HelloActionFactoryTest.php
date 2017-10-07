<?php
/**
 * PHP skeleton application for Amazon Alexa Skills
 *
 * @author     Ralf Eggert <ralf@travello.audio>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/travello-gmbh/amazon-alexa-skill-skeleton
 * @link       https://www.travello.audio/
 */

namespace HelloTest\Action;

use Interop\Container\ContainerInterface;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\MethodProphecy;
use Prophecy\Prophecy\ObjectProphecy;
use Hello\Action\HelloAction;
use Hello\Action\HelloActionFactory;
use Hello\Application\HelloApplication;

/**
 * Class HelloActionFactoryTest
 *
 * @package HelloTest\Action
 */
class HelloActionFactoryTest extends TestCase
{
    /**
     *
     */
    public function testFactory()
    {
        /** @var ObjectProphecy|HelloApplication $helloApplication */
        $helloApplication = $this->prophesize(HelloApplication::class);

        /** @var ContainerInterface|ObjectProphecy $container */
        $container = $this->prophesize(ContainerInterface::class);

        /** @var MethodProphecy $getMethod */
        $getMethod = $container->get(HelloApplication::class);
        $getMethod->shouldBeCalled()->willReturn($helloApplication->reveal());

        $helloActionFactory = new HelloActionFactory();

        $helloAction = $helloActionFactory(
            $container->reveal(), HelloAction::class
        );

        $this->assertInstanceOf(HelloAction::class, $helloAction);
    }
}
