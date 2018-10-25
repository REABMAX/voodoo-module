<?php

namespace Voodoo\Module;

use Voodoo\Module\Contracts\ModuleLoaderInterface;

/**
 * Class NewModuleLoaderTest
 * @package Voodoo\Module
 */
class NewModuleLoaderTest extends ModuleLoaderTestAbstract
{
    /**
     * @return ModuleLoaderInterface
     */
    protected function getInstance(): ModuleLoaderInterface
    {
        return new NewModuleLoader();
    }
}