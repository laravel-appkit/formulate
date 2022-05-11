<?php

namespace AppKit\Formulate\Components;

use Illuminate\View\Component;

class FormComponent extends Component
{
    public $method;

    public function __construct($method = 'GET')
    {
        $this->method = $method;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        return view('formulate::components.form');
    }
}
