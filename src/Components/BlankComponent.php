<?php

namespace AppKit\Formulate\Components;

use AppKit\Formulate\Facades\Formulate;
use AppKit\Formulate\FormulateComponentAttributeBag;
use Illuminate\View\Component;

class BlankComponent extends Component
{
    /**
     * Get the view / contents that represent the component
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        return view('formulate::components.blank');
    }
}
