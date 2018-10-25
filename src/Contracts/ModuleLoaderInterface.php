<?php

namespace Voodoo\Module\Contracts;

/**
 * Interface ModuleLoaderInterface
 * @package Voodoo\Module\Contracts
 */
interface ModuleLoaderInterface
{
    /**
     * Load our module and return the instance
     *
     * @param string $fqdn
     * @return ModuleInterface
     */
    public function loadModule(string $fqdn): ModuleInterface;
}