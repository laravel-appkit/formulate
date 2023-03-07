<?php

namespace AppKit\Formulate\Helpers\Routing;

use Illuminate\Contracts\Routing\UrlRoutable;

class RouteParameter
{
    public RouteParameterType $routeParameterType = RouteParameterType::Other;

    public function __construct(
        public string $name,
        public ?string $typeHint,
        public bool $optional,
    ) {
        if ($this->typeHint != null) {
            // check if the type hint on the parameter extends (or is) a request
            if (is_a($this->typeHint, 'Illuminate\Http\Request', true)) {
                // set the type to the request
                $this->routeParameterType = RouteParameterType::Request;
            } elseif (is_a($this->typeHint, UrlRoutable::class, true)) {
                // check if the type hint is an instance of UrlRoutable
                $this->routeParameterType = RouteParameterType::UrlRoutable;
            }
        }
    }
}
