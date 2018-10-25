<?php

namespace Voodoo\Module\Contracts;

use Psr\Container\ContainerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Interface ModuleInterface
 * @package Voodoo\Module\Contracts
 */
interface ModuleInterface
{
    /**
     * Bootstrap the module.
     *
     * @param EventDispatcherInterface $eventDispatcher Give the module a chance to register event listeners
     * @param ContainerInterface $container In our bootstrapping layer it is allowed to use the ioc container directly
     * @return mixed
     */
    public function bootstrap(EventDispatcherInterface $eventDispatcher, ContainerInterface $container);
}