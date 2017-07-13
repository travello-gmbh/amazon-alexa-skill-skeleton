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

use Interop\Container\ContainerInterface;
use Hello\Application\Helper\HelloTextHelper;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class HelloApplicationFactory
 *
 * @package Hello\Application
 */
class HelloApplicationFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string             $requestedName
     * @param array|null|null    $options
     *
     * @return HelloApplication
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): HelloApplication
    {
        $textHelper = $container->get(HelloTextHelper::class);

        return new HelloApplication($textHelper);
    }
}
