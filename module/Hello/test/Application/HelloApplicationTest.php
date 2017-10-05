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

use Hello\Application\HelloApplication;
use Hello\Intent\HelloIntent;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\MethodProphecy;
use Prophecy\Prophecy\ObjectProphecy;
use Psr\Container\ContainerInterface;
use TravelloAlexaLibrary\Configuration\SkillConfigurationInterface;
use TravelloAlexaLibrary\Intent\HelpIntent;
use TravelloAlexaLibrary\Intent\StopIntent;
use TravelloAlexaLibrary\Request\RequestType\RequestTypeFactory;
use TravelloAlexaLibrary\Response\AlexaResponse;
use TravelloAlexaLibrary\TextHelper\TextHelper;

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

        $alexaRequest  = RequestTypeFactory::createFromData(json_encode($data));
        $alexaResponse = new AlexaResponse();
        $textHelper    = new TextHelper();

        /** @var ContainerInterface|ObjectProphecy $intentManager */
        $intentManager = $this->prophesize(ContainerInterface::class);

        /** @var MethodProphecy $hasMethod */
        $hasMethod = $intentManager->has(HelloIntent::NAME);
        $hasMethod->shouldBeCalled()->willReturn(true);

        /** @var MethodProphecy $getMethod */
        $getMethod = $intentManager->get(HelloIntent::NAME);
        $getMethod->shouldBeCalled()->willReturn(new HelloIntent($alexaRequest, $alexaResponse, $textHelper));

        $skillConfiguration = $this->prophesize(SkillConfigurationInterface::class);

        /** @var MethodProphecy $getSmallImageUrlMethod */
        $getSmallImageUrlMethod = $skillConfiguration->getSmallImageUrl();
        $getSmallImageUrlMethod->shouldBeCalled()->willReturn('https://www.travello.audio/cards/hello-480x480.png');

        /** @var MethodProphecy $getLargeImageUrlMethod */
        $getLargeImageUrlMethod = $skillConfiguration->getLargeImageUrl();
        $getLargeImageUrlMethod->shouldBeCalled()->willReturn('https://www.travello.audio/cards/hello-800x800.png');

        $application = new HelloApplication(
            $alexaRequest,
            $alexaResponse,
            $intentManager->reveal(),
            $skillConfiguration->reveal()
        );

        $result = $application->execute();

        $expected = [
            'version'           => '1.0',
            'sessionAttributes' => [],
            'response'          => [
                'outputSpeech'     => [
                    'type' => 'SSML',
                    'ssml' => '<speak>helloMessage</speak>',
                ],
                'card'             => [
                    'type'  => 'Standard',
                    'title' => 'helloTitle',
                    'text'  => 'helloMessage',
                    'image' => [
                        'smallImageUrl' => 'https://www.travello.audio/cards/hello-480x480.png',
                        'largeImageUrl' => 'https://www.travello.audio/cards/hello-800x800.png',
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

        $alexaRequest  = RequestTypeFactory::createFromData(json_encode($data));
        $alexaResponse = new AlexaResponse();
        $textHelper    = new TextHelper();

        /** @var ContainerInterface|ObjectProphecy $intentManager */
        $intentManager = $this->prophesize(ContainerInterface::class);

        /** @var MethodProphecy $hasMethod */
        $hasMethod = $intentManager->has(HelpIntent::NAME);
        $hasMethod->shouldBeCalled()->willReturn(true);

        /** @var MethodProphecy $getMethod */
        $getMethod = $intentManager->get(HelpIntent::NAME);
        $getMethod->shouldBeCalled()->willReturn(new HelpIntent($alexaRequest, $alexaResponse, $textHelper));

        $skillConfiguration = $this->prophesize(SkillConfigurationInterface::class);

        /** @var MethodProphecy $getSmallImageUrlMethod */
        $getSmallImageUrlMethod = $skillConfiguration->getSmallImageUrl();
        $getSmallImageUrlMethod->shouldBeCalled()->willReturn('https://www.travello.audio/cards/hello-480x480.png');

        /** @var MethodProphecy $getLargeImageUrlMethod */
        $getLargeImageUrlMethod = $skillConfiguration->getLargeImageUrl();
        $getLargeImageUrlMethod->shouldBeCalled()->willReturn('https://www.travello.audio/cards/hello-800x800.png');

        $application = new HelloApplication(
            $alexaRequest,
            $alexaResponse,
            $intentManager->reveal(),
            $skillConfiguration->reveal()
        );

        $result = $application->execute();

        $expected = [
            'version'           => '1.0',
            'sessionAttributes' => [],
            'response'          => [
                'outputSpeech'     => [
                    'type' => 'SSML',
                    'ssml' => '<speak>helpMessage</speak>',
                ],
                'card'             => [
                    'type'  => 'Standard',
                    'title' => 'helpTitle',
                    'text'  => 'helpMessage',
                    'image' => [
                        'smallImageUrl' => 'https://www.travello.audio/cards/hello-480x480.png',
                        'largeImageUrl' => 'https://www.travello.audio/cards/hello-800x800.png',
                    ],
                ],
                'reprompt'         => [
                    'outputSpeech' => [
                        'type' => 'SSML',
                        'ssml' => '<speak>repromptMessage</speak>',
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

        $alexaRequest  = RequestTypeFactory::createFromData(json_encode($data));
        $alexaResponse = new AlexaResponse();
        $textHelper    = new TextHelper();

        /** @var ContainerInterface|ObjectProphecy $intentManager */
        $intentManager = $this->prophesize(ContainerInterface::class);

        /** @var MethodProphecy $hasMethod */
        $hasMethod = $intentManager->has(StopIntent::NAME);
        $hasMethod->shouldBeCalled()->willReturn(true);

        /** @var MethodProphecy $getMethod */
        $getMethod = $intentManager->get(StopIntent::NAME);
        $getMethod->shouldBeCalled()->willReturn(new StopIntent($alexaRequest, $alexaResponse, $textHelper));

        $skillConfiguration = $this->prophesize(SkillConfigurationInterface::class);

        /** @var MethodProphecy $getSmallImageUrlMethod */
        $getSmallImageUrlMethod = $skillConfiguration->getSmallImageUrl();
        $getSmallImageUrlMethod->shouldBeCalled()->willReturn('https://www.travello.audio/cards/hello-480x480.png');

        /** @var MethodProphecy $getLargeImageUrlMethod */
        $getLargeImageUrlMethod = $skillConfiguration->getLargeImageUrl();
        $getLargeImageUrlMethod->shouldBeCalled()->willReturn('https://www.travello.audio/cards/hello-800x800.png');

        $application = new HelloApplication(
            $alexaRequest,
            $alexaResponse,
            $intentManager->reveal(),
            $skillConfiguration->reveal()
        );

        $result = $application->execute();

        $expected = [
            'version'           => '1.0',
            'sessionAttributes' => [],
            'response'          => [
                'outputSpeech'     => [
                    'type' => 'SSML',
                    'ssml' => '<speak>stopMessage</speak>',
                ],
                'card'             => [
                    'type'  => 'Standard',
                    'title' => 'stopTitle',
                    'text'  => 'stopMessage',
                    'image' => [
                        'smallImageUrl' => 'https://www.travello.audio/cards/hello-480x480.png',
                        'largeImageUrl' => 'https://www.travello.audio/cards/hello-800x800.png',
                    ],
                ],
                'shouldEndSession' => true,
            ],
        ];

        $this->assertEquals($expected, $result);
    }
}
