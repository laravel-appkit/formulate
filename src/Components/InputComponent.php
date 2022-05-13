<?php

namespace AppKit\Formulate\Components;

use AppKit\Formulate\Facades\Formulate;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class InputComponent extends Component
{
    public $id;

    public $name;

    public $type;

    public $groupAttributes;

    public $labelAttributes;

    public $label;

    public $value;

    public function __construct($name, $type = 'text', $id = null, $label = null, $value = null)
    {
        $this->name = $name;
        $this->type = $type;
        $this->id = $id;
        $this->label = $label;
        $this->value = Formulate::getFieldValue($this->name, $value);

        if (empty($id)) {
            $this->id = $this->name;
        }

        if (empty($label)) {
            $this->label = ucfirst(str_replace(['-', '_'], ' ', $name));
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
