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

use Hello\Application\Helper\HelloTextHelperInterface;
use TravelloAlexaLibrary\Application\AbstractAlexaApplication;

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
}
