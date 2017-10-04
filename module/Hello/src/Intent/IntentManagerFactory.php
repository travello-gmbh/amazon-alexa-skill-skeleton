<?php
/**
 * PHP skeleton application for Amazon Alexa Skills
 *
 * @author     Ralf Eggert <ralf@travello.audio>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/travello-gmbh/amazon-alexa-skill-skeleton
 * @link       https://www.travello.audio/
 */

namespace Hello\Intent;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Config;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class IntentManagerFactory
 *
 * @package Hello\Intent
 */
class IntentManagerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string             $requestedName
     * @param array|null         $options
     *
     * @return IntentManager
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $manager = new IntentManager($container);

        $config = $container->has('config') ? $container->get('config') : [];
        $config = isset($config['hello_intents']) ? $config['hello_intents'] : [];

        if (!empty($config)) {
            (new Config($config))->configureServiceManager($manager);
        }

        return $manager;
    }
}
