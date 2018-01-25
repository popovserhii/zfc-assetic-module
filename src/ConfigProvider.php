<?php

namespace AsseticModule;

class ConfigProvider
{
    public function __invoke()
    {
        $bundleConfig = include __DIR__ . '/../../../widmogrod/zf2-assetic-module/configs/module.config.php';
        $bundleConfig['dependencies'] = $bundleConfig['service_manager'];
        unset($bundleConfig['service_manager']);

        $config = include __DIR__ . '/../config/module.config.php';
        //$config = array_merge_recursive($bundleConfig, $config);
        $config = \Zend\Stdlib\ArrayUtils::merge($bundleConfig, $config);

        return $config;
    }
}