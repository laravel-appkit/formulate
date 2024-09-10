<?php

namespace AppKit\Formulate\Components\Customisers\Precognition;

use AppKit\UI\ComponentBuilder;
use AppKit\UI\Components\BaseComponent;
use Illuminate\Support\Str;

class InputCustomiser
{
    public function __invoke(ComponentBuilder $componentBuilder, BaseComponent $instance)
    {
        $name = Str::of($instance->name)->remove('[]');
        $stringName = "'" . $name . "'";

        if ($instance->multiple) {
            $stringName = "'" . $name . ".' + index";
        }

        $componentBuilder->setAttribute('x-model', 'form[\'' . $name . '\']');
        $componentBuilder->setAttribute('@change', 'form.validate(' . $stringName . ')');
    }
}
