<?php
/**
 * PHP skeleton application for Amazon Alexa Skills
 *
 * @author     Ralf Eggert <ralf@travello.audio>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/travello-gmbh/amazon-alexa-skill-skeleton
 * @link       https://www.travello.audio/
 */

namespace Hello;

use Hello\Action\HelloAction;
use Hello\Action\HelloActionFactory;
use Hello\Action\PrivacyAction;
use Hello\Action\PrivacyActionFactory;
use Hello\Application\HelloApplication;
use Hello\Config\RouterDelegatorFactory;
use Hello\Intent\HelloIntent;
use TravelloAlexaZf\Application\AlexaApplicationFactory;
use TravelloAlexaZf\Intent\AbstractIntentFactory;
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
            'dependencies'  => $this->getDependencies(),
            'templates'     => $this->getTemplates(),
            'skills'        => $this->getSkills(),
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

                HelloApplication::class => AlexaApplicationFactory::class,
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
    public function getSkills(): array
    {
        return [
            HelloApplication::NAME => [
                'applicationId' => 'amzn1.ask.skill.place-your-skill-id-here',
                'smallImageUrl' => 'https://www.travello.audio/cards/hello-480x480.png',
                'largeImageUrl' => 'https://www.travello.audio/cards/hello-800x800.png',
                'intents'       => [
                    'aliases' => [
                        HelloIntent::NAME => HelloIntent::class,
                    ],

                    'factories' => [
                        HelloIntent::class => AbstractIntentFactory::class,
                    ],
                ],
                'texts'         => [
                    'de-DE' => include PROJECT_ROOT . '/data/texts/hello.common.texts.de-DE.php',
                    'en-UK' => include PROJECT_ROOT . '/data/texts/hello.common.texts.en-UK.php',
                    'en-US' => include PROJECT_ROOT . '/data/texts/hello.common.texts.en-US.php',
                ],
            ]
        ];
    }
}
