<?php

namespace AppKit\Formulate\Middleware;

use AppKit\Formulate\FormulateComponentAttributeBag;
use Closure;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Js;
use Illuminate\Support\ViewErrorBag;

class PrecognitionMiddleware extends BaseMiddleware
{
    public function shouldApply()
    {
        return $this->form && $this->form->routeDetails && $this->form->routeDetails->supportPrecognition() && $this->form->attributes->has('x-data');
    }

    public function getFormComponentAttributes(FormulateComponentAttributeBag $attributes, Closure $next)
    {
        $errors = View::shared('errors', new ViewErrorBag());

        $precognitionXData = sprintf(
            '{%s: $form(\'%s\', \'%s\', %s)%s}',
            'form',
            $this->form->method,
            $this->form->action,
            $attributes->get('x-data'),
            $errors->isEmpty() ? '' : '.setErrors(' . Js::from($errors->messages()) . ')'
        );

        $attributes->set('x-data', $precognitionXData);

        // pass onto the next middleware
        return $next($attributes);
    }

    public function getInputComponentAttributes(FormulateComponentAttributeBag $attributes, Closure $next)
    {
        if ($this->field->multiple) {
            $attributes->set('@change', 'form.validate(\'' . $this->field->name . '.\' + index)');
            $attributes->set(':aria-invalid', 'form.invalid(\'' . $this->field->name . '.\' + index)');
        } else {
            $attributes->set('@change', 'form.validate(\'' . $this->field->name . '\')');
            $attributes->set(':aria-invalid', 'form.invalid(\'' . $this->field->name . '\')');
        }

        return $next($attributes);
    }

    public function shouldRenderFieldErrorComponent($value, Closure $next)
    {
        return $next(true);
    }

    public function getFieldErrorComponentAttributes(FormulateComponentAttributeBag $attributes, Closure $next)
    {
        if ($this->field->multiple) {
            $attributes->set('x-show', 'form.invalid(\'' . $this->field->name . '.\' + index)');
            $attributes->set('x-text', 'form.errors[\'' . $this->field->name . '.\' + index]');
        } else {
            $attributes->set('x-show', 'form.invalid(\'' . $this->field->name . '\')');
            $attributes->set('x-text', 'form.errors.' . $this->field->name);
        }

        return $next($attributes);
    }
}
