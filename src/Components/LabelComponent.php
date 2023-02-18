<?php

namespace AppKit\Formulate\Components;

use Illuminate\View\Component;

class LabelComponent extends Component
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
        return view('formulate::components.label');
    }
}
