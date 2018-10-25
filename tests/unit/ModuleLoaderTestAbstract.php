<?php

namespace Voodoo\Module;

use PHPUnit\Framework\TestCase;
use Voodoo\Module\Contracts\ModuleLoaderInterface;
use Voodoo\Module\Exception\ModuleConfigurationException;
use Voodoo\ModuleExamples\ModuleExample;
use Voodoo\ModuleExamples\NonInstanceModuleExample;

/**
 * Class ModuleLoaderTestAbstract
 * @package Voodoo\Module
 */
abstract class ModuleLoaderTestAbstract extends TestCase
{
    /**
     * @return ModuleLoaderInterface
     */
    abstract protected function getInstance(): ModuleLoaderInterface;

    /**
     * @test
     */
    public function load_module_returns_given_fqdn_object()
    {
        $moduleLoader = $this->getInstance();
        $module = $moduleLoader->loadModule(ModuleExample::class);
        $this->assertInstanceOf(ModuleExample::class, $module);
    }

    /**
     * @test
     */
    public function load_module_throws_module_configuration_exception_if_class_does_not_exist()
    {
        $moduleLoader = new NewModuleLoader();
        $this->expectException(ModuleConfigurationException::class);
        $moduleLoader->loadModule(NonExistentClass::class);
    }

    /**
     * @test
     */
    public function load_module_throws_module_configuration_exception_if_object_is_not_instance_of_module_interface()
    {
        $moduleLoader = new NewModuleLoader();
        $this->expectException(ModuleConfigurationException::class);
        $moduleLoader->loadModule(NonInstanceModuleExample::class);
    }
}