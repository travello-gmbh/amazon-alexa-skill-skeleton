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

use Interop\Http\ServerMiddleware\DelegateInterface;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\MethodProphecy;
use Prophecy\Prophecy\ObjectProphecy;
use Hello\Action\PrivacyAction;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\ServerRequest;
use Zend\Expressive\Template\TemplateRendererInterface;

/**
 * Class PrivacyActionTest
 *
 * @package HelloTest\Action
 */
class PrivacyActionTest extends TestCase
{
    /**
     *
     */
    public function testResponseForNormalRequest()
    {
        /** @var ObjectProphecy|TemplateRendererInterface $template */
        $template = $this->prophesize(TemplateRendererInterface::class);

        /** @var MethodProphecy $renderMethod */
        $renderMethod = $template->render('hello::privacy', []);
        $renderMethod->shouldBeCalled()->willReturn('Template');

        $privacyAction = new PrivacyAction($template->reveal());

        $request = new ServerRequest(['/']);

        /** @var DelegateInterface $delegate */
        $delegate = $this->prophesize(DelegateInterface::class)->reveal();

        /** @var Response $response */
        $response = $privacyAction->process($request, $delegate);

        $this->assertTrue($response instanceof Response);
        $this->assertTrue($response instanceof HtmlResponse);

        $this->assertEquals(
            'Template',
            $response->getBody()
        );

        $this->assertEquals(200, $response->getStatusCode());
    }
}
