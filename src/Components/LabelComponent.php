<?php

namespace AppKit\Formulate\Components;

use AppKit\Formulate\Components\Concerns\InheritsAttributes;
use Illuminate\View\Component;

class LabelComponent extends BaseComponent
{
    use InheritsAttributes;

    /**
     * Initialise the label component
     *
     * @param InputComponent $field
     * @return void
     */
    public function __construct(public InputComponent $field)
    {
        $this->inheritAttributes($this->field->labelAttributes);
    }

    /**
     * Define the view name that is used for the component
     *
     * @return string
     */
    protected function viewName()
    {
        return 'formulate::components.label';
    }
}
