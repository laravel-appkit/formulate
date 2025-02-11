<?php

namespace AppKit\Formulate\Components;

class Select extends Input
{
    public function render()
    {
        return function ($data) {
            return view('formulate::components.select', array_merge($data, $this->data()))->render();
        };
    }
}
