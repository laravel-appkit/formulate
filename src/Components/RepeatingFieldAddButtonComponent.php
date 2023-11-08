<?php

namespace AppKit\Formulate\Components;

use Illuminate\View\Component;

class RepeatingFieldAddButtonComponent extends BaseComponent
{
    /**
     * Initialise the label component
     *
     * @param InputComponent $field
     * @return void
     */
    public function __construct(public InputComponent $field, public string $repeaterId)
    {

    }

    /**
     * Define the view name that is used for the component
     *
     * @return string
     */
    protected function viewName()
    {
        return 'formulate::components.repeating-field-add-button';
    }
}
