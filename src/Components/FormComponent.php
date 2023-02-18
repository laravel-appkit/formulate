<?php

namespace AppKit\Formulate\Components;

use AppKit\Formulate\Facades\Formulate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class FormComponent extends Component
{
    public function __construct(
        public string $action = '',
        public ?string $method = null,
        public ?string $route = null,
        array $routeParams = [],
        array | Model $data = [],
    ) {
        // if we have some data that has been passed into the form
        if (!empty($data)) {
            // pass it to the service provider which is used to populate the fields
            Formulate::populateFormData($data);
        }

        if (!empty($route)) {
            // we have a route, lets get the action from the url
            $this->action = route($route, $routeParams);

            // if we don't already have a method
            if (empty($this->method)) {
                // find the route that we have specified
                $routes = app('router')->getRoutes();
                $route = method_exists($routes, 'getByName') ? $routes->getByName($route) : $routes->get($route);

                // use the first available method
                $this->method = $route->methods[0];
            }
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        return view('formulate::components.form');
    }
}
