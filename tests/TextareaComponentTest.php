<?php

namespace AppKit\Formulate\Tests;

class TextareaComponentTest extends TestCase
{
    /** @test */
    public function textareaComponentExists()
    {
        $view = $this->blade('<x-textarea name="my-input"></x-textarea>');

        $view->assertHasElement('textarea')->withAttributeValue('name', 'my-input');
    }

    public function textareaComponentsMustHaveAName()
    {
        $this->expectException(Illuminate\View\ViewException::class);

        $this->blade('<x-textarea></x-textarea>');
    }

    /** @test */
    public function textareaComponentCanHaveAttributes()
    {
        $view = $this->blade('<x-textarea name="my-input" class="my-class"></x-textarea>');

        $view->assertHasElement('textarea')->withAttributeValue('class', 'my-class');
    }

    /** @test */
    public function textareaComponentsGenerateADefaultId()
    {
        $view = $this->blade('<x-textarea name="my-input"></x-textarea>');

        $view->assertHasElement('textarea')->withAttributeValue('id', 'my-input');
    }

    /** @test */
    public function textareaComponentsCanHaveADefinedId()
    {
        $view = $this->blade('<x-textarea name="my-input" id="my-id"></x-textarea>');

        $view->assertHasElement('textarea')->withAttributeValue('id', 'my-id');
    }

    /** @test */
    public function textareaComponentsCanHaveGroupAttributes()
    {
        $view = $this->blade('<x-textarea name="my-input" group:class="my-group"></x-textarea>');

        $view->assertHasElement('div')->withAttributeValue('class', 'my-group');
    }

    /** @test */
    public function textareaComponentsCanHaveLabelAttributes()
    {
        $view = $this->blade('<x-textarea name="my-input" label:class="my-label"></x-textarea>');

        $view->assertHasElement('label')->withAttributeValue('class', 'my-label');
    }

    /** @test */
    public function textareaComponentsGenerateLabelValues()
    {
        $view = $this->blade('<x-textarea name="my-input"></x-textarea>');

        $view->assertHasElement('label')->withContent('My input');
    }

    /** @test */
    public function textareaComponentsCanHaveSetLabels()
    {
        $view = $this->blade('<x-textarea name="my-input" label="My label"></x-textarea>');

        $view->assertHasElement('label')->withContent('My label');
    }
}
