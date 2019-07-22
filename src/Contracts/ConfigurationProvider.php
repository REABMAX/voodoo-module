<?php

namespace Voodoo\Module\Contracts;

/**
 * Interface ConfigurationProvider
 * @package Voodoo\Module\Contracts
 */
interface ConfigurationProvider extends ModuleInterface
{
    /**
     * @return array
     */
    public function configuration(): array;
}