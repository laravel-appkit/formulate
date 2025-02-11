<?php

namespace AppKit\Formulate\Components;

use AppKit\Formulate\Components\Customisers\AlpineJs\FormCustomiser as AlpineJsFormCustomiser;
use AppKit\Formulate\Components\Customisers\Precognition\FieldErrorCustomiser as PrecognitionFieldErrorCustomiser;
use AppKit\Formulate\Components\Customisers\Precognition\FormCustomiser as PrecognitionFormCustomiser;
use AppKit\Formulate\Components\Customisers\Precognition\InputCustomiser as PrecognitionInputCustomiser;
use AppKit\Formulate\Facades\Formulate;
use AppKit\Formulate\FormulateComponentAttributeBag;
use AppKit\Formulate\Helpers\Routing\Route;
use AppKit\UI\Components\FieldError;
use AppKit\UI\Components\Form as UIForm;
use AppKit\UI\Components\Input;
use AppKit\UI\Facades\UI;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class Form extends Component
{
    public ?Route $routeDetails = null;

    public function __construct(
        public string $action = '',
        public ?string $method = null,
        public ?string $route = null,
        public array $rules = [],
        ?array $routeParams = null,
        array | Model $data = []
    ) {
        $alpineAdded = false;

        Formulate::registerForm($this);

        // if we have some data that has been passed into the form
        if (!empty($data)) {
            // pass it to the service provider which is used to populate the fields
            Formulate::populateFormData($data);
        }

        if (!empty($route)) {
            // get the route details
            $this->routeDetails = new Route($route);

            // we have a route, lets get the action from the url
            $this->action = $this->routeDetails->createRouteUrlWithPossibleDefaultBindings($routeParams, $data);

            // if we don't already have a method
            if (empty($this->method)) {
                // use the first available method
                $this->method = $this->routeDetails->getDefaultHttpMethod();
            }

            if (empty($rules)) {
                $requestClassName = $this->routeDetails->getRequestClass();

                if ($requestClassName) {
                    $requestClass = new $requestClassName();

                    if (method_exists($requestClass, 'rules')) {
                        $this->rules = $requestClass->rules();
                    }
                }
            }

            if ($this->routeDetails->supportsPrecognition()) {
                UI::customiseComponents([
                    FieldError::class => PrecognitionFieldErrorCustomiser::class,
                    UIForm::class => PrecognitionFormCustomiser::class,
                    Input::class => PrecognitionInputCustomiser::class,
                ]);

                $alpineAdded = true;
            }
        }

        if (!$alpineAdded) {
            UI::customiseComponents([
                UIForm::class => AlpineJsFormCustomiser::class,
            ]);
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
        return view('formulate::components.form');
    }
}
