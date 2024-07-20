<?php

namespace AppKit\Formulate\Components;

use Illuminate\Support\Str;
use Illuminate\Support\ViewErrorBag;

class Input extends BaseComponent
{
    public function __construct(
        public string $name,
        public ?string $error = '',
        public ?string $help = '',
        public ?string $label = '',
    )
    {
        // if we don't have a label, then we need to generate one
        // TODO: Make this into a closure that userland code can modify to give custom logic
        $this->label = $this->label ?: ucfirst(str_replace(['-', '_'], ' ', Str::snake($this->name)));

        // if we haven't specified an error
        if (!$this->error) {
            // we should get the correct error bag
            $errors = request()->session()->get('errors') ?: new ViewErrorBag;

            // and if it has an error for this field
            if ($errors->has($this->name)) {
                // use the first one as the error
                $this->error = $errors->first($this->name);
            }
        }
    }

    /**
     * Define the view name that is used for the component
     *
     * @return string
     */
    protected function viewName()
    {
        return 'formulate::components.input';
    }
}
