<?php

namespace AppKit\Formulate\Components;

use Illuminate\View\Component;

class Submit extends Component
{
    /**
     * Initialise the label component
     *
     * @param InputComponent $field
     * @return void
     */
    public function __construct(public string $label, public string $type = 'submit')
    {

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        return view('formulate::components.submit-button');
    }
}
