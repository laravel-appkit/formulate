<?php

namespace AppKit\Formulate\Components;

use AppKit\Formulate\Components\Concerns\InheritsAttributes;
use Illuminate\View\Component;

class FieldGroup extends BaseComponent
{
    // use InheritsAttributes;

    /**
     * Initialise the field group component
     *
     * @param Input $field
     * @return void
     */
    public function __construct(public ?string $name = '')
    {
        // $this->inheritAttributes($field->groupAttributes);
    }

    /**
     * Define the view name that is used for the component
     *
     * @return string
     */
    protected function viewName()
    {
        return 'formulate::components.field-group';
    }
}
