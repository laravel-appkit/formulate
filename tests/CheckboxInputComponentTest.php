<?php

namespace AppKit\Formulate\Tests;

class CheckboxInputComponentTest extends TestCase
{
    /** @test */
    public function checkboxInputComponentExists()
    {
        $view = $this->blade('<x-input type="checkbox" name="my-input"></x-input>');

        $view->assertHasElement('input')->withAttributeValue('type', 'checkbox')->withAttributeValue('name', 'my-input');
    }

    public function checkboxInputComponentsMustHaveAName()
    {
        $this->expectException(Illuminate\View\ViewException::class);

        $this->blade('<x-input type="checkbox"></x-input>');
    }

    /** @test */
    public function checkboxInputComponentCanHaveAttributes()
    {
        $view = $this->blade('<x-input type="checkbox" name="my-input" class="my-class"></x-input>');

        $view->assertHasElement('input')->withAttributeValue('class', 'my-class');
    }

    /** @test */
    public function checkboxInputComponentsHaveAType()
    {
        $view = $this->blade('<x-input type="checkbox" name="my-input"></x-input>');

        $view->assertHasElement('input')->withAttributeValue('type', 'checkbox');
    }

    /** @test */
    public function checkboxInputComponentsGenerateADefaultId()
    {
        $view = $this->blade('<x-input type="checkbox" name="my-input"></x-input>');

        $view->assertHasElement('input')->withAttributeValue('id', 'my-input');
    }

    /** @test */
    public function checkboxInputComponentsCanHaveADefinedId()
    {
        $view = $this->blade('<x-input type="checkbox" name="my-input" id="my-id"></x-input>');

        $view->assertHasElement('input')->withAttributeValue('id', 'my-id');
    }

    /** @test */
    public function checkboxInputComponentsCanHaveGroupAttributes()
    {
        $view = $this->blade('<x-input type="checkbox" name="my-input" group:class="my-group"></x-input>');

        $view->assertHasElement('div')->withAttributeValue('class', 'my-group');
    }

    /** @test */
    public function checkboxInputComponentsCanHaveLabelAttributes()
    {
        $view = $this->blade('<x-input type="checkbox" name="my-input" label:class="my-label"></x-input>');

        $view->assertHasElement('label')->withAttributeValue('class', 'my-label');
    }

    /** @test */
    public function checkboxInputComponentsGenerateLabelValues()
    {
        $view = $this->blade('<x-input type="checkbox" name="my-input"></x-input>');

        $view->assertHasElement('label')->withContent('My input');
    }

    /** @test */
    public function checkboxInputComponentsCanHaveSetLabels()
    {
        $view = $this->blade('<x-input type="checkbox" name="my-input" label="My label"></x-input>');

        $view->assertHasElement('label')->withContent('My label');
    }

    /** @test */
    public function checkboxInputComponentsWithArrayNamesGenerateSuitableIds()
    {
        $view = $this->blade('<x-input type="checkbox" name="my-input[]" label="My label"></x-input><x-input type="checkbox" name="my-input[]" label="My label"></x-input>');

        $view->assertHasElement('input[id="my-input-1"]')->withAttributeValue('id', 'my-input-1');
        $view->assertHasElement('input[id="my-input-2"]')->withAttributeValue('id', 'my-input-2');
    }
}
