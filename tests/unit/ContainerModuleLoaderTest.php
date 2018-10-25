<?php

namespace Voodoo\Module;

use Psr\Container\ContainerInterface;
use Voodoo\Module\Contracts\ModuleLoaderInterface;

/**
 * Class NewModuleLoaderTest
 * @package Voodoo\Module
 */
class ContainerModuleLoaderTest extends ModuleLoaderTestAbstract
{
    /**
     * @return ModuleLoaderInterface
     */
    protected function getInstance(): ModuleLoaderInterface
    {
        return new ContainerModuleLoader(new class implements ContainerInterface {
            public function has($id)
            {
                return class_exists($id);
            }

            public function get($id)
            {
                return new $id();
            }
        });
    }
}