<?php

namespace Voodoo\Module\Contracts;

use Psr\Container\ContainerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Interface ModuleManagerInterface
 *
 * @package Voodoo\Module\Contracts
 */
interface ModuleManagerInterface
{
    /**
     * Bootstraps all loaded modules
     *
     * @param EventDispatcherInterface $eventDispatcher
     * @param ContainerInterface $container
     * @return mixed
     */
    public function bootstrapModules(EventDispatcherInterface $eventDispatcher, ContainerInterface $container);

    /**
     * Tell the module manager to use a configuration file
     *
     * @param string $configurationFile
     * @return mixed
     */
    public function useConfigurationFile(string $configurationFile);
}