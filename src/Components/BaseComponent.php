<?php

namespace AppKit\Formulate\Components;

use AppKit\Formulate\Components\Concerns\InheritsAttributes;
use AppKit\Formulate\Facades\Formulate;
use AppKit\Formulate\FormulateComponentAttributeBag;
use Illuminate\View\Component;

abstract class BaseComponent extends Component
{
    /**
     * Get a new attribute bag instance
     *
     * @param  array  $attributes
     * @return AppKit\Formulate\FormulateComponentAttributeBag
     */
    protected function newAttributeBag(array $attributes = [])
    {
        return new FormulateComponentAttributeBag($attributes);
    }

    /**
     * Define the view name that is used for the component
     *
     * @return string
     */
    abstract protected function viewName();

    /**
     * Get the view / contents that represent the component
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        return function ($data) {
            return view($this->viewName(), Formulate::applyComponentMiddleware($this, $data))->render();
        };
    }
}
