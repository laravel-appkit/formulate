<?php

namespace AppKit\Formulate\Components;

use Illuminate\Support\Str;
use Illuminate\Support\ViewErrorBag;
use Illuminate\View\Component;
use Illuminate\View\ComponentAttributeBag;

/** @package AppKit\Formulate\Components */
class Input extends Component
{
    public ?ComponentAttributeBag $groupAttributes = null;

    public function __construct(
        public string $name,
        public ?string $error = '',
        public ?string $help = '',
        public ?string $label = '',
        public ?string $id = null,
        public bool $multiple = false,
        public bool $orderable = false,
        public bool $required = false,
    ) {
        // if we don't have a label, then we need to generate one
        // TODO: Make this into a closure that userland code can modify to give custom logic
        $this->label = $this->label ?: ucfirst(str_replace(['-', '_'], ' ', Str::snake($this->name)));

        // if we haven't specified an error
        if (!$this->error && request()->hasSession()) {
            // we should get the correct error bag
            $errors = request()->session()->get('errors') ?: new ViewErrorBag();

            // and if it has an error for this field
            if ($errors->has($this->name)) {
                // use the first one as the error
                $this->error = $errors->first($this->name);
            }
        }
    }

    public function withAttributes(array $attributes)
    {
        parent::withAttributes($attributes);

        $this->groupAttributes = $this->groupAttributes ?: $this->newAttributeBag();

        foreach ($this->attributes as $attribute => $value) {
            if (Str::of($attribute)->contains(':')) {
                $this->groupAttributes = $this->groupAttributes->merge([Str::of($attribute)->replace('group:', '')->toString() => $value]);
            }
        }
    }

    public function data()
    {
        return array_merge(parent::data(), ['groupAttributes' => $this->groupAttributes]);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        return function ($data) {
            return view('formulate::components.input', array_merge($data, $this->data()))->render();
        };
    }
}
