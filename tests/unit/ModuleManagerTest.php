<?php

namespace Voodoo\Module;

use PHPUnit\Framework\TestCase;
use Voodoo\ModuleExamples\ModuleExample;

/**
 * Class ModuleManagerTest
 * @package Voodoo\Module
 */
class ModuleManagerTest extends TestCase
{
    /**
     * @test
     */
    public function bootstrap_modules_loads_modules()
    {
        $mock = $this->getMockBuilder(ModuleManager::class)->setMethods(['loadModules', 'bootstrapModules'])->getMock();
        $mock->expects($this->once())->method('loadModules');
        $mock->bootstrapModules();
    }

    /**
     * @test
     */
    public function bootstrap_modules_calls_bootstrap_on_all_loaded_modules()
    {
        $mock = $this->getMockBuilder(ModuleManager::class)->setMethods(['loadModules', 'bootstrapModules', 'callModuleBootstrap'])->getMock();
        $mock->method('loadModules')->willReturn([new ModuleExample(), new ModuleExample()]);
        $mock->expects($this->exactly(2))->method('callModuleBootstrap');
        $mock->bootstrapModules();
    }
}