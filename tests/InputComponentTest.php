<?php

namespace AppKit\Formulate\Tests;

use Illuminate\View\ViewException;

class InputComponentTest extends TestCase
{
    /** @test */
    public function inputComponentExists()
    {
        $view = $this->blade('<x-input name="my-input"></x-input>');

        $view->assertHasElement('input')->withAttributeValue('name', 'my-input');
    }

    /** @test */
    public function inputComponentsMustHaveAName()
    {
        $this->expectException(ViewException::class);

        $this->blade('<x-input></x-input>');
    }

    /** @test */
    public function inputComponentCanHaveAttributes()
    {
        $view = $this->blade('<x-input name="my-input" class="my-class"></x-input>');

        $view->assertHasElement('input')->withAttributeValue('class', 'my-class');
    }

    /** @test */
    public function inputComponentsHaveADefaultType()
    {
        $view = $this->blade('<x-input name="my-input"></x-input>');

        $view->assertHasElement('input')->withAttributeValue('type', 'text');
    }

    /** @test */
    public function inputComponentsGenerateADefaultId()
    {
        $view = $this->blade('<x-input name="my-input"></x-input>');

        $view->assertHasElement('input')->withAttributeValue('id', 'my-input');
    }

    /** @test */
    public function inputComponentsCanHaveADefinedId()
    {
        $view = $this->blade('<x-input name="my-input" id="my-id"></x-input>');

        $view->assertHasElement('input')->withAttributeValue('id', 'my-id');
    }

    /** @test */
    public function inputComponentsCanHaveGroupAttributes()
    {
        $view = $this->blade('<x-input name="my-input" group:class="my-group"></x-input>');

        $view->assertHasElement('div')->withAttributeValue('class', 'my-group');
    }

    /** @test */
    public function inputComponentsCanHaveLabelAttributes()
    {
        $view = $this->blade('<x-input name="my-input" label:class="my-label"></x-input>');

        $view->assertHasElement('label')->withAttributeValue('class', 'my-label');
    }

    /** @test */
    public function inputComponentsGenerateLabelValues()
    {
        $view = $this->blade('<x-input name="my-input"></x-input>');

        $view->assertHasElement('label')->withContent('My input');
    }

    /** @test */
    public function inputComponentsCanHaveSetLabels()
    {
        $view = $this->blade('<x-input name="my-input" label="My label"></x-input>');

        $view->assertHasElement('label')->withContent('My label');
    }
}
