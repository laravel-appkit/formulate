<?php

namespace AppKit\Formulate\Middleware;

use AppKit\Formulate\FormulateComponentAttributeBag;
use Closure;

class RepeatingFieldsMiddleware extends BaseMiddleware
{
    public function shouldApply()
    {
        return $this->field->multiple;
    }

    public function getInputComponentAttributes(FormulateComponentAttributeBag $attributes, Closure $next)
    {
        $attributes->set(':id', '\'' . $this->field->id . '_\' + index');

        // go to the next middleware
        return $next($attributes);
    }

    public function getFieldGroupComponentAttributes(FormulateComponentAttributeBag $attributes, Closure $next)
    {
        $attributes->set('x-ref', 'repeater');

        return $next($attributes);
    }

    public function getLabelComponentAttributes(FormulateComponentAttributeBag $attributes, Closure $next)
    {
        $attributes->set('x-text', '\'' . $this->field->label . ' \' + (index + 1) + \' of \' + form.' . $this->field->name . '.length');
        $attributes->set(':for', '\'' . $this->field->id . '_\' + index');
        // $attributes->addClass('hidden');

        // go to the next middleware
        return $next($attributes);
    }
}
