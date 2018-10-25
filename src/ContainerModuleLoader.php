<?php

namespace Voodoo\Module;

use Psr\Container\ContainerInterface;
use Voodoo\Module\Contracts\ModuleInterface;
use Voodoo\Module\Contracts\ModuleLoaderInterface;
use Voodoo\Module\Exception\ModuleConfigurationException;

class ContainerModuleLoader implements ModuleLoaderInterface
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
     * @inheritdoc
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