<?php

namespace AppKit\Formulate\Components;

use AppKit\Formulate\Facades\Formulate;

class SelectComponent extends InputComponent
{
    public $options = [];

    public function __construct($name, $type = 'text', $id = null, $label = null, $value = null, $options = [])
    {
        $this->name = $name;
        $this->type = $type;
        $this->id = $id;
        $this->label = $label;
        $this->value = Formulate::getFieldValue($this->name, $value);
        $this->field = $this;

        if (empty($id)) {
            $this->id = $this->name;
        }

        if (empty($label)) {
            $this->label = ucfirst(str_replace(['-', '_'], ' ', $name));
        }

        $this->options = $options;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        return view('formulate::components.select');
    }
}
