<?php
/**
 * PHP skeleton application for Amazon Alexa Skills
 *
 * @author     Ralf Eggert <ralf@travello.audio>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/travello-gmbh/amazon-alexa-skill-skeleton
 * @link       https://www.travello.audio/
 */

namespace HelloTest\Intent;

use Hello\Intent\HelloIntent;
use PHPUnit\Framework\TestCase;
use TravelloAlexaLibrary\Intent\AbstractIntent;
use TravelloAlexaLibrary\Intent\IntentInterface;
use TravelloAlexaLibrary\Request\RequestType\RequestTypeFactory;
use TravelloAlexaLibrary\Response\AlexaResponse;
use TravelloAlexaLibrary\Session\SessionContainer;
use TravelloAlexaLibrary\TextHelper\TextHelper;

class HelloIntentTest extends TestCase
{
    /**
     * Test the instantiation of the class
     */
    public function testInstantiation()
    {
        $data = [
            'version' => '1.0',
            'session' => [
                'new'         => true,
                'sessionId'   => 'sessionId',
                'application' => [
                    'applicationId' => 'amzn1.ask.skill.applicationId',
                ],
                'user'        => [
                    'userId' => 'userId',
                ],
            ],
            'request' => [
                'type'      => 'IntentRequest',
                'requestId' => 'requestId',
                'timestamp' => '2017-01-27T20:29:59Z',
                'locale'    => 'en-US',
                'intent'    => [
                    'name'  => 'HelloIntent',
                    'slots' => [],
                ],
            ],
        ];

        $alexaRequest  = RequestTypeFactory::createFromData(json_encode($data));
        $alexaResponse = new AlexaResponse();
        $textHelper    = new TextHelper();

        $helloIntent = new HelloIntent($alexaRequest, $alexaResponse, $textHelper);

        $this->assertTrue($helloIntent instanceof AbstractIntent);
        $this->assertTrue($helloIntent instanceof IntentInterface);
    }

    /**
     * Test the handling of the intent
     */
    public function testHandle()
    {
        $data = [
            'version' => '1.0',
            'session' => [
                'new'         => true,
                'sessionId'   => 'sessionId',
                'application' => [
                    'applicationId' => 'amzn1.ask.skill.applicationId',
                ],
                'user'        => [
                    'userId' => 'userId',
                ],
                'attributes'  => [
                    'count' => 17,
                ]
            ],
            'request' => [
                'type'      => 'IntentRequest',
                'requestId' => 'requestId',
                'timestamp' => '2017-01-27T20:29:59Z',
                'locale'    => 'en-US',
                'intent'    => [
                    'name'  => 'HelloIntent',
                    'slots' => [],
                ],
            ],
        ];

        $sessionContainer = new SessionContainer(['foo' => 'bar', 'count' => 17,]);

        $alexaRequest  = RequestTypeFactory::createFromData(json_encode($data));
        $textHelper    = new TextHelper();
        $alexaResponse = new AlexaResponse();
        $alexaResponse->setSessionContainer($sessionContainer);

        $smallImageUrl = 'https://image.server/small.png';
        $largeImageUrl = 'https://image.server/large.png';

        $helloIntent = new HelloIntent($alexaRequest, $alexaResponse, $textHelper);
        $helloIntent->handle($smallImageUrl, $largeImageUrl);

        $expected = [
            'version'           => '1.0',
            'sessionAttributes' => [
                'foo'   => 'bar',
                'count' => 18,
            ],
            'response'          => [
                'outputSpeech'     => [
                    'type' => 'SSML',
                    'ssml' => '<speak>helloMessage (18)</speak>',
                ],
                'card'             => [
                    'type'  => 'Standard',
                    'title' => 'helloTitle',
                    'text'  => 'helloMessage (18)',
                    'image' => [
                        'smallImageUrl' => 'https://image.server/small.png',
                        'largeImageUrl' => 'https://image.server/large.png',
                    ],
                ],
                'shouldEndSession' => false,
            ],
        ];

        $this->assertEquals($expected, $alexaResponse->toArray());
    }
}
