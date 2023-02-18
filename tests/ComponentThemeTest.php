<?php

namespace AppKit\Formulate\Tests;

class ComponentThemeTest extends TestCase
{
    /** @test */
    public function inputComponentsHaveDefaultClasses()
    {
        $view = $this->blade('<x-input name="my-input"></x-input>');

        $view->assertHasElement('input')->withAttributeValue('class', config('formulate.classes.field'));
    }

    /** @test */
    public function inputComponentsHaveDefinedClasses()
    {
        $view = $this->blade('<x-input name="my-input" class="defined-class"></x-input>');

        $view->assertHasElement('input')->withAttributeValue('class', 'defined-class');
    }

    /** @test */
    public function formGroupsHaveDefaultClasses()
    {
        $view = $this->blade('<x-input name="my-input"></x-input>');

        $view->assertHasElement('div')->withAttributeValue('class', config('formulate.classes.group'));
    }

    /** @test */
    public function formGroupsHaveDefinedClasses()
    {
        $view = $this->blade('<x-input name="my-input" group:class="defined-group-class"></x-input>');

        $view->assertHasElement('div')->withAttributeValue('class', 'defined-group-class');
    }

    /** @test */
    public function formLabelsHaveDefaultClasses()
    {
        $view = $this->blade('<x-input name="my-input"></x-input>');

        $view->assertHasElement('label')->withAttributeValue('class', config('formulate.classes.label'));
    }

    /** @test */
    public function formLabelsHaveDefinedClasses()
    {
        $view = $this->blade('<x-input name="my-input" label:class="defined-label-class"></x-input>');

        $view->assertHasElement('label')->withAttributeValue('class', 'defined-label-class');
    }
}
