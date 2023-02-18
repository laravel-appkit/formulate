<?php

namespace AppKit\Formulate\Components;

use AppKit\Formulate\Facades\Formulate;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use Illuminate\View\ComponentAttributeBag;

class InputComponent extends Component
{
    /**
     * A reference to this instance of the input component
     * @var InputComponent
     */
    public InputComponent $field;

    /**
     * An attribute bag to store all of the attributes that are placed on the group element
     * @var ComponentAttributeBag
     */
    public ComponentAttributeBag $groupAttributes;

    /**
     * An attribute bag to store all of the attributes that are placed on the label element
     * @var ComponentAttributeBag
     */
    public ComponentAttributeBag $labelAttributes;

    public function __construct(
        public string $name,
        public bool $checked = false,
        public ?string $id = null,
        public ?string $label = null,
        public string $type = 'text',
        public mixed $value = null,
    ) {
        // store an instance of this class as the field, this is passed to child components
        $this->field = $this;

        // create instances of the necessary attribute bags
        $this->groupAttributes = $this->newAttributeBag();
        $this->labelAttributes = $this->newAttributeBag();

        // register the field with the service provider
        Formulate::registerField($this);

        // if the field does not have a defined id, then generate one
        $this->id = $this->id ?: Formulate::generateFieldId($this);

        // if we don't have a label, then we need to generate one
        $this->label = $this->label ?: ucfirst(str_replace(['-', '_'], ' ', $this->name));

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
    }

    /**
     * Set the extra attributes that the component should make available.
     *
     * @param  array  $attributes
     * @return $this
     */
    public function withAttributes(array $attributes)
    {
        // make sure that we have an attribute bag setup for everything
        $this->attributes = $this->attributes ?: $this->newAttributeBag();

        // split out all of the attribute bags
        $this->attributes->setAttributes($this->getPrefixedAttributes($attributes));
        $this->groupAttributes->setAttributes($this->getPrefixedAttributes($attributes, 'group'));
        $this->labelAttributes->setAttributes($this->getPrefixedAttributes($attributes, 'label'));

        // add the default attributes to each attribute bag
        $this->setDefaultAttributeValues($this->attributes, ['class' => config('formulate.classes.field')]);
        $this->setDefaultAttributeValues($this->groupAttributes, ['class' => config('formulate.classes.group')]);
        $this->setDefaultAttributeValues($this->labelAttributes, ['class' => config('formulate.classes.label')]);

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
    public function getPrefixedAttributes(array $attributes, ?string $prefix = null): array {
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
     * Add default attributes into an existing attribute bag
     *
     * @param ComponentAttributeBag $attributeBag
     * @param array $defaults
     * @return void
     */
    public function setDefaultAttributeValues(ComponentAttributeBag $attributeBag, array $defaults = []) {
        // loop through each of the defaults
        foreach ($defaults as $attribute => $value) {
            // check if we don't already have a value for it
            if (!$attributeBag->has($attribute)) {
                // get the current attributes in the bag
                $currentAttributes = $attributeBag->getAttributes();

                // set the attribute
                $currentAttributes[$attribute] = $value;

                // update the attribute bag
                $attributeBag->setAttributes($currentAttributes);
            }
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
