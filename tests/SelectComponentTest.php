<?php

namespace AppKit\Formulate\Tests;

class SelectComponentTest extends TestCase
{
    /** @test */
    public function selectComponentExists()
    {
        $view = $this->blade('<x-formulate::select name="my-input"></x-formulate::select>');

        $view->assertHasElement('select')->withAttributeValue('name', 'my-input');
    }

    public function selectComponentsMustHaveAName()
    {
        $this->expectException(Illuminate\View\ViewException::class);

        $this->blade('<x-formulate::select></x-formulate::select>');
    }

    /** @test */
    public function selectComponentCanHaveAttributes()
    {
        $view = $this->blade('<x-formulate::select name="my-input" class="my-class"></x-formulate::select>');

        $view->assertHasElement('select')->withAttributeValueContaining('class', 'my-class');
    }

    /** @test */
    public function selectComponentsGenerateADefaultId()
    {
        $view = $this->blade('<x-formulate::select name="my-input"></x-formulate::select>');

        $view->assertHasElement('select')->withAttributeValue('id', 'my-input');
    }

    /** @test */
    public function selectComponentsCanHaveADefinedId()
    {
        $view = $this->blade('<x-formulate::select name="my-input" id="my-id"></x-formulate::select>');

        $view->assertHasElement('select')->withAttributeValue('id', 'my-id');
    }

    /** @test */
    public function selectComponentsCanHaveGroupAttributes()
    {
        $view = $this->blade('<x-formulate::select name="my-input" group:class="my-group"></x-formulate::select>');

        $view->assertHasElement('div')->withAttributeValueContaining('class', 'my-group');
    }

    /** @test */
    public function selectComponentsCanHaveLabelAttributes()
    {
        $view = $this->blade('<x-formulate::select name="my-input" label:class="my-label"></x-formulate::select>');

        $view->assertHasElement('label')->withAttributeValueContaining('class', 'my-label');
    }

    /** @test */
    public function selectComponentsGenerateLabelValues()
    {
        $view = $this->blade('<x-formulate::select name="my-input"></x-formulate::select>');

        $view->assertHasElement('label')->withContent('My input');
    }

    /** @test */
    public function selectComponentsCanHaveSetLabels()
    {
        $view = $this->blade('<x-formulate::select name="my-input" label="My label"></x-formulate::select>');

        $view->assertHasElement('label')->withContent('My label');
    }

    /** @test */
    public function selectComponentsCanHaveOptionsPassedAsRegularOptionsViaSlot()
    {
        $view = $this->blade('<x-formulate::select name="my-input" label="My label">
            <option value="option-value">Option A</option>
        </x-formulate::select>');

        $view->assertHasElement('option')->withAttributeValue('value', 'option-value')->withContent('Option A');
    }

    /** @test */
    public function selectComponentsCanHaveMultipleOptionsPassedAsRegularOptionsViaSlot()
    {
        $view = $this->blade('<x-formulate::select name="my-input" label="My label">
            <option value="option-value">Option A</option>
            <option value="option-value-2">Option B</option>
        </x-formulate::select>');

        $view->assertHasElement('option[value=option-value]')->withContent('Option A');
        $view->assertHasElement('option[value=option-value-2]')->withContent('Option B');
    }

    /** @test */
    public function selectComponentsCanHaveOptionsPassedAsOptionComponentsViaSlot()
    {
        $view = $this->blade('<x-formulate::select name="my-input" label="My label">
            <x-formulate::option value="option-value">Option A</x-formulate::option>
        </x-formulate::select>');

        $view->assertHasElement('option')->withAttributeValue('value', 'option-value')->withContent('Option A');
    }

    /** @test */
    public function selectComponentsCanHaveMultipleOptionsPassedAsOptionComponentsViaSlot()
    {
        $view = $this->blade('<x-formulate::select name="my-input" label="My label">
            <x-formulate::option value="option-value">Option A</x-formulate::option>
            <x-formulate::option value="option-value-2">Option B</x-formulate::option>
        </x-formulate::select>');

        $view->assertHasElement('option[value=option-value]')->withContent('Option A');
        $view->assertHasElement('option[value=option-value-2]')->withContent('Option B');
    }

    /** @test */
    public function selectComponentsCanHaveOptionsPassedAsAnOptionsAttribute()
    {
        $options = ['option-value' => 'Option A'];

        $view = $this->blade('<x-formulate::select name="my-input" label="My label" :options="$options"></x-formulate::select>', compact('options'));

        $view->assertHasElement('option[value=option-value]')->withAttributeValue('value', 'option-value')->withContent('Option A');
    }

    /** @test */
    public function selectComponentsCanHaveMultipleOptionsPassedAsAnOptionsAttribute()
    {
        $options = ['option-value' => 'Option A', 'option-value-2' => 'Option B'];

        $view = $this->blade('<x-formulate::select name="my-input" label="My label" :options="$options"></x-formulate::select>', compact('options'));

        $view->assertHasElement('option[value=option-value]')->withContent('Option A');
        $view->assertHasElement('option[value=option-value-2]')->withContent('Option B');
    }
}
