<?php

namespace AppKit\Formulate\Components;

use Illuminate\View\Component;

class FieldGroupComponent extends Component
{
    public $field;

    public function __construct($field)
    {
        $this->field = $field;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        return view('formulate::components.field-group');
    }
}