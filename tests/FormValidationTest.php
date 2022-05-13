<?php

namespace AppKit\Formulate\Tests;

use AppKit\Formulate\Tests\Concerns\Mocks;

class FormValidationTest extends TestCase
{
    use Mocks;

    /** @test */
    public function ifOneFieldHasAnErrorAMessageWillBeShownAtTheTopOfTheForm()
    {
        // add invalid fields
        $this->withInvalidFields(['my-input']);

        // render the blade component
        $view = $this->blade('<x-form>
            <x-input name="my-input" />
        </x-form>');

        // test the component
        $this->assertStringContainsString('Whoops! Something went wrong.', $view);
    }

    /** @test */
    public function ifNoFieldHaveErrorsNoMessageWillBeShownAtTheTopOfTheForm()
    {
        // render the blade component
        $view = $this->blade('<x-form>
            <x-input name="my-input" />
        </x-form>');

        // test the component
        $this->assertStringNotContainsString('Whoops! Something went wrong.', $view);
    }

    /** @test */
    public function inputComponentsHasValidationErrors()
    {
        // add invalid fields
        $this->withInvalidFields(['my-input']);

        // render the blade component
        $view = $this->blade('<x-form>
            <x-input name="my-input" />
        </x-form>');

        // test the component
        $view->assertHasElement('div > div')->withContent('my-input Validation Error');
    }
}
