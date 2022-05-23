<?php

namespace AppKit\Formulate\Components;

use AppKit\Formulate\Facades\Formulate;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class InputComponent extends Component
{
    public $checked = false;
    public $field;
    public $groupAttributes;
    public $id;
    public $label;
    public $labelAttributes;
    public $name;
    public $type;
    public $value;

    public function __construct($name, $checked = false, $id = null, $label = null, $type = 'text', $value = null)
    {
        $this->checked = $checked;
        $this->field = $this;
        $this->id = $id;
        $this->label = $label;
        $this->name = $name;
        $this->type = $type;

        // register the field with the service provider
        Formulate::registerField($this);

        // if the field does not have a defined id
        if (empty($id)) {
            // formulate will generate one
            $this->id = Formulate::generateFieldId($this);
        }

        // if we don't have a label
        if (empty($label)) {
            // then generate one
            $this->label = ucfirst(str_replace(['-', '_'], ' ', $name));
        }

        // if this is a checkable type
        if ($type == 'checkbox' || $type == 'radio') {
            // the value on the field is the one we have passed
            $this->value = $value;

            // the checked value comes from the service provider
            $checkedValue = Formulate::getFieldValue($this->name);

            // if we have a checked value
            if (!is_null($checkedValue)) {
                // which is a boolean
                if (is_bool($checkedValue)) {
                    // we check the field based on that
                    $this->checked = $checkedValue;
                } else {
                    // otherwise, we check if the value passed to the form matches the value of the field
                    $this->checked = $checkedValue == $value;
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
        $this->attributes = $this->attributes ?: $this->newAttributeBag();
        $this->groupAttributes = $this->groupAttributes ?: $this->newAttributeBag();
        $this->labelAttributes = $this->labelAttributes ?: $this->newAttributeBag();

        $this->attributes->setAttributes(
            collect($attributes)->filter(function ($attributeValue, $attribute) {
                return !Str::of($attribute)->startsWith('group:') && !Str::of($attribute)->startsWith('label:');
            })->toArray()
        );

        $this->groupAttributes->setAttributes(
            collect($attributes)->filter(function ($attributeValue, $attribute) {
                return Str::of($attribute)->startsWith('group:');
            })->mapWithKeys(function ($attributeValue, $attribute) {
                return [str_replace('group:', '', $attribute) => $attributeValue];
            })->toArray()
        );

        $this->labelAttributes->setAttributes(
            collect($attributes)->filter(function ($attributeValue, $attribute) {
                return Str::of($attribute)->startsWith('label:');
            })->mapWithKeys(function ($attributeValue, $attribute) {
                return [str_replace('label:', '', $attribute) => $attributeValue];
            })->toArray()
        );

        return $this;
    }

    /**
     * Get the data that should be supplied to the view.
     *
     * @author Freek Van der Herten
     * @author Brent Roose
     *
     * @return array
     */
    public function data()
    {
        $this->attributes = $this->attributes ?: $this->newAttributeBag();
        $this->groupAttributes = $this->groupAttributes ?: $this->newAttributeBag();
        $this->labelAttributes = $this->labelAttributes ?: $this->newAttributeBag();

        return array_merge($this->extractPublicProperties(), $this->extractPublicMethods());
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
