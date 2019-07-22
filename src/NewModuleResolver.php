<?php

namespace Voodoo\Module;

use Voodoo\Module\Contracts\ModuleInterface;
use Voodoo\Module\Contracts\ModuleResolverInterface;
use Voodoo\Module\Exception\ModuleConfigurationException;

/**
 * Class NewModuleLoader
 * @package Voodoo\Module
 */
class NewModuleResolver implements ModuleResolverInterface
{
    /**
     * @param string $fqcn
     * @return ModuleInterface
     * @throws ModuleConfigurationException
     */
    public function loadModule(string $fqcn): ModuleInterface
    {
        $this->assertModuleExists($fqcn);
        $module = new $fqcn();
        $this->assertModuleIsInstanceOfModuleInterface($module);
        return $module;
    }

    /**
     * @param string $fqcn
     * @throws ModuleConfigurationException
     */
    protected function assertModuleExists(string $fqcn)
    {
        if(!class_exists($fqcn)) {
            throw new ModuleConfigurationException(printf("Module class %s does not exist.", $fqcn));
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