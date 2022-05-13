<?php

namespace AppKit\Formulate\Components;

use AppKit\Formulate\Facades\Formulate;
use Illuminate\View\Component;

class FormComponent extends Component
{
    public $action;

    public $method;

    public $route;

    public function __construct($action = '', $data = [], $method = null, $route = null)
    {
        $this->action = $action;
        $this->method = $method;

        if (!empty($data)) {
            Formulate::populateFormData($data);
        }

        if (!empty($route)) {
            // we have a route, lets get the action from the url
            $this->action = route($route);

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
