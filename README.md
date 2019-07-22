# voodoo-module

This package provides a basic module interface to use in modular projects.

## Quick start

A module must implement `Voodoo\Module\Contracts\ModuleInterface` and/or implement one of the ProviderInterfaces specified in that
namespace.

The ModuleManager manages Modules and resolves them by using an implementation of `ModuleResolverInterface`

```php
<?php

$modules = [
    FirstModule::class,
    SecondModule::class,
];

$container = new DiContainer();
$resolver = new \Voodoo\Module\ContainerModuleResolver($container);
$moduleManager = new \Voodoo\Module\ModuleManager($modules, $resolver);

// calls di() method on modules implementing DiProvider
$diConfig = $moduleManager->getContainerConfiguration();

// calls routes() method on modules implementing RouteProvider
$routerConfig = $moduleManager->getRouterConfiguration();

// calls configuration() method on modules implementing ConfigurationProvider
$moduleConfig = $moduleManager->getModuleConfiguration();

// calls events() method on modules implementing EventProvider
$eventConfig = $moduleManager->getEventConfiguration();

// calls middleware() method on modules implementing MiddlewareProvider
$middleware = $moduleManager->getMiddlewareConfiguration();

// calls bootstrap($container) modules
$moduleManager->bootstrapModules($container);

```

This is what a module looks like:

```php
<?php

use Voodoo\Module\Contracts\DiProvider;
use Voodoo\Module\Contracts\RouteProvider;
use Voodoo\Module\Contracts\MiddlewareProvider;

class FirstModule implements DiProvider, RouteProvider, MiddlewareProvider
{
    public function bootstrap(ContainerInterface $container)
    {
     // Some bootstrapping code for this module
    }
    
    public function di() : array
    {
         return [];
    }
    
    public function routes() : array
    {
        return []; 
    }
    
    public function middleware() : array
    {
        return [];
    }
}
```