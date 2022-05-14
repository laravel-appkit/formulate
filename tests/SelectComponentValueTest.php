<?php

namespace AppKit\Formulate\Tests;

use AppKit\Formulate\Facades\Formulate;
use AppKit\Formulate\Tests\Concerns\Mocks;
use AppKit\Formulate\Tests\Models\Article;

class SelectComponentValueTest extends TestCase
{
    use Mocks;

    public $options = [
        'a' => 'Option A',
        'b' => 'Option B',
        'c' => 'Option C',
        'd' => 'Option D',
        'e' => 'Option E',
    ];

    /** @test */
    public function selectComponentsCanHaveADefaultValue()
    {
        // set the data that is passed to the form
        $data = [];
        $options = $this->options;

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-select name="my-input" :options="$options" value="a" />
        </x-form>', compact('data', 'options'));

        // test the component
        $view->assertHasElement('option[value="a"]')->withAttribute('selected')->withContent('Option A');
    }

    /** @test */
    public function selectComponentsCanHaveAValueInTheDataAttribute()
    {
        // set the data that is passed to the form
        $data = ['my-input' => 'b'];
        $options = $this->options;

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-select name="my-input" :options="$options" value="a" />
        </x-form>', compact('data', 'options'));

        // test the component
        $view->assertHasElement('option[value="b"]')->withAttribute('selected')->withContent('Option B');
    }

    /** @test */
    public function selectComponentsCanGetDataValueFromModel()
    {
        // set the data that is passed to the form
        $data = factory(Article::class)->make(['category' => 'b']);
        $options = $this->options;

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-select name="category" :options="$options" value="a" />
        </x-form>', compact('data', 'options'));

        // test the component
        $view->assertHasElement('option[value="b"]')->withAttribute('selected')->withContent('Option B');
    }

    /** @test */
    public function selectComponentsUseDefaultValueIfTheAttributeIsNotOnAModel()
    {
        // set the data that is passed to the form
        $data = factory(Article::class)->make(['category' => 'b']);
        $options = $this->options;

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-select name="author" :options="$options" value="a" />
        </x-form>', compact('data', 'options'));

        // test the component
        $view->assertHasElement('option[value="a"]')->withAttribute('selected')->withContent('Option A');
    }

    /** @test */
    public function selectComponentsCanHaveAnOldValue()
    {
        // set the values that have previously been posted to the form
        $this->mockPostedValues(['my-input' => 'c']);

        // set the data that is passed to the form
        $data = [];
        $options = $this->options;

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-select name="my-input" :options="$options" value="a" />
        </x-form>', compact('data', 'options'));

        // test the component
        $view->assertHasElement('option[value="c"]')->withAttribute('selected')->withContent('Option C');
    }

    /** @test */
    public function multipleSelectComponentsCanHaveOldValues()
    {
        // set the values that have previously been posted to the form
        $this->mockPostedValues(['my-input' => 'd', 'my-input2' => 'e']);

        // set the data that is passed to the form
        $data = [];
        $options = $this->options;

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-select name="my-input" :options="$options" value="a" />
            <x-select name="my-input2" :options="$options" value="a" />
        </x-form>', compact('data', 'options'));

        // test the component
        $view->assertHasElement('select[name="my-input"] option[value="d"]')->withAttribute('selected')->withContent('Option D');
        $view->assertHasElement('select[name="my-input2"] option[value="e"]')->withAttribute('selected')->withContent('Option E');
    }

    /** @test */
    public function textareasCanGetDataFromVariousSources()
    {
        // set the values that have previously been posted to the form
        $this->mockPostedValues(['my-input' => 'e']);

        // set the data that is passed to the form
        $data = ['my-input' => 'd', 'my-input2' => 'd'];
        $options = $this->options;

        // render the blade component
        $view = $this->blade('<x-form :data="$data">
            <x-select name="my-input" :options="$options" value="a" />
            <x-select name="my-input2" :options="$options" value="a" />
            <x-select name="my-input3" :options="$options" value="a" />
        </x-form>', compact('data', 'options'));

        // test the component
        $view->assertHasElement('select[name="my-input"] option[value="e"]')->withAttribute('selected')->withContent('Option E');
        $view->assertHasElement('select[name="my-input2"] option[value="d"]')->withAttribute('selected')->withContent('Option D');
        $view->assertHasElement('select[name="my-input3"] option[value="a"]')->withAttribute('selected')->withContent('Option A');
    }
}
