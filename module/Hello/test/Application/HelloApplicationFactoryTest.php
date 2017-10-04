<?php
/**
 * PHP skeleton application for Amazon Alexa Skills
 *
 * @author     Ralf Eggert <ralf@travello.audio>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/travello-gmbh/amazon-alexa-skill-skeleton
 * @link       https://www.travello.audio/
 */

namespace HelloTest\Application;

use Interop\Container\ContainerInterface;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\MethodProphecy;
use Prophecy\Prophecy\ObjectProphecy;
use Hello\Application\Helper\HelloTextHelper;
use Hello\Application\HelloApplication;
use Hello\Application\HelloApplicationFactory;

/**
 * Class HelloApplicationFactoryTest
 *
 * @package HelloTest\Application
 */
class HelloApplicationFactoryTest extends TestCase
{
    /**
     *
     */
    public function testFactory()
    {
        /** @var ObjectProphecy|HelloTextHelper $helloTextHelper */
        $helloTextHelper = $this->prophesize(HelloTextHelper::class);

        /** @var ContainerInterface|ObjectProphecy $container */
        $container = $this->prophesize(ContainerInterface::class);

        /** @var MethodProphecy $getMethod */
        $getMethod = $container->get(HelloTextHelper::class);
        $getMethod->shouldBeCalled()->willReturn($helloTextHelper->reveal());

        $helloApplicationFactory = new HelloApplicationFactory();

        $helloApplication = $helloApplicationFactory(
            $container->reveal(), HelloApplication::class
        );

        $this->assertInstanceOf(HelloApplication::class, $helloApplication);
    }
}
