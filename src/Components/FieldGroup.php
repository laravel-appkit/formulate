<?php

namespace AppKit\Formulate\Components;

use AppKit\Formulate\Components\Customisers\RepeatingFields\InputCustomiser;
use AppKit\Formulate\Components\Customisers\RepeatingFields\LabelCustomiser;
use AppKit\UI\Components\Input;
use AppKit\UI\Components\Label;
use AppKit\UI\Facades\UI;
use Illuminate\View\Component;

class FieldGroup extends Component
{
    /**
     * Initialise the field group component
     *
     * @param Input $field
     * @return void
     */
    public function __construct(public ?string $name = '', public bool $multiple = false, public bool $orderable = false, public string $label = '')
    {
        if ($multiple) {
            UI::customiseComponents([
                // FieldError::class => FieldErrorCustomiser::class,
                // Form::class => FormCustomiser::class,
                Input::class => InputCustomiser::class,
                Label::class => LabelCustomiser::class,
            ]);
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        return view('formulate::components.field-group');
    }
}
