<?php
/**
 * PHP skeleton application for Amazon Alexa Skills
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/travello-gmbh/amazon-alexa-skill-skeleton
 * @link       https://www.travello.de/
 */

namespace HelloTest;

use PHPUnit\Framework\TestCase;
use Hello\ConfigProvider;

/**
 * Class ConfigProviderTest
 *
 * @package HelloTest
 */
class ConfigProviderTest extends TestCase
{
    /**
     *
     */
    public function testConfiguration()
    {
        $configProvider = new ConfigProvider();

        $configData = $configProvider();

        $this->assertTrue(is_array($configData));

        $this->assertArrayHasKey('dependencies', $configData);
        $this->assertArrayHasKey('templates', $configData);
    }
}
