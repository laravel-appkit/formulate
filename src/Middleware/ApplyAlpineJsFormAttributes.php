<?php

namespace AppKit\Formulate\Middleware;

use AppKit\Formulate\Facades\Formulate;
use AppKit\Formulate\FormulateComponentAttributeBag;
use Closure;

class ApplyAlpineJsFormAttributes extends BaseMiddleware
{
    public function getFormComponentAttributes(FormulateComponentAttributeBag $attributes, Closure $next)
    {
        // if the form is requesting x-data, but has nothing already set in the x-data attribute
        if ($attributes->has('x-data') && $attributes->get('x-data') === true) {
            // generate the x-data
            $data = Formulate::getFields()->mapWithKeys(function ($field) {
                return [$field->name => $field->value ?? $field->getDefaultValue()];
            });

            $attributes->set('x-data', $data);
        }

        // pass onto the next middleware
        return $next($attributes);
    }

    public function getInputComponentAttributes(FormulateComponentAttributeBag $attributes, Closure $next)
    {
        if ($this->form && $this->form->attributes->has('x-data') && !$attributes->has('x-model')) {
            if ($this->field->multiple) {
                $attributes->set('x-model', 'form.' . $this->field->name . '[index]');
            } else {
                $attributes->set('x-model', 'form.' . $this->field->name);
            }
        }

        return $next($attributes);
    }
}
