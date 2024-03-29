<?php

namespace AppKit\Formulate\Components;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class RepeatingFieldComponent extends BaseComponent
{
    public string $label;

    public string $labelAttributes;

    public string $repeaterId;

    /**
     * Initialise the label component
     *
     * @param InputComponent $field
     * @return void
     */
    public function __construct(public InputComponent $field)
    {
        $this->labelAttributes = $this->field->labelAttributes->get('class');

        $this->label = Str::of($field->label)->plural()->toString();

        $this->repeaterId = 'repeater' . uniqid();
    }

    /**
     * Define the view name that is used for the component
     *
     * @return string
     */
    protected function viewName()
    {
        if ($this->field->multiple) {
            return 'formulate::components.repeating-field';
        }

        return 'formulate::components.blank';
    }
}
