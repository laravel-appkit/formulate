<?php

namespace AppKit\Formulate;

use Illuminate\Database\Eloquent\Model;

class Formulate
{
    private $app;

    protected $formData;

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

    public function getFieldValue($field, $defaultValue = '')
    {
        // if we have a value in the "old" request, it should come next
        if (!empty($this->app['request']->old($field))) {
            return $this->app['request']->old($field);
        }

        // then we try and get the attribute from a model
        if ($this->formData instanceof Model && !empty($this->formData->getAttribute($field))) {
            return $this->formData->getAttribute($field);
        }

        // or from an array
        if (is_array($this->formData) && array_key_exists($field, $this->formData)) {
            return $this->formData[$field];
        }

        // as a last resort, we will revert to the default value
        return $defaultValue;
    }
}
