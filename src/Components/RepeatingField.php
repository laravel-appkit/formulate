<?php

namespace AppKit\Formulate\Components;

use Illuminate\View\Component;

class RepeatingField extends Component
{
    /**
     * Construct an instance of this component
     *
     * @param string $name The name of the field being repeated
     * @param string $source The JS source of the repeat
     * @param bool $orderable If the items can be reordered
     */
    public function __construct(
        public string $name,
        public string $source,
        public bool $orderable = true
    ) {

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        return view('formulate::components.repeating-field');
    }
}
