<?php
/**
 * PHP skeleton application for Amazon Alexa Skills
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/travello-gmbh/amazon-alexa-skill-skeleton
 * @link       https://www.travello.de/
 */

namespace Hello\Application;

use TravelloAlexaLibrary\Application\AbstractAlexaApplication;
use TravelloAlexaLibrary\Request\RequestType\IntentRequestType;
use TravelloAlexaLibrary\Response\Card\Standard;
use TravelloAlexaLibrary\Response\OutputSpeech\SSML;
use Hello\Application\Helper\HelloTextHelperInterface;

/**
 * Class HelloApplication
 *
 * @package Hello\Application
 */
class HelloApplication extends AbstractAlexaApplication
{
    /** @var string */
    protected $applicationId = 'amzn1.ask.skill.place-your-skill-id-here';

    /** @var string */
    protected $smallImageUrl = 'https://www.travello.audio/cards/hello-480x480.png';

    /** @var string */
    protected $largeImageUrl = 'https://www.travello.audio/cards/hello-800x800.png';

    /** @var HelloTextHelperInterface */
    protected $textHelper;

    /**
     * Initialize the attributes
     *
     * @return bool
     */
    protected function initSessionAttributes(): bool
    {
        return true;
    }

    /**
     * Get the session attributes
     *
     * @return array
     */
    protected function getSessionAttributes(): array
    {
        return [];
    }

    /**
     * Reset the session attributes
     */
    protected function resetSessionAttributes()
    {
    }

    /**
     * Handle custom application intents
     *
     * @return bool
     */
    protected function handleIntentRequest(): bool
    {
        /** @var IntentRequestType $intentRequest */
        $intentRequest = $this->alexaRequest->getRequest();

        switch ($intentRequest->getIntent()->getName()) {
            case 'HelloIntent':
                return $this->helloIntent();
            // no break

            case 'AMAZON.StopIntent':
                return $this->stopIntent();
            // no break

            case 'AMAZON.CancelIntent':
                return $this->cancelIntent();
            // no break

            case 'AMAZON.HelpIntent':
            default:
                return $this->helpIntent();
        }
    }

    /**
     * Handle the greet intent
     *
     * @return bool
     */
    private function helloIntent(): bool
    {
        $helloMessage = $this->textHelper->getHelloMessage();

        $this->alexaResponse->setOutputSpeech(
            new SSML($helloMessage)
        );

        $this->alexaResponse->setCard(
            new Standard(
                $this->textHelper->getHelloTitle(),
                $helloMessage,
                $this->smallImageUrl,
                $this->largeImageUrl
            )
        );

        return true;
    }
}
