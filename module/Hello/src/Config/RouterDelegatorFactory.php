<?php
/**
 * PHP skeleton application for Amazon Alexa Skills
 *
 * @author     Ralf Eggert <ralf@travello.audio>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/travello-gmbh/amazon-alexa-skill-skeleton
 * @link       https://www.travello.audio/
 */

namespace Hello\Config;

use Hello\Application\HelloApplication;
use Interop\Container\ContainerInterface;
use TravelloAlexaZf\Action\HtmlPageAction;
use TravelloAlexaZf\Action\SkillAction;
use Zend\Expressive\Application;
use Zend\ServiceManager\Factory\DelegatorFactoryInterface;

/**
 * Class RouterDelegatorFactory
 *
 * @package Hello\Config
 */
class RouterDelegatorFactory implements DelegatorFactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string             $name
     * @param callable           $callback
     * @param array|null|null    $options
     *
     * @return mixed
     */
    public function __invoke(ContainerInterface $container, $name, callable $callback, array $options = null)
    {
        /** @var Application $application */
        $application = $callback();

        $application->post('/hello', SkillAction::class, 'hello')
            ->setOptions(['defaults' => ['skillName' => HelloApplication::NAME]]);

        $application->get('/hello/privacy', HtmlPageAction::class, 'hello-privacy')
            ->setOptions(['defaults' => ['template' => 'hello::privacy']]);

        $application->get('/hello/terms', HtmlPageAction::class, 'hello-terms')
            ->setOptions(['defaults' => ['template' => 'hello::terms']]);

        return $application;
    }
}
