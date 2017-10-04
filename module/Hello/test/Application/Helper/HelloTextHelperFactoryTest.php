<?php
/**
 * PHP skeleton application for Amazon Alexa Skills
 *
 * @author     Ralf Eggert <ralf@travello.audio>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/travello-gmbh/amazon-alexa-skill-skeleton
 * @link       https://www.travello.audio/
 */

namespace HelloTest\Application\Helper;

use Interop\Container\ContainerInterface;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;
use Hello\Application\Helper\HelloTextHelper;
use Hello\Application\Helper\HelloTextHelperFactory;

/**
 * Class HelloTextHelperFactoryTest
 *
 * @package HelloTest\Application\Helper
 */
class HelloTextHelperFactoryTest extends TestCase
{
    /**
     *
     */
    public function testFactory()
    {
        /** @var ContainerInterface|ObjectProphecy $container */
        $container = $this->prophesize(ContainerInterface::class);

        $helloTextHelperFactory = new HelloTextHelperFactory();

        $helloTextHelper = $helloTextHelperFactory(
            $container->reveal(), HelloTextHelper::class
        );

        $this->assertInstanceOf(HelloTextHelper::class, $helloTextHelper);
    }
}
