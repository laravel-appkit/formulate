<?php

namespace AppKit\Formulate\Tests;

use AppKit\Formulate\Tests\Concerns\Mocks;
use AppKit\Formulate\Tests\Models\Article;

class CheckboxInputComponentValueTest extends TestCase
{
    use Mocks;

    /** @test */
    public function checkboxInputsHaveAValue()
    {
        // set the data that is passed to the form
        $data = [];

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-input type="checkbox" name="my-input" value="checkbox-value" />
        </x-form>', compact('data'));

        // test the component
        $view->assertHasElement('input[type=checkbox]')->withAttributeValue('value', 'checkbox-value');
    }

    /** @test */
    public function checkboxInputsCanHaveADefaultCheckedAttributeOverridden()
    {
        // set the data that is passed to the form
        $data = ['my-input' => false];

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-input type="checkbox" name="my-input" value="checkbox-value" checked />
        </x-form>', compact('data'));

        // test the component
        $view->assertHasElement('input[type="checkbox"]')->withAttributeValue('value', 'checkbox-value')->withoutAttribute('checked');
    }

    /** @test */
    public function checkboxInputsWillBeSelectedIfTheValueIsInTheFormsData()
    {
        // set the data that is passed to the form
        $data = ['my-input' => 'checkbox-value'];

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-input type="checkbox" name="my-input" value="checkbox-value" />
        </x-form>', compact('data'));

        // test the component
        $view->assertHasElement('input[type="checkbox"]')->withAttributeValue('value', 'checkbox-value')->withAttribute('checked');
    }

    /** @test */
    public function checkboxInputsWillBeSelectedIfTheValueIsTrueInTheFormsData()
    {
        // set the data that is passed to the form
        $data = ['my-input' => true];

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-input type="checkbox" name="my-input" value="checkbox-value" />
        </x-form>', compact('data'));

        // test the component
        $view->assertHasElement('input[type="checkbox"]')->withAttributeValue('value', 'checkbox-value')->withAttribute('checked');
    }

    /** @test */
    public function checkboxInputsWontBeSelectedIfTheValueIsFalseInTheFormsData()
    {
        // set the data that is passed to the form
        $data = ['my-input' => false];

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-input type="checkbox" name="my-input" value="checkbox-value" />
        </x-form>', compact('data'));

        // test the component
        $view->assertHasElement('input[type="checkbox"]')->withAttributeValue('value', 'checkbox-value')->withoutAttribute('checked');
    }

    /** @test */
    public function checkboxInputsWillBeSelectedIfTheValueWasPosted()
    {
        // set the data that is passed to the form
        $data = [];
        $this->mockPostedValues(['my-input' => 'checkbox-value']);

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-input type="checkbox" name="my-input" value="checkbox-value" />
        </x-form>', compact('data'));

        // test the component
        $view->assertHasElement('input[type="checkbox"]')->withAttributeValue('value', 'checkbox-value')->withAttribute('checked');
    }

    /** @test */
    public function checkboxInputsWillBeSelectedIfTheValueIsTrueWasPosted()
    {
        // set the data that is passed to the form
        $data = [];
        $this->mockPostedValues(['my-input' => true]);

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-input type="checkbox" name="my-input" value="checkbox-value" />
        </x-form>', compact('data'));

        // test the component
        $view->assertHasElement('input[type="checkbox"]')->withAttributeValue('value', 'checkbox-value')->withAttribute('checked');
    }

    /** @test */
    public function checkboxInputsWontBeSelectedIfTheValueIsFalseWasPosted()
    {
        // set the data that is passed to the form
        $data = [];
        $this->mockPostedValues(['my-input' => false]);

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-input type="checkbox" name="my-input" value="checkbox-value" />
        </x-form>', compact('data'));

        // test the component
        $view->assertHasElement('input[type="checkbox"]')->withAttributeValue('value', 'checkbox-value')->withoutAttribute('checked');
    }

    /** @test */
    public function checkboxInputComponentssWontBeCheckedViaFalseModelAttribute()
    {
        // set the data that is passed to the form
        $data = factory(Article::class)->make(['published' => false]);

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-input type="checkbox" name="published" value="true" />
        </x-form>', compact('data'));

        // test the component
        $view->assertHasElement('input[type="checkbox"]')->withAttributeValue('name', 'published')->withAttributeValue('value', 'true')->withoutAttribute('checked');
    }

    /** @test */
    public function checkboxInputComponentsWillBeCheckedViaTrueModelAttribute()
    {
        // set the data that is passed to the form
        $data = factory(Article::class)->make(['published' => true]);

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-input type="checkbox" name="published" value="true" />
        </x-form>', compact('data'));

        // test the component
        $view->assertHasElement('input[type="checkbox"]')->withAttributeValue('name', 'published')->withAttributeValue('value', 'true')->withAttribute('checked');
    }

    /** @test */
    public function checkboxInputComponentsWontBeCheckedViaNonMatchingModelAttribute()
    {
        // set the data that is passed to the form
        $data = factory(Article::class)->make(['featured' => false]);

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-input type="checkbox" name="featured" value="true" />
        </x-form>', compact('data'));

        // test the component
        $view->assertHasElement('input[type="checkbox"]')->withAttributeValue('name', 'featured')->withAttributeValue('value', 'true')->withoutAttribute('checked');
    }

    /** @test */
    public function checkboxInputComponentsWillBeCheckedViaMatchingModelAttribute()
    {
        // set the data that is passed to the form
        $data = factory(Article::class)->make(['featured' => true]);

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-input type="checkbox" name="featured" value="true" />
        </x-form>', compact('data'));

        // test the component
        $view->assertHasElement('input[type="checkbox"]')->withAttributeValue('name', 'featured')->withAttributeValue('value', 'true')->withAttribute('checked');
    }

    /** @test */
    public function checkboxInputComponentsUseDefaultValueIfTheAttributeIsNotOnAModel()
    {
        // set the data that is passed to the form
        $data = factory(Article::class)->make(['category' => 'b']);

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-input type="checkbox" name="featured" value="true" />
        </x-form>', compact('data'));

        // test the component
        $view->assertHasElement('input[type="checkbox"]')->withAttributeValue('name', 'featured')->withAttributeValue('value', 'true')->withoutAttribute('checked');
    }

    /** @test */
    public function multipleCheckboxInputComponentsCanHaveOldValues()
    {
        // set the data that is passed to the form
        $data = [];
        $this->mockPostedValues(['my-input' => true, 'my-input-2' => false]);

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-input type="checkbox" name="my-input" value="checkbox-value" />
            <x-input type="checkbox" name="my-input-2" value="checkbox-value" />
        </x-form>', compact('data'));

        // test the component
        $view->assertHasElement('input[name="my-input"]')->withAttributeValue('value', 'checkbox-value')->withAttribute('checked');
        $view->assertHasElement('input[name="my-input-2"]')->withAttributeValue('value', 'checkbox-value')->withoutAttribute('checked');
    }

    /** @test */
    public function checkboxInputComponentsCanGetDataFromVariousSources()
    {
        // set the data that is passed to the form
        $this->mockPostedValues(['my-input' => false, 'my-input-2' => true]);
        $data = ['my-input' => true];

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-input type="checkbox" name="my-input" value="checkbox-value" />
            <x-input type="checkbox" name="my-input-2" value="checkbox-value" />
            <x-input type="checkbox" name="my-input-3" value="checkbox-value" />
            <x-input type="checkbox" name="my-input-4" value="checkbox-value" checked />
        </x-form>', compact('data'));

        // test the component
        $view->assertHasElement('input[name="my-input"]')->withAttributeValue('value', 'checkbox-value')->withoutAttribute('checked');
        $view->assertHasElement('input[name="my-input-2"]')->withAttributeValue('value', 'checkbox-value')->withAttribute('checked');
        $view->assertHasElement('input[name="my-input-3"]')->withAttributeValue('value', 'checkbox-value')->withoutAttribute('checked');
        $view->assertHasElement('input[name="my-input-4"]')->withAttributeValue('value', 'checkbox-value')->withAttribute('checked');
    }
}
