<?php
/**
 * PHP skeleton application for Amazon Alexa Skills
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/travello-gmbh/amazon-alexa-skill-skeleton
 * @link       https://www.travello.de/
 */

namespace Hello\Application\Helper;

use TravelloAlexaLibrary\Application\Helper\AbstractTextHelper;

/**
 * Class HelloTextHelper
 *
 * @package Hello\Application\Helper
 */
class HelloTextHelper extends AbstractTextHelper implements HelloTextHelperInterface
{
    public function getHelloMessage(): string
    {
        return $this->commonTexts[$this->locale]['alexaHelloMessage'];
    }

    public function getHelloTitle(): string
    {
        return $this->commonTexts[$this->locale]['alexaHelloTitle'];
    }
}
