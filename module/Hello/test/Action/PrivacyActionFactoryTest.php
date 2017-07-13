<?php
/**
 * PHP skeleton application for Amazon Alexa Skills
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/travello-gmbh/amazon-alexa-skill-skeleton
 * @link       https://www.travello.de/
 */

namespace HelloTest\Action;

use Interop\Container\ContainerInterface;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\MethodProphecy;
use Prophecy\Prophecy\ObjectProphecy;
use Hello\Action\PrivacyAction;
use Hello\Action\PrivacyActionFactory;
use Zend\Expressive\Template\TemplateRendererInterface;

/**
 * Class PrivacyActionFactoryTest
 *
 * @package HelloTest\Action
 */
class PrivacyActionFactoryTest extends TestCase
{
    /**
     *
     */
    public function testFactory()
    {
        /** @var ObjectProphecy|TemplateRendererInterface $template */
        $template = $this->prophesize(TemplateRendererInterface::class);

        /** @var ContainerInterface|ObjectProphecy $container */
        $container = $this->prophesize(ContainerInterface::class);

        /** @var MethodProphecy $getMethod */
        $getMethod = $container->get(TemplateRendererInterface::class);
        $getMethod->shouldBeCalled()->willReturn($template->reveal());

        $privacyActionFactory = new PrivacyActionFactory();

        $privacyAction = $privacyActionFactory(
            $container->reveal(), PrivacyAction::class
        );

        $this->assertInstanceOf(PrivacyAction::class, $privacyAction);
    }
}
