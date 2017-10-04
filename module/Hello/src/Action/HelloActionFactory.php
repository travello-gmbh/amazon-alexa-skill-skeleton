<?php
/**
 * PHP skeleton application for Amazon Alexa Skills
 *
 * @author     Ralf Eggert <ralf@travello.audio>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/travello-gmbh/amazon-alexa-skill-skeleton
 * @link       https://www.travello.audio/
 */

namespace Hello\Action;

use Interop\Container\ContainerInterface;
use Hello\Application\HelloApplication;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class HelloActionFactory
 *
 * @package Hello\Action
 */
class HelloActionFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string             $requestedName
     * @param array|null|null    $options
     *
     * @return HelloAction
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): HelloAction
    {
        $helloApplication = $container->get(HelloApplication::class);

        return new HelloAction($helloApplication);
    }
}
