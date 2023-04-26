<?php

namespace AppKit\Formulate\Tests;

use AppKit\Formulate\Facades\Formulate;
use AppKit\Formulate\Helpers\Routing\Route;
use AppKit\Formulate\Tests\Models\Article;
use Illuminate\Support\Js;

class AlpineFormModelTest extends TestCase
{
    /** @test */
    public function formDoNotNormallyHaveAnXDataAttribute()
    {
        $view = $this->blade('<x-form></x-form>');

        $view->assertHasElement('form')->withoutAttribute('x-data');
    }

    /** @test */
    public function ifAnEmptyXDataAttributeIsAddedToTheFormItIsPopulated()
    {
        $view = $this->blade('<x-form x-data></x-form>');

        $view->assertHasElement('form')->withAttributeValue('x-data', '{}');
    }

    /** @test */
    public function xDataContainsEntriesForEachFormField()
    {
        $view = $this->blade('<x-form x-data>
            <x-input name="foo" />
        </x-form>');

        $expected = ['foo' => ''];

        $view->assertHasElement('form')->withAttributeValue('x-data', Js::from($expected));
    }

    /** @test */
    public function xDataContainsEntriesForEachFormFieldValue()
    {
        $data = ['foo' => 'bar'];

        $view = $this->blade('<x-form x-data :data="$data">
            <x-input name="foo" />
        </x-form>', compact('data'));

        $expected = ['foo' => 'bar'];

        $view->assertHasElement('form')->withAttributeValue('x-data', Js::from($expected));
    }
}
