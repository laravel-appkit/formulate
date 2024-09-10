<?php

namespace AppKit\Formulate\Components;

use Illuminate\Console\View\Components\Component;

class RepeatingGroup extends Component
{
    public function __construct(public $name)
    {

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        return view('formulate::components.repeating-group');
    }
}
