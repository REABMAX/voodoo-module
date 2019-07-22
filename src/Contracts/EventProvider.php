<?php

namespace Voodoo\Module\Contracts;

/**
 * Interface EventProvider
 * @package Voodoo\Module\Contracts
 */
interface EventProvider extends ModuleInterface
{
    /**
     * Return event configuration array for this module
     * @return array
     */
    public function events(): array;
}