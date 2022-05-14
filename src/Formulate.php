<?php

namespace AppKit\Formulate;

use Illuminate\Database\Eloquent\Model;

class Formulate
{
    private $app;

    protected $formData;

    protected $currentField;

    protected $currentFieldValue;

    public function __construct()
    {
        $this->app = app();
    }

    public function populateFormData($data)
    {
        $this->formData = $data;
    }

    public function getFormData()
    {
        return $this->formData;
    }

    public function getCurrentField()
    {
        return $this->currentField;
    }

    public function getCurrentFieldValue()
    {
        return $this->currentFieldValue;
    }

    public function getFieldValue($field, $defaultValue = '')
    {
        $this->currentField = $field;

        $value = $defaultValue;

        // if we have a value in the "old" request, it should come next
        if (!empty($this->app['request']->old($field))) {
            $value = $this->app['request']->old($field);
        } elseif ($this->formData instanceof Model && !empty($this->formData->getAttribute($field))) {
            // then we try and get the attribute from a model
            $value = $this->formData->getAttribute($field);
        } elseif (is_array($this->formData) && array_key_exists($field, $this->formData)) {
            // or from an array
            $value = $this->formData[$field];
        }

        $this->currentFieldValue = $value;

        return $value;
    }
}
