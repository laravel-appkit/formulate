<?php

namespace AppKit\Formulate\Components;

use Illuminate\View\Component;

class ReorderableListComponent extends BaseComponent
{
    /**
     * Initialise the label component
     *
     * @param InputComponent $field
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Define the view name that is used for the component
     *
     * @return string
     */
    protected function viewName()
    {
        return 'formulate::components.reorderable-list';
    }
}
