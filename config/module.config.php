<?php

namespace AsseticModule;

use AsseticBundle;

return [
    'dependencies' => [
        'factories' => [
            'AsseticBundle\Configuration' => Factory\ConfigurationFactory::class,
            'AsseticModule\AsseticMiddleware' => Factory\MiddlewareFactory::class,
        ],
        'delegators' => [
            AsseticBundle\Service::class => [
                Factory\ServiceDelegatorFactory::class,
            ],
        ],
    ],


];
