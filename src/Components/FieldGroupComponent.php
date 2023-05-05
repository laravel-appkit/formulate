<?php

namespace AppKit\Formulate\Components;

use AppKit\Formulate\Components\Concerns\InheritsAttributes;
use AppKit\Formulate\Facades\Formulate;
use AppKit\Formulate\FormulateComponentAttributeBag;
use Illuminate\View\Component;

class FieldGroupComponent extends BaseComponent
{
    use InheritsAttributes;

    /**
     * Initialise the field group component
     *
     * @param InputComponent $field
     * @return void
     */
    public function __construct(public InputComponent $field)
    {
        $this->inheritAttributes($field->groupAttributes);
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
