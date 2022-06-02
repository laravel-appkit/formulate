<?php

namespace AppKit\Formulate\Tests;

use AppKit\Formulate\Facades\Formulate;
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

    // /** @test */
    // public function checkboxInputComponentsWillBeCheckedViaTrueModelAttribute()
    // {
    //     // set the data that is passed to the form
    //     $data = factory(Article::class)->make(['published' => true]);

    //     // render the blade component
    //     $view = $this->blade('<x-form :data="$data">
    //         <x-input type="checkbox" name="published" value="true" />
    //     </x-form>', compact('data'));

    //     // test the component
    //     $view->assertHasElement('input[type="checkbox"]')->withAttributeValue('name', 'published')->withAttributeValue('value', 'true')->withAttribute('checked');
    // }

    // /** @test */
    // public function checkboxInputComponentsWontBeCheckedViaNonMatchingModelAttribute()
    // {
    //     // set the data that is passed to the form
    //     $data = factory(Article::class)->make(['featured' => false]);

    //     // render the blade component
    //     $view = $this->blade('<x-form :data="$data">
    //         <x-input type="checkbox" name="featured" value="true" />
    //     </x-form>', compact('data'));

    //     // test the component
    //     $view->assertHasElement('input[type="checkbox"]')->withAttributeValue('name', 'featured')->withAttributeValue('value', 'true')->withoutAttribute('checked');
    // }

    // /** @test */
    // public function checkboxInputComponentsWillBeCheckedViaMatchingModelAttribute()
    // {
    //     // set the data that is passed to the form
    //     $data = factory(Article::class)->make(['featured' => true]);

    //     // render the blade component
    //     $view = $this->blade('<x-form :data="$data">
    //         <x-input type="checkbox" name="featured" value="true" />
    //     </x-form>', compact('data'));

    //     // test the component
    //     $view->assertHasElement('input[type="checkbox"]')->withAttributeValue('name', 'featured')->withAttributeValue('value', 'true')->withAttribute('checked');
    // }

    // /** @test */
    // public function checkboxInputComponentsUseDefaultValueIfTheAttributeIsNotOnAModel()
    // {
    //     // set the data that is passed to the form
    //     $data = factory(Article::class)->make(['category' => 'b']);

    //     // render the blade component
    //     $view = $this->blade('<x-form :data="$data">
    //         <x-input type="checkbox" name="featured" value="true" />
    //     </x-form>', compact('data'));

    //     // test the component
    //     $view->assertHasElement('input[type="checkbox"]')->withAttributeValue('name', 'featured')->withAttributeValue('value', 'true')->withoutAttribute('checked');
    // }

    // /** @test */
    // public function multipleCheckboxInputComponentsCanHaveOldValues()
    // {
    //     // set the data that is passed to the form
    //     $data = [];
    //     $this->mockPostedValues(['my-input' => true, 'my-input-2' => false]);

    //     // render the blade component
    //     $view = $this->blade('<x-form :data="$data">
    //         <x-input type="checkbox" name="my-input" value="checkbox-value" />
    //         <x-input type="checkbox" name="my-input-2" value="checkbox-value" />
    //     </x-form>', compact('data'));

    //     // test the component
    //     $view->assertHasElement('input[name="my-input"]')->withAttributeValue('value', 'checkbox-value')->withAttribute('checked');
    //     $view->assertHasElement('input[name="my-input-2"]')->withAttributeValue('value', 'checkbox-value')->withoutAttribute('checked');
    // }

    // /** @test */
    // public function checkboxInputComponentsCanGetDataFromVariousSources()
    // {
    //     // set the data that is passed to the form
    //     $this->mockPostedValues(['my-input' => false, 'my-input-2' => true]);
    //     $data = ['my-input' => true];

    //     // render the blade component
    //     $view = $this->blade('<x-form :data="$data">
    //         <x-input type="checkbox" name="my-input" value="checkbox-value" />
    //         <x-input type="checkbox" name="my-input-2" value="checkbox-value" />
    //         <x-input type="checkbox" name="my-input-3" value="checkbox-value" />
    //         <x-input type="checkbox" name="my-input-4" value="checkbox-value" checked />
    //     </x-form>', compact('data'));

    //     // test the component
    //     $view->assertHasElement('input[name="my-input"]')->withAttributeValue('value', 'checkbox-value')->withoutAttribute('checked');
    //     $view->assertHasElement('input[name="my-input-2"]')->withAttributeValue('value', 'checkbox-value')->withAttribute('checked');
    //     $view->assertHasElement('input[name="my-input-3"]')->withAttributeValue('value', 'checkbox-value')->withoutAttribute('checked');
    //     $view->assertHasElement('input[name="my-input-4"]')->withAttributeValue('value', 'checkbox-value')->withAttribute('checked');
    // }
}
