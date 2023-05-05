<?php

namespace AppKit\Formulate\Middleware;

use AppKit\Formulate\FormulateComponentAttributeBag;
use Closure;

class ApplyFormThemeClassesMiddleware
{
    public function getInputComponentAttributes(FormulateComponentAttributeBag $attributes, Closure $next)
    {
        if (!$attributes->has('class')) {
            $attributes->set('class', config('formulate.classes.field'));
        }

        // go to the next middleware
        return $next($attributes);
    }

    public function getFieldGroupComponentAttributes(FormulateComponentAttributeBag $attributes, Closure $next)
    {
        if (!$attributes->has('class')) {
            $attributes->set('class', config('formulate.classes.group'));
        }

        // go to the next middleware
        return $next($attributes);
    }

    public function getLabelComponentAttributes(FormulateComponentAttributeBag $attributes, Closure $next)
    {
        if (!$attributes->has('class')) {
            $attributes->set('class', config('formulate.classes.label'));
        }

        // go to the next middleware
        return $next($attributes);
    }
}
