<?php

namespace AppKit\Formulate\Components;

use AppKit\Formulate\Facades\Formulate;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;

class SelectComponent extends InputComponent
{
    public $options = [];

    public function __construct($name, $type = 'text', $id = null, $label = null, $value = null, $options = [])
    {
        $this->name = $name;
        $this->type = $type;
        $this->id = $id;
        $this->label = $label;
        $this->value = Formulate::getFieldValue($this->name, $value);
        $this->field = $this;

        if (empty($id)) {
            $this->id = $this->name;
        }

        if (empty($label)) {
            $this->label = ucfirst(str_replace(['-', '_'], ' ', $name));
        }

        $this->options = $options;

        if ($this->options instanceof Collection) {
            $newOptions = [];

            foreach ($this->options as $option) {
                $title = null;

                if ($option->offsetExists('name')) {
                    $title = $option->name;
                } elseif ($option->offsetExists('title')) {
                    $title = $option->title;
                } else {
                    $title = class_basename($option) . ' #' . $option->getKey();
                }

                $newOptions[$option->getKey()] = $title;
            }

            $this->options = $newOptions;
        }

        if ($this->options instanceof SupportCollection) {
            $this->options = $this->options->toArray();
        }

        // $this->options = array_merge([null => '-- Please Select --'], $this->options);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        return view('formulate::components.select');
    }
}
