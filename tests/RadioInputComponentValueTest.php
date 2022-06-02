<?php

namespace AppKit\Formulate\Tests;

use AppKit\Formulate\Tests\Concerns\Mocks;
use AppKit\Formulate\Tests\Models\Article;

class RadioInputComponentValueTest extends TestCase
{
    use Mocks;

    /** @test */
    public function radioInputsHaveAValue()
    {
        // set the data that is passed to the form
        $data = [];

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-input type="radio" name="my-input" value="radio-value" />
        </x-form>', compact('data'));

        // test the component
        $view->assertHasElement('input[type=radio]')->withAttributeValue('value', 'radio-value');
    }

    /** @test */
    public function radioInputsCanHaveADefaultCheckedAttributeOverridden()
    {
        // set the data that is passed to the form
        $data = ['my-input' => false];

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-input type="radio" name="my-input" value="radio-value" checked />
        </x-form>', compact('data'));

        // test the component
        $view->assertHasElement('input[type="radio"]')->withAttributeValue('value', 'radio-value')->withoutAttribute('checked');
    }

    /** @test */
    public function radioInputsWillBeSelectedIfTheValueIsInTheFormsData()
    {
        // set the data that is passed to the form
        $data = ['my-input' => 'radio-value'];

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-input type="radio" name="my-input" value="radio-value" />
        </x-form>', compact('data'));

        // test the component
        $view->assertHasElement('input[type="radio"]')->withAttributeValue('value', 'radio-value')->withAttribute('checked');
    }

    /** @test */
    public function radioInputsWillBeSelectedIfTheValueIsTrueInTheFormsData()
    {
        // set the data that is passed to the form
        $data = ['my-input' => true];

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-input type="radio" name="my-input" value="radio-value" />
        </x-form>', compact('data'));

        // test the component
        $view->assertHasElement('input[type="radio"]')->withAttributeValue('value', 'radio-value')->withAttribute('checked');
    }

    /** @test */
    public function radioInputsWontBeSelectedIfTheValueIsFalseInTheFormsData()
    {
        // set the data that is passed to the form
        $data = ['my-input' => false];

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-input type="radio" name="my-input" value="radio-value" />
        </x-form>', compact('data'));

        // test the component
        $view->assertHasElement('input[type="radio"]')->withAttributeValue('value', 'radio-value')->withoutAttribute('checked');
    }

    /** @test */
    public function radioInputsWillBeSelectedIfTheValueWasPosted()
    {
        // set the data that is passed to the form
        $data = [];
        $this->mockPostedValues(['my-input' => 'radio-value']);

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-input type="radio" name="my-input" value="radio-value" />
        </x-form>', compact('data'));

        // test the component
        $view->assertHasElement('input[type="radio"]')->withAttributeValue('value', 'radio-value')->withAttribute('checked');
    }

    /** @test */
    public function radioInputsWillBeSelectedIfTheValueIsTrueWasPosted()
    {
        // set the data that is passed to the form
        $data = [];
        $this->mockPostedValues(['my-input' => true]);

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-input type="radio" name="my-input" value="radio-value" />
        </x-form>', compact('data'));

        // test the component
        $view->assertHasElement('input[type="radio"]')->withAttributeValue('value', 'radio-value')->withAttribute('checked');
    }

    /** @test */
    public function radioInputsWontBeSelectedIfTheValueIsFalseWasPosted()
    {
        // set the data that is passed to the form
        $data = [];
        $this->mockPostedValues(['my-input' => false]);

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-input type="radio" name="my-input" value="radio-value" />
        </x-form>', compact('data'));

        // test the component
        $view->assertHasElement('input[type="radio"]')->withAttributeValue('value', 'radio-value')->withoutAttribute('checked');
    }

    /** @test */
    public function radioInputComponentssWontBeCheckedViaFalseModelAttribute()
    {
        // set the data that is passed to the form
        $data = factory(Article::class)->make(['published' => false]);

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-input type="radio" name="published" value="true" />
        </x-form>', compact('data'));

        // test the component
        $view->assertHasElement('input[type="radio"]')->withAttributeValue('name', 'published')->withAttributeValue('value', 'true')->withoutAttribute('checked');
    }

    /** @test */
    public function radioInputComponentsWillBeCheckedViaTrueModelAttribute()
    {
        // set the data that is passed to the form
        $data = factory(Article::class)->make(['published' => true]);

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-input type="radio" name="published" value="true" />
        </x-form>', compact('data'));

        // test the component
        $view->assertHasElement('input[type="radio"]')->withAttributeValue('name', 'published')->withAttributeValue('value', 'true')->withAttribute('checked');
    }

    /** @test */
    public function radioInputComponentsWontBeCheckedViaNonMatchingModelAttribute()
    {
        // set the data that is passed to the form
        $data = factory(Article::class)->make(['featured' => false]);

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-input type="radio" name="featured" value="true" />
        </x-form>', compact('data'));

        // test the component
        $view->assertHasElement('input[type="radio"]')->withAttributeValue('name', 'featured')->withAttributeValue('value', 'true')->withoutAttribute('checked');
    }

    /** @test */
    public function radioInputComponentsWillBeCheckedViaMatchingModelAttribute()
    {
        // set the data that is passed to the form
        $data = factory(Article::class)->make(['featured' => true]);

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-input type="radio" name="featured" value="true" />
        </x-form>', compact('data'));

        // test the component
        $view->assertHasElement('input[type="radio"]')->withAttributeValue('name', 'featured')->withAttributeValue('value', 'true')->withAttribute('checked');
    }

    /** @test */
    public function radioInputComponentsUseDefaultValueIfTheAttributeIsNotOnAModel()
    {
        // set the data that is passed to the form
        $data = factory(Article::class)->make(['category' => 'b']);

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-input type="radio" name="featured" value="true" />
        </x-form>', compact('data'));

        // test the component
        $view->assertHasElement('input[type="radio"]')->withAttributeValue('name', 'featured')->withAttributeValue('value', 'true')->withoutAttribute('checked');
    }

    /** @test */
    public function multipleRadioInputComponentsCanHaveOldValues()
    {
        // set the data that is passed to the form
        $data = [];
        $this->mockPostedValues(['my-input' => true, 'my-input-2' => false]);

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-input type="radio" name="my-input" value="radio-value" />
            <x-input type="radio" name="my-input-2" value="radio-value" />
        </x-form>', compact('data'));

        // test the component
        $view->assertHasElement('input[name="my-input"]')->withAttributeValue('value', 'radio-value')->withAttribute('checked');
        $view->assertHasElement('input[name="my-input-2"]')->withAttributeValue('value', 'radio-value')->withoutAttribute('checked');
    }

    /** @test */
    public function radioInputComponentsCanGetDataFromVariousSources()
    {
        // set the data that is passed to the form
        $this->mockPostedValues(['my-input' => false, 'my-input-2' => true]);
        $data = ['my-input' => true];

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-input type="radio" name="my-input" value="radio-value" />
            <x-input type="radio" name="my-input-2" value="radio-value" />
            <x-input type="radio" name="my-input-3" value="radio-value" />
            <x-input type="radio" name="my-input-4" value="radio-value" checked />
        </x-form>', compact('data'));

        // test the component
        $view->assertHasElement('input[name="my-input"]')->withAttributeValue('value', 'radio-value')->withoutAttribute('checked');
        $view->assertHasElement('input[name="my-input-2"]')->withAttributeValue('value', 'radio-value')->withAttribute('checked');
        $view->assertHasElement('input[name="my-input-3"]')->withAttributeValue('value', 'radio-value')->withoutAttribute('checked');
        $view->assertHasElement('input[name="my-input-4"]')->withAttributeValue('value', 'radio-value')->withAttribute('checked');
    }
}
