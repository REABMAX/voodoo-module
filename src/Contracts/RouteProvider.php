<?php

namespace Voodoo\Module\Contracts;

interface RouteProvider extends ModuleInterface
{
    /**
     * @return array
     */
    public function routes(): array;
}