<?php
/**
 * PHP skeleton application for Amazon Alexa Skills
 *
 * @author     Ralf Eggert <ralf@travello.audio>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/travello-gmbh/amazon-alexa-skill-skeleton
 * @link       https://www.travello.audio/
 */

namespace HelloTest\Application\Helper;

use Hello\Application\Helper\HelloTextHelper;
use PHPUnit\Framework\TestCase;

/**
 * Class HelloTextHelperTest
 *
 * @package HelloTest\Application\Helper
 */
class HelloTextHelperTest extends TestCase
{
    /**
     *
     */
    public function testHelloMessage()
    {
        $helloTextHelper = new HelloTextHelper(
            [
                'en-US' => include __DIR__ . '/TestAssets/test.common.texts.php'
            ]
        );

        $helloMessage = $helloTextHelper->getHelloMessage();

        $expectedMessage = 'hello message';

        $this->assertEquals($helloMessage, $expectedMessage);
    }

    /**
     *
     */
    public function testHelloTitle()
    {
        $helloTextHelper = new HelloTextHelper(
            [
                'en-US' => include __DIR__ . '/TestAssets/test.common.texts.php'
            ]
        );

        $helloTitle = $helloTextHelper->getHelloTitle();

        $expectedTitle = 'hello title';

        $this->assertEquals($helloTitle, $expectedTitle);
    }
}
