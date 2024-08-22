<?php

namespace AppKit\Formulate\Components\Customisers\Precognition;

use AppKit\UI\ComponentBuilder;
use AppKit\UI\Components\BaseComponent;

class FieldErrorCustomiser {
    public function __invoke(ComponentBuilder $componentBuilder, BaseComponent $instance)
    {
        $componentBuilder->setAttribute('x-text', 'form.errors.' . $instance->name);
    }
}
