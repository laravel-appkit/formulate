<?php

namespace AppKit\Formulate\Tests;

use Illuminate\View\ViewException;

class CheckboxInputComponentTest extends TestCase
{
    /** @test */
    public function checkboxInputComponentExists()
    {
        $view = $this->blade('<x-formulate::input type="checkbox" name="my-input"></x-formulate::input>');

        $view->assertHasElement('input')->withAttributeValue('type', 'checkbox')->withAttributeValue('name', 'my-input');
    }

    /**
     * @test
     */
    public function checkboxInputComponentsMustHaveAName()
    {
        $this->expectException(ViewException::class);

        $this->blade('<x-formulate::input type="checkbox"></x-formulate::input>');
    }

    /** @test */
    public function checkboxInputComponentCanHaveAttributes()
    {
        $view = $this->blade('<x-formulate::input type="checkbox" name="my-input" class="my-class"></x-formulate::input>');

        $view->assertHasElement('input')->withAttributeValueContaining('class', 'my-class');
    }

    /** @test */
    public function checkboxInputComponentsHaveAType()
    {
        $view = $this->blade('<x-formulate::input type="checkbox" name="my-input"></x-formulate::input>');

        $view->assertHasElement('input')->withAttributeValue('type', 'checkbox');
    }

    /** @test */
    public function checkboxInputComponentsGenerateADefaultId()
    {
        $view = $this->blade('<x-formulate::input type="checkbox" name="my-input"></x-formulate::input>');

        $view->assertHasElement('input')->withAttributeValue('id', 'my-input');
    }

    /** @test */
    public function checkboxInputComponentsCanHaveADefinedId()
    {
        $view = $this->blade('<x-formulate::input type="checkbox" name="my-input" id="my-id"></x-formulate::input>');

        $view->assertHasElement('input')->withAttributeValue('id', 'my-id');
    }

    /** @test */
    public function checkboxInputComponentsCanHaveGroupAttributes()
    {
        $view = $this->blade('<x-formulate::input type="checkbox" name="my-input" group:class="my-group"></x-formulate::input>');

        $view->assertHasElement('div')->withAttributeValueContaining('class', 'my-group');
    }

    /** @test */
    public function checkboxInputComponentsCanHaveLabelAttributes()
    {
        $view = $this->blade('<x-formulate::input type="checkbox" name="my-input" label:class="my-label"></x-formulate::input>');

        $view->assertHasElement('label')->withAttributeValueContaining('class', 'my-label');
    }

    /** @test */
    public function checkboxInputComponentsGenerateLabelValues()
    {
        $view = $this->blade('<x-formulate::input type="checkbox" name="my-input"></x-formulate::input>');

        $view->assertHasElement('label')->withContent('My input');
    }

    /** @test */
    public function checkboxInputComponentsCanHaveSetLabels()
    {
        $view = $this->blade('<x-formulate::input type="checkbox" name="my-input" label="My label"></x-formulate::input>');

        $view->assertHasElement('label')->withContent('My label');
    }

    /** @test */
    public function checkboxInputComponentsWithArrayNamesGenerateSuitableIds()
    {
        $view = $this->blade('<x-formulate::input type="checkbox" name="my-input[]" label="My label"></x-formulate::input><x-formulate::input type="checkbox" name="my-input[]" label="My label"></x-formulate::input>');

        $view->assertHasElement('input[id="my-input"]')->withAttributeValue('id', 'my-input');
        $view->assertHasElement('input[id="my-input-2"]')->withAttributeValue('id', 'my-input-2');
    }
}
