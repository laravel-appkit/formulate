<?php

namespace AppKit\Formulate\Components;

use AppKit\Formulate\Facades\Formulate;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class CheckablesComponent extends InputComponent
{
    public function __construct(
        public string $name,
        public string $type,
        public ?string $id = null,
        public ?string $label = null,
        public mixed $value = null,
        public array | EloquentCollection | SupportCollection $options = [],
    ) {
        // the InputComponent will sort out most of the stuff for us
        parent::__construct($name, false, $id, $label, 'select', $value);

        // $this->field = $this;
        $this->id = $id;
        $this->label = $label;
        $this->name = $name;
        $this->type = $type;
        $this->options = $options;

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
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        return view('formulate::components.checkables');
    }
}
