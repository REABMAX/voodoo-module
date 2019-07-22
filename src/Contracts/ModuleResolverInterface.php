<?php

namespace Voodoo\Module\Contracts;

/**
 * Interface ModuleLoaderInterface
 * @package Voodoo\Module\Contracts
 */
interface ModuleResolverInterface
{
    /**
     * @param string $fqcn
     * @return ModuleInterface
     */
    public function loadModule(string $fqcn): ModuleInterface;
}