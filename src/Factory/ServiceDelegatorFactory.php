<?php

namespace AsseticModule\Factory;

use Psr\Container\ContainerInterface;
use Zend\Expressive\Helper\UrlHelper;
use AsseticBundle\Service as AsseticService;

class ServiceDelegatorFactory
{
    /**
     * @param ContainerInterface $container
     * @param string $name
     * @param callable $callback
     *
     * @return AsseticService
     */
    public function __invoke(ContainerInterface $container, $name, callable $callback)
    {
        $asseticConfig = $container->get('AsseticConfiguration');

        $urlHelper = $container->get(UrlHelper::class);
        $asseticConfig->setBaseUrl($urlHelper->getBasePath());

        $service = $callback();

        return $service;
    }
}