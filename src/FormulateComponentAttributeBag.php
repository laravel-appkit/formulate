<?php

namespace AppKit\Formulate;

use Illuminate\Support\Js;
use Illuminate\View\ComponentAttributeBag;

class FormulateComponentAttributeBag extends ComponentAttributeBag
{
    public function set($attribute, $value)
    {
        if (is_object($value) || is_array($value)) {
            if (!count($value)) {
                $value = Js::from($value, JSON_FORCE_OBJECT);
            } else {
                $value = Js::from($value);
            }
        }

        $this->attributes[$attribute] = $value;
    }
}
