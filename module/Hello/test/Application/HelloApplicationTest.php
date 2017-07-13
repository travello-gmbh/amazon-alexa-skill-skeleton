<?php
/**
 * PHP skeleton application for Amazon Alexa Skills
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/travello-gmbh/amazon-alexa-skill-skeleton
 * @link       https://www.travello.de/
 */

namespace HelloTest\Application;

use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\MethodProphecy;
use Prophecy\Prophecy\ObjectProphecy;
use TravelloAlexaLibrary\Request\Certificate\CertificateValidatorInterface;
use TravelloAlexaLibrary\Request\RequestType\RequestTypeFactory;
use Hello\Application\Helper\HelloTextHelper;
use Hello\Application\HelloApplication;

/**
 * Class HelloApplicationTest
 *
 * @package HelloTest\Application
 */
class HelloApplicationTest extends TestCase
{
    /**
     *
     */
    public function testHelloIntent()
    {
        $data = [
            'version' => '1.0',
            'session' => [
                'new'         => true,
                'sessionId'   => 'sessionId',
                'application' => [
                    'applicationId' => 'amzn1.ask.skill.place-your-skill-id-here',
                ],
                'attributes'  => [],
                'user'        => [
                    'userId' => 'userId',
                ],
            ],
            'request' => [
                'type'      => 'IntentRequest',
                'requestId' => 'requestId',
                'timestamp' => '2017-01-27T20:29:59Z',
                'locale'    => 'de-DE',
                'intent'    => [
                    'name'  => 'HelloIntent',
                    'slots' => [],
                ],
            ],
        ];

        $alexaRequest = RequestTypeFactory::createFromData(json_encode($data));

        /** @var CertificateValidatorInterface|ObjectProphecy $certificateValidator */
        $certificateValidator = $this->prophesize(
            CertificateValidatorInterface::class
        );

        /** @var MethodProphecy $validateMethod */
        $validateMethod = $certificateValidator->validate();
        $validateMethod->shouldBeCalled()->willReturn(true);

        /** @var ObjectProphecy|HelloTextHelper $helloTextHelper */
        $helloTextHelper = $this->prophesize(HelloTextHelper::class);
        $helloTextHelper->getRepromptMessage()->shouldBeCalled()->willReturn(
            'reprompt message'
        );
        $helloTextHelper->getHelloMessage()->shouldBeCalled()
            ->willReturn(
                'greet message'
            );
        $helloTextHelper->getHelloTitle()->shouldBeCalled()->willReturn(
            'greet title'
        );

        $application = new HelloApplication(
            $helloTextHelper->reveal()
        );
        $application->setAlexaRequest($alexaRequest);
        $application->setCertificateValidator($certificateValidator->reveal());

        $result = $application->execute();

        $expected = [
            'version'           => '1.0',
            'sessionAttributes' => [],
            'response'          => [
                'outputSpeech'     => [
                    'type' => 'SSML',
                    'ssml' => '<speak>greet message</speak>',
                ],
                'card'             => [
                    'type'  => 'Standard',
                    'title' => 'greet title',
                    'text'  => 'greet message',
                    'image' => [
                        'smallImageUrl' => 'https://www.travello.audio/cards/hello-480x480.png',
                        'largeImageUrl' => 'https://www.travello.audio/cards/hello-800x800.png',
                    ],
                ],
                'reprompt'         => [
                    'outputSpeech' => [
                        'type' => 'SSML',
                        'ssml' => '<speak>reprompt message</speak>',
                    ],
                ],
                'shouldEndSession' => false,
            ],
        ];

        $this->assertEquals($expected, $result);
    }

    /**
     *
     */
    public function testHelpIntent()
    {
        $data = [
            'version' => '1.0',
            'session' => [
                'new'         => true,
                'sessionId'   => 'sessionId',
                'application' => [
                    'applicationId' => 'amzn1.ask.skill.place-your-skill-id-here',
                ],
                'attributes'  => [],
                'user'        => [
                    'userId' => 'userId',
                ],
            ],
            'request' => [
                'type'      => 'IntentRequest',
                'requestId' => 'requestId',
                'timestamp' => '2017-01-27T20:29:59Z',
                'locale'    => 'de-DE',
                'intent'    => [
                    'name'  => 'AMAZON.HelpIntent',
                    'slots' => [],
                ],
            ],
        ];

        $alexaRequest = RequestTypeFactory::createFromData(json_encode($data));

        /** @var CertificateValidatorInterface|ObjectProphecy $certificateValidator */
        $certificateValidator = $this->prophesize(
            CertificateValidatorInterface::class
        );

        /** @var MethodProphecy $validateMethod */
        $validateMethod = $certificateValidator->validate();
        $validateMethod->shouldBeCalled()->willReturn(true);

        /** @var ObjectProphecy|HelloTextHelper $helloTextHelper */
        $helloTextHelper = $this->prophesize(HelloTextHelper::class);
        $helloTextHelper->getRepromptMessage()->shouldBeCalled()->willReturn(
            'reprompt message'
        );
        $helloTextHelper->getHelpMessage()->shouldBeCalled()->willReturn(
            'help message'
        );
        $helloTextHelper->getHelpTitle()->shouldBeCalled()->willReturn(
            'help title'
        );

        $application = new HelloApplication(
            $helloTextHelper->reveal()
        );
        $application->setAlexaRequest($alexaRequest);
        $application->setCertificateValidator($certificateValidator->reveal());

        $result = $application->execute();

        $expected = [
            'version'           => '1.0',
            'sessionAttributes' => [],
            'response'          => [
                'outputSpeech'     => [
                    'type' => 'SSML',
                    'ssml' => '<speak>help message</speak>',
                ],
                'card'             => [
                    'type'  => 'Standard',
                    'title' => 'help title',
                    'text'  => 'help message',
                    'image' => [
                        'smallImageUrl' => 'https://www.travello.audio/cards/hello-480x480.png',
                        'largeImageUrl' => 'https://www.travello.audio/cards/hello-800x800.png',
                    ],
                ],
                'reprompt'         => [
                    'outputSpeech' => [
                        'type' => 'SSML',
                        'ssml' => '<speak>reprompt message</speak>',
                    ],
                ],
                'shouldEndSession' => false,
            ],
        ];

        $this->assertEquals($expected, $result);
    }

    /**
     *
     */
    public function testStopIntent()
    {
        $data = [
            'version' => '1.0',
            'session' => [
                'new'         => true,
                'sessionId'   => 'sessionId',
                'application' => [
                    'applicationId' => 'amzn1.ask.skill.place-your-skill-id-here',
                ],
                'attributes'  => [],
                'user'        => [
                    'userId' => 'userId',
                ],
            ],
            'request' => [
                'type'      => 'IntentRequest',
                'requestId' => 'requestId',
                'timestamp' => '2017-01-27T20:29:59Z',
                'locale'    => 'de-DE',
                'intent'    => [
                    'name'  => 'AMAZON.StopIntent',
                    'slots' => [],
                ],
            ],
        ];

        $alexaRequest = RequestTypeFactory::createFromData(json_encode($data));

        /** @var CertificateValidatorInterface|ObjectProphecy $certificateValidator */
        $certificateValidator = $this->prophesize(
            CertificateValidatorInterface::class
        );

        /** @var MethodProphecy $validateMethod */
        $validateMethod = $certificateValidator->validate();
        $validateMethod->shouldBeCalled()->willReturn(true);

        /** @var ObjectProphecy|HelloTextHelper $helloTextHelper */
        $helloTextHelper = $this->prophesize(HelloTextHelper::class);
        $helloTextHelper->getRepromptMessage()->shouldBeCalled()->willReturn(
            'reprompt message'
        );
        $helloTextHelper->getStopMessage()->shouldBeCalled()->willReturn(
            'stop message'
        );
        $helloTextHelper->getStopTitle()->shouldBeCalled()->willReturn(
            'stop title'
        );

        $application = new HelloApplication(
            $helloTextHelper->reveal()
        );
        $application->setAlexaRequest($alexaRequest);
        $application->setCertificateValidator($certificateValidator->reveal());

        $result = $application->execute();

        $expected = [
            'version'           => '1.0',
            'sessionAttributes' => [],
            'response'          => [
                'outputSpeech'     => [
                    'type' => 'SSML',
                    'ssml' => '<speak>stop message</speak>',
                ],
                'card'             => [
                    'type'  => 'Standard',
                    'title' => 'stop title',
                    'text'  => 'stop message',
                    'image' => [
                        'smallImageUrl' => 'https://www.travello.audio/cards/hello-480x480.png',
                        'largeImageUrl' => 'https://www.travello.audio/cards/hello-800x800.png',
                    ],
                ],
                'reprompt'         => [
                    'outputSpeech' => [
                        'type' => 'SSML',
                        'ssml' => '<speak>reprompt message</speak>',
                    ],
                ],
                'shouldEndSession' => true,
            ],
        ];

        $this->assertEquals($expected, $result);
    }
}
