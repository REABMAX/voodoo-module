<?php

namespace Voodoo\Module\Tests;

use Voodoo\Module\Contracts\ModuleInterface;
use Voodoo\Module\Exception\ModuleConfigurationException;
use Voodoo\Module\NewModuleResolver;
use Voodoo\Module\Tests\Example\ExampleModule;
use Voodoo\Module\Tests\Example\ExampleNotAModule;

class NewModuleResolverTest extends \Codeception\Test\Unit
{
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function test_load_module_loads_module()
    {
        $resolver = new NewModuleResolver();
        $module = $resolver->loadModule(ExampleModule::class);
        $this->assertNotEmpty($module);
        $this->assertInstanceOf(ModuleInterface::class, $module);
    }

    public function test_load_module_throws_exception_on_class_is_not_a_module()
    {
        $resolver = new NewModuleResolver();
        $this->expectException(ModuleConfigurationException::class);
        $resolver->loadModule(ExampleNotAModule::class);
    }
}