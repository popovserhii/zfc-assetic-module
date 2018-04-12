<?php

namespace AsseticModule;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Server\MiddlewareInterface;
use Zend\Expressive\Router\RouteResult;
use AsseticBundle\Configuration;

class AsseticMiddleware implements MiddlewareInterface
{
    /** @var $asseticService \AsseticBundle\Service */
    protected $asseticService;

    protected $viewRenderer;

    public function __construct($asseticService, $viewRenderer)
    {
        $this->asseticService = $asseticService;
        $this->viewRenderer = $viewRenderer;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $this->renderAssets($request);

        return $handler->handle($request);
    }

    public function renderAssets($request)
    {
        /** @var Configuration $config */
        #$config = $sm->get('AsseticConfiguration');
        #if ($e->getName() === MvcEvent::EVENT_DISPATCH_ERROR) {
        #    $error = $e->getError();
        #    if ($error && !in_array($error, $config->getAcceptableErrors())) {
        #        // break if not an acceptable error
        #        return;
        #    }
        #}

        /** @var RouteResult $routeResult */
        $routeResult = $request->getAttribute(RouteResult::class);
        //if ($routeResult->isSuccess()) {
        if ($routeResult) {
            $actionName = $request->getAttribute('action', 'index');
            $resourceName = $request->getAttribute('controller', $request->getAttribute('resource', $actionName));
            $routeName = $routeResult->isSuccess() ? $routeResult->getMatchedRouteName() : 'default';

            $this->asseticService->setRouteName($routeName);
            $this->asseticService->setControllerName($resourceName);
            $this->asseticService->setActionName($actionName);
        }

        // Create all objects
        $this->asseticService->build();

        // Init assets for modules
        $this->asseticService->setupRenderer($this->viewRenderer);
    }
}