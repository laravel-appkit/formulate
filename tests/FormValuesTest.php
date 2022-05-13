<?php

namespace AppKit\Formulate\Tests;

use AppKit\Formulate\Facades\Formulate;
use AppKit\Formulate\Tests\Concerns\Mocks;
use AppKit\Formulate\Tests\Models\Article;

class FromValuesTest extends TestCase
{
    use Mocks;

    /** @test */
    public function formsCanHaveDataPassedToThemAsAnArray()
    {
        // set the data that is passed to the form
        $data = ['my-input' => 'My Value'];

        // render the blade component
        $view = $this->blade('<x-form :data="$data"></x-form>', compact('data'));

        // test the component
        $this->assertNotEmpty(Formulate::getFormData());
        $this->assertArrayHasKey('my-input', Formulate::getFormData());
        $this->assertEquals('My Value', Formulate::getFormData()['my-input']);
    }

    /** @test */
    public function inputComponentsCanHaveADefaultValue()
    {
        // set the data that is passed to the form
        $data = [];

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-input name="my-input" value="Default Value" />
        </x-form>', compact('data'));

        // test the component
        $view->assertHasElement('input[name="my-input"]')->withAttributeValue('value', 'Default Value');
    }

    /** @test */
    public function inputComponentsCanHaveAValueInTheDataAttribute()
    {
        // set the data that is passed to the form
        $data = ['my-input' => 'Data Value'];

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-input name="my-input" value="Default Value" />
        </x-form>', compact('data'));

        // test the component
        $view->assertHasElement('input[name="my-input"]')->withAttributeValue('value', 'Data Value');
    }

    /** @test */
    public function inputComponentsCanGetDataValueFromModel()
    {
        // set the data that is passed to the form
        $data = factory(Article::class)->make(['title' => 'My Title']);

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-input name="title" value="Default Value" />
        </x-form>', compact('data'));

        // test the component
        $view->assertHasElement('input[name="title"]')->withAttributeValue('value', 'My Title');
    }

    /** @test */
    public function inputComponentsUseDefaultValueIfTheAttributeIsNotOnAModel()
    {
        // set the data that is passed to the form
        $data = factory(Article::class)->make(['title' => 'My Title']);

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-input name="author" value="Default Value" />
        </x-form>', compact('data'));

        // test the component
        $view->assertHasElement('input[name="author"]')->withAttributeValue('value', 'Default Value');
    }

    /** @test */
    public function inputComponentsCanHaveAnOldValue()
    {
        // set the values that have previously been posted to the form
        $this->mockPostedValues(['my-input' => 'Old Value']);

        // set the data that is passed to the form
        $data = ['my-input' => 'Data Value'];

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-input name="my-input" value="Default Value" />
        </x-form>', compact('data'));

        // test the component
        $view->assertHasElement('input[name="my-input"]')->withAttributeValue('value', 'Old Value');
    }

    /** @test */
    public function multipleInputComponentsCanHaveOldValues()
    {
        // set the values that have previously been posted to the form
        $this->mockPostedValues(['my-input' => 'Old Value', 'my-input2' => 'Old Value 2']);

        // set the data that is passed to the form
        $data = ['my-input' => 'Data Value'];

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-input name="my-input" value="Default Value" />
            <x-input name="my-input2" value="Default Value" />
        </x-form>', compact('data'));

        // test the component
        $view->assertHasElement('input[name="my-input"]')->withAttributeValue('value', 'Old Value');
        $view->assertHasElement('input[name="my-input2"]')->withAttributeValue('value', 'Old Value 2');
    }

    /** @test */
    public function inputsCanGetDataFromVariousSources()
    {
        // set the values that have previously been posted to the form
        $this->mockPostedValues(['my-input' => 'Old Value']);

        // set the data that is passed to the form
        $data = ['my-input' => 'Data Value', 'my-input2' => 'Data Value 2'];

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-input name="my-input" value="Default Value" />
            <x-input name="my-input2" value="Default Value 2" />
            <x-input name="my-input3" value="Default Value 3" />
        </x-form>', compact('data'));

        // test the component
        $view->assertHasElement('input[name="my-input"]')->withAttributeValue('value', 'Old Value');
        $view->assertHasElement('input[name="my-input2"]')->withAttributeValue('value', 'Data Value 2');
        $view->assertHasElement('input[name="my-input3"]')->withAttributeValue('value', 'Default Value 3');
    }
}
