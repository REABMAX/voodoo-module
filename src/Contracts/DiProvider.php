<?php

namespace Voodoo\Module\Contracts;

/**
 * Interface DiProvider
 * @package Voodoo\Module\Contracts
 */
interface DiProvider extends ModuleInterface
{
    /**
     * Return dependency injection container configuration array for this module
     * @return array
     */
    public function di(): array;
}