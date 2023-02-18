<?php

namespace AppKit\Formulate\Components;

use Illuminate\View\Component;

class FieldErrorComponent extends Component
{
    public function __construct(public InputComponent $field)
    {

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        return view('formulate::components.field-errors');
    }
}
