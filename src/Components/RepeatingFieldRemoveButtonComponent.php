<?php

namespace AppKit\Formulate\Components;

use AppKit\Formulate\Components\Concerns\InheritsAttributes;
use Illuminate\View\Component;

class RepeatingFieldRemoveButtonComponent extends BaseComponent
{
    /**
     * Initialise the label component
     *
     * @param InputComponent $field
     * @return void
     */
    public function __construct(public InputComponent $field)
    {

    }

    /**
     * Define the view name that is used for the component
     *
     * @return string
     */
    protected function viewName()
    {
        return 'formulate::components.repeating-field-remove-button';
    }
}
