<?php
/**
 * PHP skeleton application for Amazon Alexa Skills
 *
 * @author     Ralf Eggert <ralf@travello.audio>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/travello-gmbh/amazon-alexa-skill-skeleton
 * @link       https://www.travello.audio/
 */

namespace Hello\Intent;

use TravelloAlexaLibrary\Intent\AbstractIntent;
use TravelloAlexaLibrary\Response\AlexaResponse;
use TravelloAlexaLibrary\Response\Card\Standard;
use TravelloAlexaLibrary\Response\OutputSpeech\SSML;

/**
 * Class HelloIntent
 *
 * @package Hello\Intent
 */
class HelloIntent extends AbstractIntent
{
    const NAME = 'HelloIntent';

    /**
     * @param string $smallImageUrl
     * @param string $largeImageUrl
     *
     * @return AlexaResponse
     */
    public function handle(
        string $smallImageUrl,
        string $largeImageUrl
    ): AlexaResponse {
        $title   = $this->getTextHelper()->getHelloTitle();
        $message = $this->getTextHelper()->getHelloMessage();

        $this->getAlexaResponse()->setOutputSpeech(
            new SSML($message)
        );

        $this->getAlexaResponse()->setCard(
            new Standard($title, $message, $smallImageUrl, $largeImageUrl)
        );

        return $this->getAlexaResponse();
    }
}
