<?php

namespace AppKit\Formulate\Components\Customisers\Precognition;

use AppKit\Formulate\Facades\Formulate;
use AppKit\UI\ComponentBuilder;
use AppKit\UI\Components\BaseComponent;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Js;
use Illuminate\Support\ViewErrorBag;

class FormCustomiser {
    public function __invoke(ComponentBuilder $componentBuilder, BaseComponent $instance)
    {
        // generate the x-data
        $data = Formulate::getFields()->mapWithKeys(function ($field) {
            return [$field->name => $field->value ?? $field->getDefaultValue()];
        });

        $errors = View::shared('errors', new ViewErrorBag());

        $precognitionXData = sprintf(
            '{%s: $form(\'%s\', \'%s\', %s)%s}',
            'form',
            $componentBuilder->getAttributeBag()->get('method'),
            $componentBuilder->getAttributeBag()->get('action'),
            Js::from($data),
            $errors->isEmpty() ? '' : '.setErrors(' . Js::from($errors->messages()) . ')'
        );

        $componentBuilder->setAttribute('x-data', $precognitionXData);
    }
}
