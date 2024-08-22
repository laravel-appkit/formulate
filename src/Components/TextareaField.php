<?php

namespace AppKit\Formulate\Components;

class TextareaField extends Field
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        return view('formulate::components.textarea-field');
    }
}
