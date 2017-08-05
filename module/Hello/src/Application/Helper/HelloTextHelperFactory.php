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

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class HelloTextHelperFactory
 *
 * @package Hello\Application\Helper
 */
class HelloTextHelperFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string             $requestedName
     * @param array|null|null    $options
     *
     * @return HelloTextHelper
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): HelloTextHelper
    {
        return new HelloTextHelper(
            [
                'en-US' => include PROJECT_ROOT . '/data/texts/hello.common.texts.en-US.php',
                'en-UK' => include PROJECT_ROOT . '/data/texts/hello.common.texts.en-UK.php',
                'de-DE' => include PROJECT_ROOT . '/data/texts/hello.common.texts.de-DE.php',
            ]
        );
    }
}
