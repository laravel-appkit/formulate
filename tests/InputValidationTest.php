<?php

namespace AppKit\Formulate\Tests;

use AppKit\Formulate\Facades\Formulate;

class InputValidationTest extends TestCase
{
    /** @test */
    public function inputsThatAreRequiredHaveARequiredAttribute()
    {
        $view = $this->blade('<x-input name="my-input" required></x-input>');

        $view->assertHasElement('input')->withAttribute('required');
    }

    /** @test */
    public function inputsThatAreNotRequiredDoNotHaveTheRequiredAttribute()
    {
        $view = $this->blade('<x-input name="my-input"></x-input>');

        $view->assertHasElement('input')->withoutAttribute('required');
    }

    /** @test */
    public function inputsThatAreRequiredHaveAnAsteriskInTheLabel()
    {
        $view = $this->blade('<x-input name="my-input" required></x-input>');

        $view->assertHasElement('label')->assertElementExists('span')->withContentContaining('*');
    }

    /** @test */
    public function inputsThatAreNotRequiredDoNotHaveAnAsteriskInTheLabel()
    {
        $view = $this->blade('<x-input name="my-input"></x-input>');

        $view->assertHasElement('label')->assertElementDoesntExists('span');
    }

    /** @test */
    public function inputsThatAreRequiredDoNotHaveTheOptionalLabel()
    {
        Formulate::highlightOptionalFields();

        $view = $this->blade('<x-input name="my-input" required></x-input>');

        $view->assertHasElement('label')->assertElementDoesntExists('span');
    }

    /** @test */
    public function inputsThatAreRequiredDoHaveTheOptionalLabel()
    {
        Formulate::highlightOptionalFields();

        $view = $this->blade('<x-input name="my-input"></x-input>');

        $view->assertHasElement('label')->assertElementExists('span')->withContentContaining('Optional');
    }
}
