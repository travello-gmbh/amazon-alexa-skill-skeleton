<?php
/**
 * PHP skeleton application for Amazon Alexa Skills
 *
 * @author     Ralf Eggert <ralf@travello.audio>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/travello-gmbh/amazon-alexa-skill-skeleton
 * @link       https://www.travello.audio/
 */

namespace Application;

use Application\Action\HomePageAction;
use Application\Config\PipelineDelegatorFactory;
use Application\Config\RouterDelegatorFactory;
use Zend\Expressive\Application;
use Zend\ServiceManager\Factory\InvokableFactory;

/**
 * Class ConfigProvider
 *
 * @package Application
 */
class ConfigProvider
{
    /**
     * @return array
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
        ];
    }

    /**
     * @return array
     */
    public function getDependencies(): array
    {
        return [
            'delegators' => [
                Application::class => [
                    RouterDelegatorFactory::class,
                    PipelineDelegatorFactory::class,
                ],
            ],
            'factories'  => [
                HomePageAction::class => InvokableFactory::class,
            ],
        ];
    }

    /**
     * @return array
     */
    public function getTemplates(): array
    {
        return [
            'layout' => 'layout/default',
            'map'    => [
                'layout/default' => __DIR__ . '/../templates/layout/default.phtml',
                'error/error'    => __DIR__ . '/../templates/error/error.phtml',
                'error/404'      => __DIR__ . '/../templates/error/404.phtml',
            ],
            'paths'  => [
                'layout' => [__DIR__ . '/../templates/layout'],
                'error'  => [__DIR__ . '/../templates/error'],
            ],
        ];
    }
}
