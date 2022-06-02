<?php

namespace AppKit\Formulate\Tests;

use AppKit\Formulate\Tests\Concerns\Mocks;
use AppKit\Formulate\Tests\Models\Article;

class TextareaComponentValueTest extends TestCase
{
    use Mocks;

    /** @test */
    public function textareaComponentsCanHaveADefaultValue()
    {
        // set the data that is passed to the form
        $data = [];

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-textarea name="my-input" value="Default Value" />
        </x-form>', compact('data'));

        // test the component
        $view->assertHasElement('textarea[name="my-input"]')->withContent('Default Value');
    }

    /** @test */
    public function textareaComponentsCanHaveAValueInTheDataAttribute()
    {
        // set the data that is passed to the form
        $data = ['my-input' => 'Data Value'];

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-textarea name="my-input" value="Default Value" />
        </x-form>', compact('data'));

        // test the component
        $view->assertHasElement('textarea[name="my-input"]')->withContent('Data Value');
    }

    /** @test */
    public function textareaComponentsCanGetDataValueFromModel()
    {
        // set the data that is passed to the form
        $data = factory(Article::class)->make(['title' => 'My Title']);

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-textarea name="title" value="Default Value" />
        </x-form>', compact('data'));

        // test the component
        $view->assertHasElement('textarea[name="title"]')->withContent('My Title');
    }

    /** @test */
    public function textareaComponentsUseDefaultValueIfTheAttributeIsNotOnAModel()
    {
        // set the data that is passed to the form
        $data = factory(Article::class)->make(['title' => 'My Title']);

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-textarea name="author" value="Default Value" />
        </x-form>', compact('data'));

        // test the component
        $view->assertHasElement('textarea[name="author"]')->withContent('Default Value');
    }

    /** @test */
    public function textareaComponentsCanHaveAnOldValue()
    {
        // set the values that have previously been posted to the form
        $this->mockPostedValues(['my-input' => 'Old Value']);

        // set the data that is passed to the form
        $data = ['my-input' => 'Data Value'];

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-textarea name="my-input" value="Default Value" />
        </x-form>', compact('data'));

        // test the component
        $view->assertHasElement('textarea[name="my-input"]')->withContent('Old Value');
    }

    /** @test */
    public function multipleTextareaComponentsCanHaveOldValues()
    {
        // set the values that have previously been posted to the form
        $this->mockPostedValues(['my-input' => 'Old Value', 'my-input2' => 'Old Value 2']);

        // set the data that is passed to the form
        $data = ['my-input' => 'Data Value'];

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-textarea name="my-input" value="Default Value" />
            <x-textarea name="my-input2" value="Default Value" />
        </x-form>', compact('data'));

        // test the component
        $view->assertHasElement('textarea[name="my-input"]')->withContent('Old Value');
        $view->assertHasElement('textarea[name="my-input2"]')->withContent('Old Value 2');
    }

    /** @test */
    public function textareasCanGetDataFromVariousSources()
    {
        // set the values that have previously been posted to the form
        $this->mockPostedValues(['my-input' => 'Old Value']);

        // set the data that is passed to the form
        $data = ['my-input' => 'Data Value', 'my-input2' => 'Data Value 2'];

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-textarea name="my-input" value="Default Value" />
            <x-textarea name="my-input2" value="Default Value 2" />
            <x-textarea name="my-input3" value="Default Value 3" />
        </x-form>', compact('data'));

        // test the component
        $view->assertHasElement('textarea[name="my-input"]')->withContent('Old Value');
        $view->assertHasElement('textarea[name="my-input2"]')->withContent('Data Value 2');
        $view->assertHasElement('textarea[name="my-input3"]')->withContent('Default Value 3');
    }
}
