<?php

namespace AppKit\Formulate\Components;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ViewErrorBag;
use Illuminate\View\Component;

class FieldErrorComponent extends Component
{
    public function __construct(public InputComponent $field)
    {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        return view('formulate::components.field-errors');
    }

    /**
     * Should this component render
     *
     * @return bool
     */
    public function shouldRender()
    {
        // get the errors that are being shared with the View
        $errors = View::shared('errors', new ViewErrorBag);

        // check that if we have errors in this bag or not, which will determine if the component is rendered or not
        return $errors->has($this->field->name);
    }
}
