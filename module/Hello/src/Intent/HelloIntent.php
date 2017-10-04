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

use Hello\Application\Helper\HelloTextHelper;
use TravelloAlexaLibrary\Application\Helper\TextHelperInterface;
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
     * @param TextHelperInterface|HelloTextHelper $textHelper
     * @param string                              $smallImageUrl
     * @param string                              $largeImageUrl
     *
     * @return AlexaResponse
     */
    public function handle(
        TextHelperInterface $textHelper,
        string $smallImageUrl,
        string $largeImageUrl
    ): AlexaResponse {
        $title   = $textHelper->getHelloTitle();
        $message = $textHelper->getHelloMessage();

        $this->getAlexaResponse()->setOutputSpeech(
            new SSML($message)
        );

        $this->getAlexaResponse()->setCard(
            new Standard($title, $message, $smallImageUrl, $largeImageUrl)
        );

        return $this->getAlexaResponse();
    }
}
