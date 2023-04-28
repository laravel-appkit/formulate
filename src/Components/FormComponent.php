<?php

namespace AppKit\Formulate\Components;

use AppKit\Formulate\Facades\Formulate;
use AppKit\Formulate\FormulateComponentAttributeBag;
use AppKit\Formulate\Helpers\Routing\Route;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class FormComponent extends Component
{
    public function __construct(
        public string $action = '',
        public ?string $method = null,
        public ?string $route = null,
        ?array $routeParams = null,
        array | Model $data = []
    ) {
        Formulate::registerForm($this);

        // if we have some data that has been passed into the form
        if (!empty($data)) {
            // pass it to the service provider which is used to populate the fields
            Formulate::populateFormData($data);
        }

        if (!empty($route)) {
            // get the route details
            $routeDetails = new Route($route);

            // we have a route, lets get the action from the url
            $this->action = $routeDetails->createRouteUrlWithPossibleDefaultBindings($routeParams, $data);

            // if we don't already have a method
            if (empty($this->method)) {
                // use the first available method
                $this->method = $routeDetails->getDefaultHttpMethod();
            }
        }
    }

    /**
     * Get a new attribute bag instance.
     *
     * @param  array  $attributes
     * @return AppKit\Formulate\FormulateComponentAttributeBag
     */
    protected function newAttributeBag(array $attributes = [])
    {
        return new FormulateComponentAttributeBag($attributes);
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        return function ($data) {
            return view('formulate::components.form', Formulate::applyComponentMiddleware($this, $data))->render();
        };
    }
}
