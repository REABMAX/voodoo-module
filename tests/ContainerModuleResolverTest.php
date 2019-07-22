<?php

namespace Voodoo\Module\Tests;

use Psr\Container\ContainerInterface;
use Voodoo\Module\ContainerModuleResolver;
use Voodoo\Module\Contracts\ModuleInterface;
use Voodoo\Module\Exception\ModuleConfigurationException;
use Voodoo\Module\Tests\Example\ExampleModule;
use Voodoo\Module\Tests\Example\ExampleNotAModule;

class ContainerModuleResolverTest extends \Codeception\Test\Unit
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
        $containerMock = $this->makeEmpty(ContainerInterface::class, [
            'get' => function() { return new ExampleModule(); },
            'has' => function() { return true; }
        ]);
        $resolver = new ContainerModuleResolver($containerMock);
        $module = $resolver->loadModule(ExampleModule::class);
        $this->assertNotEmpty($module);
        $this->assertInstanceOf(ModuleInterface::class, $module);
    }

    public function test_load_module_throws_exception_on_class_is_not_a_module()
    {
        $containerMock = $this->makeEmpty(ContainerInterface::class, [
            'get' => function() { return new ExampleNotAModule(); },
            'has' => true,
        ]);
        $resolver = new ContainerModuleResolver($containerMock);
        $this->expectException(ModuleConfigurationException::class);
        $resolver->loadModule(ExampleNotAModule::class);
    }
}