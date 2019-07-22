<?php

namespace Voodoo\Module\Contracts;

use Psr\Container\ContainerInterface;

/**
 * Interface ModuleInterface
 * @package Voodoo\Module\Contracts
 */
interface ModuleInterface
{
    /**
     * Perform some system bootstrap logic defined by this module using a service locator
     * (the only part of a module where the service locator pattern is allowed)
     * @param ContainerInterface $container
     * @return mixed
     */
    public function bootstrap(ContainerInterface $container);
}