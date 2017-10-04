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

use Exception;
use Hello\Application\HelloApplication;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use TravelloAlexaLibrary\Request\Exception\BadRequest;
use Zend\Diactoros\Response\JsonResponse;

/**
 * Class HelloAction
 *
 * @package Hello\Action
 */
class HelloAction implements ServerMiddlewareInterface
{
    /** @var HelloApplication */
    private $helloApplication;

    /**
     * HelloAction constructor.
     *
     * @param HelloApplication $helloApplication
     */
    public function __construct(HelloApplication $helloApplication)
    {
        $this->helloApplication = $helloApplication;
    }

    /**
     * @param ServerRequestInterface $request
     * @param DelegateInterface      $delegate
     *
     * @return mixed
     */
    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        try {
            $data = $this->helloApplication->execute();

            return new JsonResponse($data, 200);
        } catch (BadRequest $e) {
            $data = ['error' => $e->getMessage()];

            return new JsonResponse($data, 400);
        } catch (Exception $e) {
            $data = ['error' => 'unknown error'];

            return new JsonResponse($data, 400);
        }
    }
}
