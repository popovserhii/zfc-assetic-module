<?php

namespace AsseticModule\Factory;

use AsseticBundle\Service as AsseticService;
use AsseticModule\AsseticMiddleware;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\View\HelperPluginManager;
use Zend\View\Renderer\PhpRenderer;

class MiddlewareFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var $asseticService AsseticService */
        $asseticService = $container->get('AsseticService');
        $renderer = ($container->has(PhpRenderer::class))
            ? $container->get(PhpRenderer::class)
            : new PhpRenderer();

        // Create or retrieve the renderer from the container
        // @todo wait until fixed this issue https://github.com/zendframework/zend-expressive-zendviewrenderer/issues/54
        // and remove HelperPluginManager injection
        if ($container->has(HelperPluginManager::class)) {
            $renderer->setHelperPluginManager($container->get(HelperPluginManager::class));
        }

        return new AsseticMiddleware($asseticService, $renderer);
    }
}
