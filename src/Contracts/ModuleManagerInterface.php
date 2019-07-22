<?php

namespace Voodoo\Module\Contracts;

use Psr\Container\ContainerInterface;

/**
 * Interface ModuleManagerInterface
 * @package Voodoo\Module\Contracts
 */
interface ModuleManagerInterface
{
    /**
     * @return array
     */
    public function getContainerConfiguration(): array;

    /**
     * @return array
     */
    public function getEventConfiguration(): array;

    /**
     * @return array
     */
    public function getRouterConfiguration(): array;

    /**
     * @return array
     */
    public function getModuleConfiguration(): array;

    /**
     * @return array
     */
    public function getMiddlewareConfiguration(): array;

    /**
     * @param ContainerInterface $container
     * @return mixed
     */
    public function bootstrapModules(ContainerInterface $container);
}