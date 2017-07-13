<?php
/**
 * PHP skeleton application for Amazon Alexa Skills
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/travello-gmbh/amazon-alexa-skill-skeleton
 * @link       https://www.travello.de/
 */

namespace HelloTest\Application\Helper;

use PHPUnit\Framework\TestCase;
use Hello\Application\Helper\HelloTextHelper;

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
            include __DIR__ . '/TestAssets/test.common.texts.php'
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
            include __DIR__ . '/TestAssets/test.common.texts.php'
        );

        $helloTitle = $helloTextHelper->getHelloTitle();

        $expectedTitle = 'hello title';

        $this->assertEquals($helloTitle, $expectedTitle);
    }
}
