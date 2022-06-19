<?php

namespace AppKit\Formulate\Tests;

use AppKit\Formulate\Tests\Concerns\Mocks;
use AppKit\Formulate\Tests\Models\Article;

class CheckboxArrayInputComponentValueTest extends TestCase
{
    use Mocks;

    /** @test */
    public function checkboxArrayInputsHaveAValue()
    {
        // set the data that is passed to the form
        $data = [];

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-input type="checkbox" name="my-input[]" value="checkbox-value" />
        </x-form>', compact('data'));

        // test the component
        $view->assertHasElement('input[type=checkbox]')->withAttributeValue('value', 'checkbox-value');
    }

    /** @test */
    public function checkboxArrayInputsCanHaveADefaultCheckedAttributeOverridden()
    {
        // set the data that is passed to the form
        $data = ['my-input' => []];

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-input type="checkbox" name="my-input[]" value="checkbox-value" checked />
        </x-form>', compact('data'));

        // test the component
        $view->assertHasElement('input[type="checkbox"]')->withAttributeValue('value', 'checkbox-value')->withoutAttribute('checked');
    }

    /** @test */
    public function checkboxArrayInputsWillBeSelectedIfTheValueIsInTheFormsData()
    {
        // set the data that is passed to the form
        $data = ['my-input' => ['checkbox-value']];

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-input type="checkbox" name="my-input[]" value="checkbox-value" />
        </x-form>', compact('data'));

        // test the component
        $view->assertHasElement('input[type="checkbox"]')->withAttributeValue('value', 'checkbox-value')->withAttribute('checked');
    }

    /** @test */
    public function checkboxArrayInputsWillBeSelectedIfTheValueWasPosted()
    {
        // set the data that is passed to the form
        $data = [];
        $this->mockPostedValues(['my-input' => ['checkbox-value']]);

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-input type="checkbox" name="my-input[]" value="checkbox-value" />
        </x-form>', compact('data'));

        // test the component
        $view->assertHasElement('input[type="checkbox"]')->withAttributeValue('value', 'checkbox-value')->withAttribute('checked');
    }

    /** @test */
    public function checkboxArrayInputComponentsCanBeCheckedByACollectionOfModels()
    {
        // set the data that is passed to the form
        $data = ['articles' => factory(Article::class, 2)->create()];

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-input type="checkbox" name="articles[]" value="1" />
            <x-input type="checkbox" name="articles[]" value="2" />
            <x-input type="checkbox" name="articles[]" value="3" />
        </x-form>', compact('data'));

        // test the component
        $view->assertHasElement('input[value="1"]')->withAttributeValue('name', 'articles[]')->withAttribute('checked');
        $view->assertHasElement('input[value="2"]')->withAttributeValue('name', 'articles[]')->withAttribute('checked');
        $view->assertHasElement('input[value="3"]')->withAttributeValue('name', 'articles[]')->withoutAttribute('checked');
    }
}
