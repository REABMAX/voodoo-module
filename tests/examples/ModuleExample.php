<?php

namespace Voodoo\ModuleExamples;

use Psr\Container\ContainerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Voodoo\Module\Contracts\ModuleInterface;

/**
 * Class ModuleExample
 * @package Voodoo\ModuleExamples
 */
class ModuleExample implements ModuleInterface
{
    public function bootstrap(EventDispatcherInterface $eventDispatcher, ContainerInterface $container)
    {
        // TODO: Implement bootstrap() method.
    }
}