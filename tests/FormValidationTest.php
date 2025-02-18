<?php

namespace AppKit\Formulate\Tests;

use AppKit\Formulate\Tests\Concerns\Mocks;
use Illuminate\Support\Facades\Config;

class FormValidationTest extends TestCase
{
    use Mocks;

    /** @test */
    public function ifOneFieldHasAnErrorAMessageWillBeShownAtTheTopOfTheForm()
    {
        // add invalid fields
        $this->withInvalidFields(['my-input']);

        // render the blade component
        $view = $this->blade('<x-formulate::form>
            <x-formulate::input name="my-input" />
        </x-formulate::form>');

        // test the component
        $this->assertStringContainsString('Whoops! Something went wrong.', $view);
    }

    /** @test */
    public function ifNoFieldsHaveErrorsNoMessageWillBeShownAtTheTopOfTheForm()
    {
        // render the blade component
        $view = $this->blade('<x-formulate::form>
            <x-formulate::input name="my-input" />
        </x-formulate::form>');

        // test the component
        $this->assertStringNotContainsString('Whoops! Something went wrong.', $view);
    }

    /** @test */
    public function testTheFormErrorMessageCanBeCustomised()
    {
        Config::set('formulate.form_error_message', 'Custom Error Message');

        // add invalid fields
        $this->withInvalidFields(['my-input']);

        // render the blade component
        $view = $this->blade('<x-formulate::form>
            <x-formulate::input name="my-input" />
        </x-formulate::form>');

        // test the component
        $this->assertStringContainsString('Custom Error Message', $view);
    }

    /** @test */
    public function inputComponentsHasValidationErrors()
    {
        // add invalid fields
        $this->withInvalidFields(['my-input']);

        // render the blade component
        $view = $this->blade('<x-formulate::form>
            <x-formulate::input name="my-input" />
        </x-formulate::form>');

        // test the component
        $view->assertHasElement('div > div > div > div > div')->withContent(config('formulate.form_error_message'));
    }
}
