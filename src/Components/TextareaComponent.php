<?php

namespace AppKit\Formulate\Components;

class TextareaComponent extends InputComponent
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
