<?php

namespace AppKit\Formulate\Tests;

use Illuminate\View\ViewException;

class RadioInputComponentTest extends TestCase
{
    /** @test */
    public function radioInputComponentExists()
    {
        $view = $this->blade('<x-formulate::input type="radio" name="my-input"></x-formulate::input>');

        $view->assertHasElement('input')->withAttributeValue('type', 'radio')->withAttributeValue('name', 'my-input');
    }

    /**
     * @test
     */
    public function radioInputComponentsMustHaveAName()
    {
        $this->expectException(ViewException::class);

        $this->blade('<x-formulate::input type="radio"></x-formulate::input>');
    }

    /** @test */
    public function radioInputComponentCanHaveAttributes()
    {
        $view = $this->blade('<x-formulate::input type="radio" name="my-input" class="my-class"></x-formulate::input>');

        $view->assertHasElement('input')->withAttributeValueContaining('class', 'my-class');
    }

    /** @test */
    public function radioInputComponentsHaveAType()
    {
        $view = $this->blade('<x-formulate::input type="radio" name="my-input"></x-formulate::input>');

        $view->assertHasElement('input')->withAttributeValue('type', 'radio');
    }

    /** @test */
    public function radioInputComponentsGenerateADefaultId()
    {
        $view = $this->blade('<x-formulate::input type="radio" name="my-input"></x-formulate::input>');

        $view->assertHasElement('input')->withAttributeValue('id', 'my-input');
    }

    /** @test */
    public function radioInputComponentsCanHaveADefinedId()
    {
        $view = $this->blade('<x-formulate::input type="radio" name="my-input" id="my-id"></x-formulate::input>');

        $view->assertHasElement('input')->withAttributeValue('id', 'my-id');
    }

    /** @test */
    public function radioInputComponentsCanHaveGroupAttributes()
    {
        $view = $this->blade('<x-formulate::input type="radio" name="my-input" group:class="my-group"></x-formulate::input>');

        $view->assertHasElement('div')->withAttributeValueContaining('class', 'my-group');
    }

    /** @test */
    public function radioInputComponentsCanHaveLabelAttributes()
    {
        $view = $this->blade('<x-formulate::input type="radio" name="my-input" label:class="my-label"></x-formulate::input>');

        $view->assertHasElement('label')->withAttributeValueContaining('class', 'my-label');
    }

    /** @test */
    public function radioInputComponentsGenerateLabelValues()
    {
        $view = $this->blade('<x-formulate::input type="radio" name="my-input"></x-formulate::input>');

        $view->assertHasElement('label')->withContent('My input');
    }

    /** @test */
    public function radioInputComponentsCanHaveSetLabels()
    {
        $view = $this->blade('<x-formulate::input type="radio" name="my-input" label="My label"></x-formulate::input>');

        $view->assertHasElement('label')->withContent('My label');
    }
}
