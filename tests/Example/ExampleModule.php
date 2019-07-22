<?php

namespace Voodoo\Module\Tests\Example;

use Psr\Container\ContainerInterface;
use Voodoo\Module\Contracts\ModuleInterface;

/**
 * Class ExampleModule
 * @package Voodoo\Module\Tests\Example
 */
class ExampleModule implements ModuleInterface
{
    /**
     * @param ContainerInterface $container
     * @return mixed|void
     */
    public function bootstrap(ContainerInterface $container)
    {
        //
    }
}