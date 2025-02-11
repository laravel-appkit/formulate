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
        return function ($data) {
            return view('formulate::components.textarea',array_merge($data, $this->data()))->render();
        };
    }
}
