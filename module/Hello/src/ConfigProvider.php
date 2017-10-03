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

use Application\Intent\AbstractIntentFactory;
use Hello\Action\HelloAction;
use Hello\Action\HelloActionFactory;
use Hello\Action\PrivacyAction;
use Hello\Action\PrivacyActionFactory;
use Hello\Application\HelloApplication;
use Hello\Application\HelloApplicationFactory;
use Hello\Application\Helper\HelloTextHelper;
use Hello\Application\Helper\HelloTextHelperFactory;
use Hello\Config\RouterDelegatorFactory;
use Hello\Intent\HelloIntent;
use Hello\Intent\IntentManager;
use Hello\Intent\IntentManagerFactory;
use Zend\Expressive\Application;
use Zend\ServiceManager\Factory\InvokableFactory;

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
            'dependencies'  => $this->getDependencies(),
            'templates'     => $this->getTemplates(),
            'hello_intents' => $this->getIntents(),
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
                HelloAction::class   => HelloActionFactory::class,
                PrivacyAction::class => PrivacyActionFactory::class,

                HelloApplication::class => HelloApplicationFactory::class,
                HelloTextHelper::class  => HelloTextHelperFactory::class,
                IntentManager::class    => IntentManagerFactory::class,
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
                'hello' => [__DIR__ . '/../templates/hello'],
            ],
        ];
    }

    /**
     * @return array
     */
    public function getIntents(): array
    {
        return [
            'aliases' => [
                HelloIntent::NAME => HelloIntent::class,
            ],

            'factories' => [
                HelloIntent::class => AbstractIntentFactory::class,
            ],
        ];
    }
}
