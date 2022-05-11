<?php

namespace AppKit\Formulate\Components;

use Illuminate\View\Component;

class InputComponent extends Component
{
    public $id;

    public $name;

    public $type;

    public function __construct($name, $type = 'text', $id = null)
    {
        $this->name = $name;
        $this->type = $type;
        $this->id = $id;

        if (empty($id)) {
            $this->id = $this->name;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        return view('formulate::components.input');
    }
}
