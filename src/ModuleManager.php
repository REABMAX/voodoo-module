<?php

namespace Voodoo\Module;

use Psr\Container\ContainerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Voodoo\Module\Contracts\ModuleInterface;
use Voodoo\Module\Contracts\ModuleLoaderInterface;
use Voodoo\Module\Contracts\ModuleManagerInterface;
use Voodoo\Module\Exception\ModuleConfigurationException;

class ModuleManager implements ModuleManagerInterface
{
    /**
     * @var array
     */
    protected $configuration = [];

    /**
     * @var ModuleLoaderInterface
     */
    protected $loader;

    /**
     * @param string $configurationFile
     * @param ModuleLoaderInterface $loader
     */
    public function __construct(string $configurationFile, ModuleLoaderInterface $loader)
    {
        $this->useConfigurationFile($configurationFile);
        $this->loader = $loader;
    }

    /**
     * @inheritdoc
     */
    public function bootstrapModules(EventDispatcherInterface $eventDispatcher, ContainerInterface $container)
    {
        $modules = $this->loadModules();
        foreach($modules as $module) {
            $this->callModuleBootstrap($module, $eventDispatcher, $container);
        }
    }

    /**
     * @inheritdoc
     */
    public function useConfigurationFile(string $configurationFile)
    {
        $this->assertConfigurationFileExists($configurationFile);
        $this->configuration = $this->getConfigurationFromFile($configurationFile);
    }

    /**
     * @param ModuleInterface $module
     * @param EventDispatcherInterface $eventDispatcher
     * @param ContainerInterface $container
     */
    protected function callModuleBootstrap(ModuleInterface $module, EventDispatcherInterface $eventDispatcher, ContainerInterface $container)
    {
        $module->bootstrap($eventDispatcher, $container);
    }

    /**
     * @param string $file
     * @return array
     * @throws ModuleConfigurationException
     */
    protected function getConfigurationFromFile(string $file): array
    {
        $contents = include($file);
        if(!is_array($contents)) {
            throw new ModuleConfigurationException(printf("Configuration file must return an array", $file));
        }
        return $contents;
    }

    /**
     * @param string $file
     * @throws ModuleConfigurationException
     */
    protected function assertConfigurationFileExists(string $file)
    {
        if(!file_exists($file)) {
            throw new ModuleConfigurationException(printf("Configuration file %s not found", $file));
        }
    }

    /**
     * @return array
     */
    protected function loadModules(): array
    {
        $modules = [];
        if(!empty($this->configuration)) {
            foreach($this->configuration as $fqdn) {
                $modules[] = $this->loader->loadModule($fqdn);
            }
        }

        return $modules;
    }
}