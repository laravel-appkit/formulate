<?php

namespace AppKit\Formulate\Tests;

use AppKit\Formulate\Facades\Formulate;

class InputValidationTest extends TestCase
{
    /**
     *@test
    * @group x-formulate-input
    */
    public function inputsThatAreRequiredHaveARequiredAttribute()
    {
        $view = $this->blade('<x-formulate::input name="my-input" required></x-formulate::input>');

        $view->assertHasElement('input')->withAttribute('required');
    }

    /**
     *@test
    * @group x-formulate-input
    */
    public function inputsThatAreNotRequiredDoNotHaveTheRequiredAttribute()
    {
        $view = $this->blade('<x-formulate::input name="my-input"></x-formulate::input>');

        $view->assertHasElement('input')->withoutAttribute('required');
    }

    /**
     *@test
    * @group x-formulate-input
    */
    public function inputsThatAreRequiredHaveAnAsteriskInTheLabel()
    {
        $view = $this->blade('<x-formulate::input name="my-input" required></x-formulate::input>');

        $view->assertHasElement('label')->assertElementExists('span')->withContentContaining('*');
    }

    /**
     *@test
    * @group x-formulate-input
    */
    public function inputsThatAreNotRequiredDoNotHaveAnAsteriskInTheLabel()
    {
        $view = $this->blade('<x-formulate::input name="my-input"></x-formulate::input>');

        $view->assertHasElement('label')->assertElementDoesntExists('span');
    }

    /**
     *@test
    * @group x-formulate-input
    */
    public function inputsThatAreRequiredDoNotHaveTheOptionalLabel()
    {
        Formulate::highlightOptionalFields();

        $view = $this->blade('<x-formulate::input name="my-input" required></x-formulate::input>');

        $view->assertHasElement('label')->assertElementDoesntExists('span');
    }

    /**
     *@test
    * @group x-formulate-input
    */
    public function inputsThatAreRequiredDoHaveTheOptionalLabel()
    {
        Formulate::highlightOptionalFields();

        $view = $this->blade('<x-formulate::input name="my-input"></x-formulate::input>');

        $view->assertHasElement('label')->assertElementExists('span')->withContentContaining('Optional');
    }
}
