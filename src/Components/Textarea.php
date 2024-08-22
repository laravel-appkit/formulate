<?php

namespace AppKit\Formulate\Components;

class Textarea extends Input
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        return view('formulate::components.textarea');
    }
}
