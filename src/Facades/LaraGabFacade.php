<?php
namespace BishopJ88\LaraGab\Facades;

use Illuminate\Support\Facades\Facade;

class LaraGabFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'BishopJ88\LaraGab\LaraGab';
    }
}