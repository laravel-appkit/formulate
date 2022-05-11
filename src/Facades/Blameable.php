<?php

namespace AppKit\Formulate\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \AppKit\Formulate\Formulate
 */
class Formulate extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'formulate';
    }
}
