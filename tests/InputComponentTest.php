<?php

namespace AppKit\Formulate\Tests;

use Illuminate\View\ViewException;

class InputComponentTest extends TestCase
{
    /**
     * @test
     * @group x-formulate-input
    */
    public function inputComponentExists()
    {
        $view = $this->blade('<x-formulate::input name="my-input"></x-formulate::input>');

        $view->assertHasElement('input')->withAttributeValue('name', 'my-input');
    }

    /**
     *@test
    * @group x-formulate-input
    */
    public function inputComponentsMustHaveAName()
    {
        $this->expectException(ViewException::class);

        $this->blade('<x-formulate::input></x-formulate::input>');
    }

    /**
     *@test
    * @group x-formulate-input
    */
    public function inputComponentCanHaveAttributes()
    {
        $view = $this->blade('<x-formulate::input name="my-input" class="my-class"></x-formulate::input>');

        $view->assertHasElement('input')->withAttributeValueContaining('class', 'my-class');
    }

    /**
     *@test
    * @group x-formulate-input
    */
    public function inputComponentsHaveADefaultType()
    {
        $view = $this->blade('<x-formulate::input name="my-input"></x-formulate::input>');

        $view->assertHasElement('input')->withAttributeValue('type', 'text');
    }

    /**
     *@test
    * @group x-formulate-input
    */
    public function inputComponentsGenerateADefaultId()
    {
        $view = $this->blade('<x-formulate::input name="my-input"></x-formulate::input>');

        $view->assertHasElement('input')->withAttributeValue('id', 'my-input');
    }

    /**
     *@test
    * @group x-formulate-input
    */
    public function inputComponentsCanHaveADefinedId()
    {
        $view = $this->blade('<x-formulate::input name="my-input" id="my-id"></x-formulate::input>');

        $view->assertHasElement('input')->withAttributeValue('id', 'my-id');
    }

    /**
     *@test
    * @group x-formulate-input
    */
    public function inputComponentsCanHaveGroupAttributes()
    {
        $view = $this->blade('<x-formulate::input name="my-input" group:class="my-group"></x-formulate::input>');

        $view->assertHasElement('div')->withAttributeValueContaining('class', 'my-group');
    }

    /**
     *@test
    * @group x-formulate-input
    */
    public function inputComponentsCanHaveLabelAttributes()
    {
        $view = $this->blade('<x-formulate::input name="my-input" label:class="my-label"></x-formulate::input>');

        $view->assertHasElement('label')->withAttributeValueContaining('class', 'my-label');
    }

    /**
     *@test
    * @group x-formulate-input
    */
    public function inputComponentsGenerateLabelValues()
    {
        $view = $this->blade('<x-formulate::input name="my-input"></x-formulate::input>');

        $view->assertHasElement('label')->withContent('My input');
    }

    /**
     *@test
    * @group x-formulate-input
    */
    public function inputComponentsCanHaveSetLabels()
    {
        $view = $this->blade('<x-formulate::input name="my-input" label="My label"></x-formulate::input>');

        $view->assertHasElement('label')->withContent('My label');
    }
}
