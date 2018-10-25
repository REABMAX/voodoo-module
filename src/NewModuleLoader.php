<?php

namespace Voodoo\Module;

use Voodoo\Module\Contracts\ModuleInterface;
use Voodoo\Module\Contracts\ModuleLoaderInterface;
use Voodoo\Module\Exception\ModuleConfigurationException;

class NewModuleLoader implements ModuleLoaderInterface
{
    /**
     * @param string $fqdn
     * @return ModuleInterface
     */
    public function loadModule(string $fqdn): ModuleInterface
    {
        $this->assertModuleExists($fqdn);
        $module = new $fqdn();
        $this->assertModuleIsInstanceOfModuleInterface($module);
        return $module;
    }

    /**
     * @param string $fqdn
     * @throws ModuleConfigurationException
     */
    protected function assertModuleExists(string $fqdn)
    {
        if(!class_exists($fqdn)) {
            throw new ModuleConfigurationException(printf("Module class %s does not exist.", $fqdn));
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