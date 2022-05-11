<?php

namespace AppKit\Formulate\Tests;

class InputComponentTest extends TestCase
{
    /** @test */
    public function inputComponentExists()
    {
        $view = $this->blade('<x-input name="my-input"></x-input>');

        $view->assertHasElement('input')->withAttributeValue('name', 'my-input');
    }

    public function inputComponentsMustHaveAName()
    {
        $this->expectException(Illuminate\View\ViewException::class);

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
}
