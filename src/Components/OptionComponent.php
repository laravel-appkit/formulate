<?php

namespace AppKit\Formulate\Components;

use AppKit\Formulate\Facades\Formulate;
use Illuminate\View\Component;

class OptionComponent extends Component
{
    public $selected = false;

    public $value;

    public function __construct($value)
    {
        $this->value = $value;

        if ($value == Formulate::getCurrentFieldValue()) {
            $this->selected = true;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        return view('formulate::components.option');
    }
}
