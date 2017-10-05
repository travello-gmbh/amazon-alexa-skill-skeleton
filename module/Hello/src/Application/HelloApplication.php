<?php
/**
 * PHP skeleton application for Amazon Alexa Skills
 *
 * @author     Ralf Eggert <ralf@travello.audio>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/travello-gmbh/amazon-alexa-skill-skeleton
 * @link       https://www.travello.audio/
 */

namespace Hello\Application;

use TravelloAlexaLibrary\Application\AbstractAlexaApplication;

/**
 * Class HelloApplication
 *
 * @package Hello\Application
 */
class HelloApplication extends AbstractAlexaApplication
{
    /** Name of skill for configuration */
    const NAME = 'hello-skill';

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
