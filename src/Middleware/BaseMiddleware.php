<?php

namespace AppKit\Formulate\Middleware;

use AppKit\Formulate\Facades\Formulate;

abstract class BaseMiddleware
{
    public $form;
    public $field;

    public function __construct()
    {
        $this->form = Formulate::getForm();
        $this->field = Formulate::getCurrentField();
    }

    public function shouldApply()
    {
        return true;
    }
}
