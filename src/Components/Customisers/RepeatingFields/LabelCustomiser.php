<?php

namespace AppKit\Formulate\Components\Customisers\RepeatingFields;

use AppKit\UI\ComponentBuilder;
use AppKit\UI\Components\BaseComponent;

class LabelCustomiser
{
    public function __invoke(ComponentBuilder $componentBuilder, BaseComponent $instance)
    {
        $componentBuilder->addClass('hidden');
        $componentBuilder->setAttribute('x-text', '\'' . $instance->label . ' \' + (index + 1) + \' of \' + form.' . 'link' . '.length');
        // $componentBuilder->setAttribute(':for', '\'' . $this->field->id . '_\' + index');
    }
}
