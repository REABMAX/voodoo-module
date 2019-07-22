<?php

namespace Voodoo\Module;

use Psr\Container\ContainerInterface;
use Voodoo\Module\Contracts\ModuleInterface;
use Voodoo\Module\Contracts\ModuleResolverInterface;
use Voodoo\Module\Exception\ModuleConfigurationException;

/**
 * Class ContainerModuleLoader
 * @package Voodoo\Module
 */
class ContainerModuleResolver implements ModuleResolverInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * ContainerModuleLoader constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param string $fqdn
     * @return ModuleInterface
     * @throws ModuleConfigurationException
     */
    public function loadModule(string $fqdn): ModuleInterface
    {
        $this->assertModuleExists($fqdn);
        $module = $this->container->get($fqdn);
        $this->assertModuleIsInstanceOfModuleInterface($module);
        return $module;
    }

    /**
     * @param string $fqdn
     * @throws ModuleConfigurationException
     */
    protected function assertModuleExists(string $fqdn)
    {
        if(!$this->container->has($fqdn)) {
            throw new ModuleConfigurationException(printf("Module class %s could not be fetched by the container.", $fqdn));
        }
    }

    /**
     * @param mixed $module
     * @throws ModuleConfigurationException
     */
    protected function assertModuleIsInstanceOfModuleInterface($module)
    {
        if(false === $module instanceof ModuleInterface) {
            throw new ModuleConfigurationException(printf("Module %s must be an instance of %s!", get_class($module), ModuleInterface::class));
        }
    }
}