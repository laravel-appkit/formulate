<?php

namespace AppKit\Formulate\Tests;

use Illuminate\Support\Js;

class AlpineFormModelTest extends TestCase
{
    /** @test */
    public function formDoNotNormallyHaveAnXDataAttribute()
    {
        $view = $this->blade('<x-formulate::form></x-formulate::form>');

        $view->assertHasElement('form')->withoutAttribute('x-data');
    }

    /** @test */
    public function ifAnEmptyXDataAttributeIsAddedToTheFormItIsPopulated()
    {
        $view = $this->blade('<x-formulate::form x-data></x-formulate::form>');

        $view->assertHasElement('form')->withAttributeValue('x-data', '{}');
    }

    /** @test */
    public function xDataContainsEntriesForEachFormField()
    {
        $view = $this->blade('<x-formulate::form x-data>
            <x-formulate::input name="foo" />
        </x-formulate::form>');

        $expected = ['foo' => ''];

        $view->assertHasElement('form')->withAttributeValue('x-data', Js::from($expected));
    }

    /** @test */
    public function xDataContainsEntriesForEachFormFieldValue()
    {
        $data = ['foo' => 'bar'];

        $view = $this->blade('<x-formulate::form x-data :data="$data">
            <x-formulate::input name="foo" />
        </x-formulate::form>', compact('data'));

        $expected = ['foo' => 'bar'];

        $view->assertHasElement('form')->withAttributeValue('x-data', Js::from($expected));
    }
}
