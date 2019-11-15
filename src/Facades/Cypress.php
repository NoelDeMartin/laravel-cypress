<?php

namespace NoelDeMartin\LaravelCypress\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \NoelDeMartin\LaravelCypress\Cypress
 */
class Cypress extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'cypress';
    }
}
