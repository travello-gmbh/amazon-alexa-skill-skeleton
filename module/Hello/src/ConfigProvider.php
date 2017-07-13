<?php
/**
 * PHP skeleton application for Amazon Alexa Skills
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/travello-gmbh/amazon-alexa-skill-skeleton
 * @link       https://www.travello.de/
 */

namespace Hello;

use Hello\Action\PrivacyAction;
use Hello\Action\PrivacyActionFactory;
use Hello\Action\HelloAction;
use Hello\Action\HelloActionFactory;
use Hello\Application\Helper\HelloTextHelper;
use Hello\Application\Helper\HelloTextHelperFactory;
use Hello\Application\HelloApplication;
use Hello\Application\HelloApplicationFactory;
use Hello\Config\RouterDelegatorFactory;
use Zend\Expressive\Application;

/**
 * Class ConfigProvider
 *
 * @package Hello
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
                ],
            ],
            'factories'  => [
                HelloAction::class => HelloActionFactory::class,
                PrivacyAction::class => PrivacyActionFactory::class,

                HelloApplication::class => HelloApplicationFactory::class,
                HelloTextHelper::class  => HelloTextHelperFactory::class,
            ],
        ];
    }

    /**
     * @return array
     */
    public function getTemplates(): array
    {
        return [
            'paths' => [
                'Hello' => [__DIR__ . '/../templates/Hello'],
            ],
        ];
    }
}
