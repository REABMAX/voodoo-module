<?php

namespace Voodoo\Module\Contracts;

/**
 * Interface MiddlewareProvider
 * @package Voodoo\Module\Contracts
 */
interface MiddlewareProvider extends ModuleInterface
{
    /**
     * @return array
     */
    public function middleware(): array;
}