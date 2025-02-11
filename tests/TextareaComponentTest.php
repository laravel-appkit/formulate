<?php

namespace AppKit\Formulate\Tests;

use Illuminate\View\ViewException;

class TextareaComponentTest extends TestCase
{
    /**
     * @test
     * @group x-formulate-textarea
    */
    public function textareaComponentExists()
    {
        $view = $this->blade('<x-formulate::textarea name="my-input"></x-formulate::textarea>');

        $view->assertHasElement('textarea')->withAttributeValue('name', 'my-input');
    }

    /**
     * @test
     * @group x-formulate-textarea
    */
    public function textareaComponentsMustHaveAName()
    {
        $this->expectException(ViewException::class);

        $this->blade('<x-formulate::textarea></x-formulate::textarea>');
    }

    /**
     * @test
     * @group x-formulate-textarea
    */
    public function textareaComponentCanHaveAttributes()
    {
        $view = $this->blade('<x-formulate::textarea name="my-input" class="my-class"></x-formulate::textarea>');

        $view->assertHasElement('textarea')->withAttributeValueContaining('class', 'my-class');
    }

    /**
     * @test
     * @group x-formulate-textarea
    */
    public function textareaComponentsGenerateADefaultId()
    {
        $view = $this->blade('<x-formulate::textarea name="my-input"></x-formulate::textarea>');

        $view->assertHasElement('textarea')->withAttributeValue('id', 'my-input');
    }

    /**
     * @test
     * @group x-formulate-textarea
    */
    public function textareaComponentsCanHaveADefinedId()
    {
        $view = $this->blade('<x-formulate::textarea name="my-input" id="my-id"></x-formulate::textarea>');

        $view->assertHasElement('textarea')->withAttributeValue('id', 'my-id');
    }

    /**
     * @test
     * @group x-formulate-textarea
    */
    public function textareaComponentsCanHaveGroupAttributes()
    {
        $view = $this->blade('<x-formulate::textarea name="my-input" group:class="my-group"></x-formulate::textarea>');

        $view->assertHasElement('div')->withAttributeValueContaining('class', 'my-group');
    }

    /**
     * @test
     * @group x-formulate-textarea
    */
    public function textareaComponentsCanHaveLabelAttributes()
    {
        $view = $this->blade('<x-formulate::textarea name="my-input" label:class="my-label"></x-formulate::textarea>');

        $view->assertHasElement('label')->withAttributeValueContaining('class', 'my-label');
    }

    /**
     * @test
     * @group x-formulate-textarea
    */
    public function textareaComponentsGenerateLabelValues()
    {
        $view = $this->blade('<x-formulate::textarea name="my-input"></x-formulate::textarea>');

        $view->assertHasElement('label')->withContent('My input');
    }

    /**
     * @test
     * @group x-formulate-textarea
    */
    public function textareaComponentsCanHaveSetLabels()
    {
        $view = $this->blade('<x-formulate::textarea name="my-input" label="My label"></x-formulate::textarea>');

        $view->assertHasElement('label')->withContent('My label');
    }
}
