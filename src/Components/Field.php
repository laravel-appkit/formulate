<?php

namespace AppKit\Formulate\Components;

use AppKit\Formulate\Facades\Formulate;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Field extends Component
{
    /**
     * The form that this field belongs to
     *
     * @var Form
     */
    public Form $form;

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
     * Set the extra attributes that the component should make available.
     *
     * @param  array  $attributes
     * @return $this
     */
    public function withAttributes(array $attributes): self
    {
        // make sure that we have an attribute bag setup for everything
        $this->attributes = $this->attributes ?: $this->newAttributeBag();

        // return the instance of the component
        return $this;
    }

    /**
     * Filter out a list of attributes based on the prefix
     *
     * @param array $attributes
     * @param null|string $prefix
     * @return array
     */
    public function getPrefixedAttributes(array $attributes, ?string $prefix = null): array
    {
        // filter over a collection of attributes
        return collect($attributes)->filter(function ($attributeValue, $attribute) use ($prefix) {
            // special case if we are dealing with the null prefix
            if (is_null($prefix)) {
                // in which case, we want to check if the attribute contains any prefix separator
                return !Str::of($attribute)->contains(':');
            }

            // pick this one if it starts with the correct prefix
            return Str::of($attribute)->startsWith($prefix . ':');
        })->mapWithKeys(function ($attributeValue, $attribute) use ($prefix) {
            // strip the prefix off of the attribute name
            $attribute = Str::of($attribute)->replace($prefix . ':', '')->__toString();

            return [$attribute => $attributeValue];
        })->toArray();
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
