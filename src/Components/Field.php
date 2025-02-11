<?php

namespace AppKit\Formulate\Components;

use AppKit\Formulate\Facades\Formulate;
use Illuminate\View\Component;

class Field extends Component
{
    /**
     * The form that this field belongs to
     *
     * @var Form
     */
    public ?Form $form;

    public function __construct(
        public string $name,
        public ?string $id = null,
        public array $rules = [],
        public bool $checked = false,
        public bool $ignoreFieldGroup = false,
        public bool $multiple = false,
        public bool $orderable = false,
        public bool $required = false,
        public mixed $value = null,
        public string $type = 'text',
    ) {
        // assign the current form
        $this->form = Formulate::getForm();

        // register the field with the service provider
        Formulate::registerField($this);

        // if the field does not have a defined id, then generate one
        $this->id = $this->id ?: Formulate::generateFieldId($this);

        // if this is a checkable type
        if ($this->type == 'checkbox' || $this->type == 'radio') {
            // the value on the field is the one we have passed
            $this->value = $value;

            // the checked value comes from the service provider
            $checkedValue = Formulate::getFieldValue($this->name);

            // if we have a checked value
            if (!is_null($checkedValue)) {
                if (is_array($checkedValue)) {
                    $this->checked = in_array($value, $checkedValue);
                } else {
                    // which is a boolean
                    if (is_bool($checkedValue)) {
                        // we check the field based on that
                        $this->checked = $checkedValue;
                    } else {
                        // otherwise, we check if the value passed to the form matches the value of the field
                        $this->checked = $checkedValue == $value;
                    }
                }
            }
        } else {
            // for all other fields, we just get the value from the service provider
            $this->value = Formulate::getFieldValue($this->name, $value);
        }

        if (empty($this->rules) && !empty($this->form->rules) && array_key_exists($this->name, $this->form->rules)) {
            $this->rules = $this->form->rules[$this->name];
        }

        if (!$this->required && in_array('required', $this->rules)) {
            $this->required = true;
        }
    }

    /**
     * Get the default value for the given field
     *
     * @return mixed
     */
    public function getDefaultValue(): mixed
    {
        if ($this->multiple) {
            return [''];
        }

        return '';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        return view('formulate::components.field');
    }
}
