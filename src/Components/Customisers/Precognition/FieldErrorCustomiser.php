<?php

namespace AppKit\Formulate\Components\Customisers\Precognition;

use AppKit\Formulate\Facades\Formulate;
use AppKit\UI\ComponentBuilder;
use AppKit\UI\Components\BaseComponent;
use Illuminate\Support\Str;

class FieldErrorCustomiser
{
    public function __invoke(ComponentBuilder $componentBuilder, BaseComponent $instance)
    {
        $name = Str::of($instance->name)->remove('[]');

        $stringName = "'" . $name . "'";

        if (Formulate::getCurrentField()->multiple) {
            $stringName = "'" . $name . ".' + index";
        }

        $componentBuilder->setAttribute('x-text', 'form[\'errors\'][' . $stringName . ']');
    }
}
