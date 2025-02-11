<?php

namespace AppKit\Formulate\Components\Customisers\AlpineJs;

use AppKit\Formulate\Facades\Formulate;
use AppKit\UI\ComponentBuilder;
use AppKit\UI\Components\BaseComponent;
use Illuminate\Support\Js;

class FormCustomiser
{
    public function __invoke(ComponentBuilder $componentBuilder, BaseComponent $instance)
    {
        // we only want to do something if we have an x-data attribute
        if ($componentBuilder->getAttributeBag()->has('x-data')) {
            // generate the x-data
            $data = Formulate::getFields()->mapWithKeys(function ($field) {
                return [$field->name => $field->value ?? $field->getDefaultValue()];
            });

            // if we aren't empty
            if (!$data->isEmpty()) {
                // make a JS string
                $precognitionXData = Js::from($data);
            } else {
                // otherwise, it's an empty object
                $precognitionXData = '{}';
            }

            $componentBuilder->setAttribute('x-data', $precognitionXData);
        }
    }
}
