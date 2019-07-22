<?php

namespace Voodoo\Module;

use Psr\Container\ContainerInterface;
use Voodoo\Module\Contracts\ConfigurationProvider;
use Voodoo\Module\Contracts\DiProvider;
use Voodoo\Module\Contracts\EventProvider;
use Voodoo\Module\Contracts\MiddlewareProvider;
use Voodoo\Module\Contracts\ModuleInterface;
use Voodoo\Module\Contracts\ModuleResolverInterface;
use Voodoo\Module\Contracts\ModuleManagerInterface;
use Voodoo\Module\Contracts\RouteProvider;

/**
 * Class ModuleManager
 * @package Voodoo\Module
 */
class ModuleManager implements ModuleManagerInterface
{
    /**
     * @var array
     */
    protected $configuration = [];

    /**
     * @var ModuleResolverInterface
     */
    protected $loader;

    /**
     * @var array
     */
    protected $modulesCache = [];

    /**
     * ModuleManager constructor.
     * @param array $configuration
     * @param ModuleResolverInterface $loader
     */
    public function __construct(array $configuration, ModuleResolverInterface $loader)
    {
        $this->configuration = $configuration;
        $this->loader = $loader;
    }

    /**
     * @return array
     */
    public function getContainerConfiguration(): array
    {
        $modules = $this->loadModules();
        $containerConfiguration = [];
        /** @var ModuleInterface $module */
        foreach ($modules as $module) {
            if ($module instanceof DiProvider) {
                $containerConfiguration = array_merge_recursive($containerConfiguration, $module->di());
            }
        }
        return $containerConfiguration;
    }

    /**
     * @return array
     */
    public function getModuleConfiguration(): array
    {
        $modules = $this->loadModules();
        $moduleConfiguration = [];
        /** @var ModuleInterface $module */
        foreach ($modules as $module) {
            if ($module instanceof ConfigurationProvider) {
                $moduleConfiguration = array_merge_recursive($moduleConfiguration, $module->configuration());
            }
        }
        return $moduleConfiguration;
    }

    /**
     * @return array
     */
    public function getEventConfiguration(): array
    {
        $modules = $this->loadModules();
        $eventConfiguration = [];
        /** @var ModuleInterface $module */
        foreach ($modules as $module) {
            if ($module instanceof EventProvider) {
                $eventConfiguration = array_merge_recursive($eventConfiguration, $module->events());
            }
        }
        return $eventConfiguration;
    }

    /**
     * @return array
     */
    public function getRouterConfiguration(): array
    {
        $modules = $this->loadModules();
        $routerConfiguration = [];
        /** @var ModuleInterface $module */
        foreach ($modules as $module) {
            if ($module instanceof RouteProvider) {
                $routerConfiguration = array_merge($routerConfiguration, $module->routes());
            }
        }
        return $routerConfiguration;
    }

    /**
     * @return array
     */
    public function getMiddlewareConfiguration(): array
    {
        $modules = $this->loadModules();
        $middlewareConfiguration = [];
        /** @var ModuleInterface $module */
        foreach ($modules as $module) {
            if ($module instanceof MiddlewareProvider) {
                $middlewareConfiguration = array_merge($middlewareConfiguration, $module->middleware());
            }
        }
        return $middlewareConfiguration;
    }

    /**
     * @inheritdoc
     */
    public function bootstrapModules(ContainerInterface $container)
    {
        $modules = $this->loadModules();
        /** @var ModuleInterface $module */
        foreach($modules as $module) {
            $this->callModuleBootstrap($module, $container);
        }
    }

    /**
     * @param ModuleInterface $module
     * @param ContainerInterface $container
     */
    protected function callModuleBootstrap(ModuleInterface $module, ContainerInterface $container)
    {
        $module->bootstrap($container);
    }

    /**
     * @param bool $useCache
     * @return array
     */
    protected function loadModules(bool $useCache = true): array
    {
        if (!$useCache || empty($this->modulesCache)) {
            $modules = [];
            if(!empty($this->configuration)) {
                foreach($this->configuration as $fqcn) {
                    $modules[] = $this->loader->loadModule($fqcn);
                }
            }

            if ($useCache) {
                $this->modulesCache = $modules;
            }

            return $modules;
        }

        return $this->modulesCache;
    }
}