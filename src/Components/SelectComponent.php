<?php

namespace AppKit\Formulate\Components;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection as SupportCollection;

class SelectComponent extends InputComponent
{
    public function __construct(
        public string $name,
        public ?string $id = null,
        public ?string $label = null,
        public mixed $value = null,
        public array | EloquentCollection | SupportCollection $options = [],
    ) {
        // the InputComponent will sort out most of the stuff for us
        parent::__construct($name, false, $id, $label, 'select', $value);

        // we just need to handle the options
        if ($this->options instanceof EloquentCollection) {
            // get a new array for storing the parsed options
            $newOptions = [];

            foreach ($this->options as $option) {
                if ($option->offsetExists('name')) {
                    // an attribute of name will be our first preference
                    $title = $option->name;
                } elseif ($option->offsetExists('title')) {
                    // then it will be a title attribute
                    $title = $option->title;
                } else {
                    // and if we don't have any of them, we will just generate something
                    $title = class_basename($option) . ' #' . $option->getKey();
                }

                // add the new option to the new options array
                $newOptions[$option->getKey()] = $title;
            }

            // update the options with the parsed ones
            $this->options = $newOptions;
        } elseif ($this->options instanceof SupportCollection) {
            // if this is a standard collection, then we just turn it into an array
            $this->options = $this->options->toArray();
        }
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
