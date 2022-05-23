<?php

namespace AppKit\Formulate;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Formulate
{
    private $app;

    protected $fields;

    protected $formData;

    protected $currentField;

    protected $currentFieldValue;

    public function __construct()
    {
        $this->app = app();
        $this->fields = new Collection();
    }

    public function populateFormData($data)
    {
        $this->formData = $data;
    }

    public function getFormData()
    {
        return $this->formData;
    }

    public function registerField($field)
    {
        $this->fields[] = $field;
    }

    public function getFields()
    {
        return $this->fields;
    }

    public function getCurrentField()
    {
        return $this->currentField;
    }

    public function getCurrentFieldValue()
    {
        return $this->currentFieldValue;
    }

    public function getFieldValue($field, $defaultValue = null)
    {
        $this->currentField = $field;

        $value = $defaultValue;

        // if we have a value in the "old" request, it should come next
        if (!is_null($this->app['request']->old($field))) {
            $value = $this->app['request']->old($field);
        } elseif ($this->formData instanceof Model && !empty($this->formData->getAttribute($field))) {
            // then we try and get the attribute from a model
            $value = $this->formData->getAttribute($field);
        } elseif (is_array($this->formData) && array_key_exists($field, $this->formData)) {
            // or from an array
            $value = $this->formData[$field];
        }

        // if the value if a model, we are going to want its key
        if ($value instanceof Model) {
            $value = $value->getKey();
        }

        // set the current field value
        $this->currentFieldValue = $value;

        return $value;
    }

    public function generateFieldId($field)
    {
        // get the name
        $name = $field->name;

        // find out how many instances of that name we already have
        $index = $this->fields->where('name', $name)->count();

        // check if this is an array type field based on the name
        $array = false;
        if (str_contains($name, '[]')) {
            $array = true;

            // remove the brackets from the end of the field name
            $name = str_replace('[]', '', $name);
        }

        // if the index is more than one, or if its an array, the name is appended with the index
        if ($index != 1 || $array) {
            return $name . '-' . $index;
        }

        // otherwise, we just use the name
        return $name;
    }
}
