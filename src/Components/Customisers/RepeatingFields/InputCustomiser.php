<?php

namespace AppKit\Formulate\Components\Customisers\RepeatingFields;

use AppKit\UI\ComponentBuilder;
use AppKit\UI\Components\BaseComponent;
use Illuminate\Support\Str;

class InputCustomiser
{
    /**
     * Run this component customiser
     *
     * @param ComponentBuilder $componentBuilder
     * @param BaseComponent $instance
     * @return void
     */
    public function __invoke(ComponentBuilder $componentBuilder, BaseComponent $instance): void
    {
        // Get the name of the field, without the array part
        $name = Str::of($instance->name)->remove('[]');

        // set the attributes on the input component
        $componentBuilder->setAttribute('x-model', 'form[\'' . $name . '\'][index]');
        $componentBuilder->setAttribute('name', $componentBuilder->getAttributeBag()->get('name') . '[]');
        $componentBuilder->addClass('w-full');
    }
}
