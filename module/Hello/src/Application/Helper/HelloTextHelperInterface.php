<?php
/**
 * PHP skeleton application for Amazon Alexa Skills
 *
 * @author     Ralf Eggert <ralf@travello.audio>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/travello-gmbh/amazon-alexa-skill-skeleton
 * @link       https://www.travello.audio/
 */

namespace Hello\Application\Helper;

use TravelloAlexaLibrary\Application\Helper\TextHelperInterface;

/**
 * Class HelloTextHelper
 *
 * @package Hello\Application\Helper
 */
interface HelloTextHelperInterface extends TextHelperInterface
{
    /**
     * Get a hello message
     *
     * @return string
     */
    public function getHelloMessage(): string;

    /**
     * Get the hello title
     *
     * @return string
     */
    public function getHelloTitle(): string;
}
