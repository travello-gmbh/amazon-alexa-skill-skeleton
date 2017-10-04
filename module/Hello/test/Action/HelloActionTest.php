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

use Exception;
use Interop\Http\ServerMiddleware\DelegateInterface;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\MethodProphecy;
use Prophecy\Prophecy\ObjectProphecy;
use TravelloAlexaLibrary\Request\AlexaRequest;
use TravelloAlexaLibrary\Request\AlexaRequestInterface;
use TravelloAlexaLibrary\Request\Certificate\CertificateValidator;
use TravelloAlexaLibrary\Request\Certificate\CertificateValidatorInterface;
use TravelloAlexaLibrary\Request\Exception\BadRequest;
use Hello\Action\HelloAction;
use Hello\Application\HelloApplication;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Diactoros\ServerRequest;

/**
 * Class HelloActionTest
 *
 * @package HelloTest\Action
 */
class HelloActionTest extends TestCase
{
    /**
     *
     */
    public function testResponseForInvalidRequest()
    {
        /** @var ObjectProphecy|AlexaRequest $alexaRequest */
        $alexaRequest = $this->prophesize(AlexaRequestInterface::class);

        /** @var ObjectProphecy|CertificateValidatorInterface $certificateValidator */
        $certificateValidator = $this->prophesize(
            CertificateValidatorInterface::class
        );

        /** @var ObjectProphecy|HelloApplication $helloApplication */
        $helloApplication = $this->prophesize(HelloApplication::class);

        /** @var MethodProphecy $setAlexaRequestMethod */
        $setAlexaRequestMethod = $helloApplication->setAlexaRequest(
            $alexaRequest->reveal()
        );
        $setAlexaRequestMethod->shouldBeCalled();

        /** @var MethodProphecy $setCertificateValidatorMethod */
        $setCertificateValidatorMethod = $helloApplication
            ->setCertificateValidator(
                $certificateValidator->reveal()
            );
        $setCertificateValidatorMethod->shouldBeCalled();

        /** @var MethodProphecy $executeMethod */
        $executeMethod = $helloApplication->execute();
        $executeMethod->shouldBeCalled()->willThrow(
            new BadRequest('Just another error')
        );

        $helloAction = new HelloAction($helloApplication->reveal());

        $request = new ServerRequest(['/']);
        $request = $request->withAttribute(
            AlexaRequest::NAME,
            $alexaRequest->reveal()
        );
        $request = $request->withAttribute(
            CertificateValidator::NAME,
            $certificateValidator->reveal()
        );

        /** @var DelegateInterface $delegate */
        $delegate = $this->prophesize(DelegateInterface::class)->reveal();

        /** @var Response $response */
        $response = $helloAction->process($request, $delegate);

        $this->assertTrue($response instanceof Response);
        $this->assertTrue($response instanceof JsonResponse);

        $this->assertEquals(
            ['error' => 'Just another error'],
            json_decode((string)$response->getBody(), true)
        );

        $this->assertEquals(400, $response->getStatusCode());
    }

    /**
     *
     */
    public function testResponseForUnknownError()
    {
        /** @var ObjectProphecy|AlexaRequest $alexaRequest */
        $alexaRequest = $this->prophesize(AlexaRequestInterface::class);

        /** @var ObjectProphecy|CertificateValidatorInterface $certificateValidator */
        $certificateValidator = $this->prophesize(
            CertificateValidatorInterface::class
        );

        /** @var ObjectProphecy|HelloApplication $helloApplication */
        $helloApplication = $this->prophesize(HelloApplication::class);

        /** @var MethodProphecy $setAlexaRequestMethod */
        $setAlexaRequestMethod = $helloApplication->setAlexaRequest(
            $alexaRequest->reveal()
        );
        $setAlexaRequestMethod->shouldBeCalled();

        /** @var MethodProphecy $setCertificateValidatorMethod */
        $setCertificateValidatorMethod = $helloApplication
            ->setCertificateValidator(
                $certificateValidator->reveal()
            );
        $setCertificateValidatorMethod->shouldBeCalled();

        /** @var MethodProphecy $executeMethod */
        $executeMethod = $helloApplication->execute();
        $executeMethod->shouldBeCalled()->willThrow(
            new Exception('Just another error')
        );

        $helloAction = new HelloAction($helloApplication->reveal());

        $request = new ServerRequest(['/']);
        $request = $request->withAttribute(
            AlexaRequest::NAME,
            $alexaRequest->reveal()
        );
        $request = $request->withAttribute(
            CertificateValidator::NAME,
            $certificateValidator->reveal()
        );

        /** @var DelegateInterface $delegate */
        $delegate = $this->prophesize(DelegateInterface::class)->reveal();

        /** @var Response $response */
        $response = $helloAction->process($request, $delegate);

        $this->assertTrue($response instanceof Response);
        $this->assertTrue($response instanceof JsonResponse);

        $this->assertEquals(
            ['error' => 'unknown error'],
            json_decode((string)$response->getBody(), true)
        );

        $this->assertEquals(400, $response->getStatusCode());
    }

    /**
     *
     */
    public function testResponseForValidRequest()
    {
        /** @var ObjectProphecy|AlexaRequest $alexaRequest */
        $alexaRequest = $this->prophesize(AlexaRequestInterface::class);

        /** @var ObjectProphecy|CertificateValidatorInterface $certificateValidator */
        $certificateValidator = $this->prophesize(
            CertificateValidatorInterface::class
        );

        /** @var ObjectProphecy|HelloApplication $helloApplication */
        $helloApplication = $this->prophesize(HelloApplication::class);

        /** @var MethodProphecy $setAlexaRequestMethod */
        $setAlexaRequestMethod = $helloApplication->setAlexaRequest(
            $alexaRequest->reveal()
        );
        $setAlexaRequestMethod->shouldBeCalled();

        /** @var MethodProphecy $setCertificateValidatorMethod */
        $setCertificateValidatorMethod = $helloApplication
            ->setCertificateValidator(
                $certificateValidator->reveal()
            );
        $setCertificateValidatorMethod->shouldBeCalled();

        /** @var MethodProphecy $executeMethod */
        $executeMethod = $helloApplication->execute();
        $executeMethod->shouldBeCalled()->willReturn(['foo' => 'bar']);

        $helloAction = new HelloAction($helloApplication->reveal());

        $request = new ServerRequest(['/']);
        $request = $request->withAttribute(
            AlexaRequest::NAME,
            $alexaRequest->reveal()
        );
        $request = $request->withAttribute(
            CertificateValidator::NAME,
            $certificateValidator->reveal()
        );

        /** @var DelegateInterface $delegate */
        $delegate = $this->prophesize(DelegateInterface::class)->reveal();

        /** @var Response $response */
        $response = $helloAction->process($request, $delegate);

        $this->assertTrue($response instanceof Response);
        $this->assertTrue($response instanceof JsonResponse);

        $this->assertEquals(
            ['foo' => 'bar'],
            json_decode((string)$response->getBody(), true)
        );

        $this->assertEquals(200, $response->getStatusCode());
    }
}
