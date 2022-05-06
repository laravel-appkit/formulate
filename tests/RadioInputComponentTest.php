<?php

namespace AppKit\Formulate\Tests;

class RadioInputComponentTest extends TestCase
{
    /** @test */
    public function radioInputComponentExists()
    {
        $view = $this->blade('<x-input type="radio" name="my-input"></x-input>');

        $view->assertHasElement('input')->withAttributeValue('type', 'radio')->withAttributeValue('name', 'my-input');
    }

    public function radioInputComponentsMustHaveAName()
    {
        $this->expectException(Illuminate\View\ViewException::class);

        $this->blade('<x-input type="radio"></x-input>');
    }

    /** @test */
    public function radioInputComponentCanHaveAttributes()
    {
        $view = $this->blade('<x-input type="radio" name="my-input" class="my-class"></x-input>');

        $view->assertHasElement('input')->withAttributeValue('class', 'my-class');
    }

    /** @test */
    public function radioInputComponentsHaveAType()
    {
        $view = $this->blade('<x-input type="radio" name="my-input"></x-input>');

        $view->assertHasElement('input')->withAttributeValue('type', 'radio');
    }

    /** @test */
    public function radioInputComponentsGenerateADefaultId()
    {
        $view = $this->blade('<x-input type="radio" name="my-input"></x-input>');

        $view->assertHasElement('input')->withAttributeValue('id', 'my-input');
    }

    /** @test */
    public function radioInputComponentsCanHaveADefinedId()
    {
        $view = $this->blade('<x-input type="radio" name="my-input" id="my-id"></x-input>');

        $view->assertHasElement('input')->withAttributeValue('id', 'my-id');
    }

    /** @test */
    public function radioInputComponentsCanHaveGroupAttributes()
    {
        $view = $this->blade('<x-input type="radio" name="my-input" group:class="my-group"></x-input>');

        $view->assertHasElement('div')->withAttributeValue('class', 'my-group');
    }

    /** @test */
    public function radioInputComponentsCanHaveLabelAttributes()
    {
        $view = $this->blade('<x-input type="radio" name="my-input" label:class="my-label"></x-input>');

        $view->assertHasElement('label')->withAttributeValue('class', 'my-label');
    }

    /** @test */
    public function radioInputComponentsGenerateLabelValues()
    {
        $view = $this->blade('<x-input type="radio" name="my-input"></x-input>');

        $view->assertHasElement('label')->withContent('My input');
    }

    /** @test */
    public function radioInputComponentsCanHaveSetLabels()
    {
        $view = $this->blade('<x-input type="radio" name="my-input" label="My label"></x-input>');

        $view->assertHasElement('label')->withContent('My label');
    }
}
