<?php

namespace AppKit\Formulate;

use Illuminate\Support\Js;
use Illuminate\View\ComponentAttributeBag;

class FormulateComponentAttributeBag extends ComponentAttributeBag
{
    public function set($attribute, $value)
    {
        if (is_object($value)) {
            $value = Js::from($value, JSON_FORCE_OBJECT);
        }

        $this->attributes[$attribute] = $value;
    }
}
