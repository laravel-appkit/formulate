<?php

namespace AppKit\Formulate\Helpers\Routing;

enum RouteParameterType {
    case Request;
    case UrlRoutable;
    case Other;
}
