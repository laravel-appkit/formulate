<?php

namespace AppKit\Formulate\Components\Customisers\Precognition;

use AppKit\UI\ComponentBuilder;
use AppKit\UI\Components\BaseComponent;

class InputCustomiser
{
    public function __invoke(ComponentBuilder $componentBuilder, BaseComponent $instance)
    {
        $componentBuilder->setAttribute('x-model', 'form.' . $instance->name);
        $componentBuilder->setAttribute('@change', 'form.validate(\'' . $instance->name . '\')');
    }
}
