<?php

namespace AppKit\Formulate\Components;

use AppKit\Formulate\Facades\Formulate;
use Illuminate\View\Component;

class OptionComponent extends Component
{
    /**
     * If the current option in the select is selected
     * @var bool
     */
    public bool $selected = false;

    public function __construct(public string $value)
    {
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
