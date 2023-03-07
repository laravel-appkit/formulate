<?php

namespace AppKit\Formulate\Helpers\Routing;

use Illuminate\Http\Request;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Routing\Router;
use Illuminate\Support\Collection;
use ReflectionClass;

class Route
{
    /**
     * The laravel router instance
     *
     * @var Router
     */
    protected Router $router;

    /**
     * The laravel router instance of the route that we are requesting - this could be null if the router doesn't
     * have a matching name
     *
     * @var RoutingRoute
     */
    protected ?RoutingRoute $route;

    /**
     * A collection of parameters that the controller method expects
     *
     * @var Collection
     */
    protected Collection $params;

    public function __construct(public string $routeName)
    {
        // create a collection to store the params
        $this->params = new Collection();

        // get an instance of the router
        $this->router = app('router');

        // find the route in the router
        $this->route = app('router')->getRoutes()->getByName($this->routeName);

        // there is a chance we can't find a route
        if ($this->route) {
            // parse the action for the controller and method
            [$controller, $method] = explode('@', $this->route->action['uses']);

            // create a reflection of the controller
            $controllerReflection = new ReflectionClass($controller);

            // and a reflection of the method
            $methodReflection = $controllerReflection->getMethod($method);

            // loop through each of the parameters on the method
            foreach ($methodReflection->getParameters() as $parameter) {
                // start out assuming this is an "other" parameter
                $parameterType = 'other';

                // add the parameter to the collection
                $this->params->push(new RouteParameter(
                    $parameter->getName(),
                    $parameter->hasType() ? $parameter->getType()->getName() : null,
                    $parameter->isOptional(),
                ));
            }
        }
    }

    /**
     * Return the class name for any request passed to the controller
     *
     * @return null|string
     */
    public function getRequestClass(): ?string
    {
        // get any parameters that are marked as a request
        $parameter = $this->params->where('routeParameterType', RouteParameterType::Request)->first();

        // if we do have a parameter
        if ($parameter) {
            // then get it's type hint
            return $parameter->typeHint;
        }

        return null;
    }

    /**
     * Get all of the parameters that are routable
     *
     * @return Collecting
     */
    public function getRoutableParameters(): Collection
    {
        return $this->params->where('routeParameterType', RouteParameterType::UrlRoutable)->values();
    }

    /**
     * Get any additional, non-optional, parameters
     *
     * @return Collection
     */
    public function getExtraneousParameters(): Collection
    {
        return $this->params->where('routeParameterType', RouteParameterType::Other)->where('optional', false)->values();
    }

    /**
     * Create a route url
     *
     * @param mixed $routeParams
     * @return string
     */
    public function createRouteUrl(mixed $routeParams = []): string
    {
        return route($this->routeName, $routeParams);
    }

    public function createRouteUrlWithPossibleDefaultBindings(mixed $definedRouteParams = [], mixed $possibleDefaultBindings = null): string
    {
        // we should only try and use the default bindings if we haven't already defined params
        if (is_null($definedRouteParams) && !is_null($possibleDefaultBindings)) {
            // check that we only have one routable parameter and no extraneous parameters
            if (count($this->getRoutableParameters()) == 1 && count($this->getExtraneousParameters()) == 0) {
                // pull out the routable parameter
                $routableParam = $this->getRoutableParameters()[0];

                // check that the provided possible default bindings match the type hint of the routable parameter
                if (is_a(get_class($possibleDefaultBindings), $routableParam->typeHint, true)) {
                    $definedRouteParams = [$routableParam->name => $possibleDefaultBindings];
                }
            }
        }

        // generate the route URL
        return $this->createRouteUrl($definedRouteParams);
    }

    public function getDefaultHttpMethod()
    {
        return app('router')->getRoutes()->getByName($this->routeName)->methods[0];
    }
}
