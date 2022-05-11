<?php

namespace AppKit\Formulate\Tests;

use Illuminate\Support\Facades\Route;

class ExampleTest extends TestCase
{
    /** @test */
    public function formComponentExists()
    {
        $view = $this->blade('<x-form></x-form>');

        $view->assertHasElement('form');
    }

    /** @test */
    public function formComponentsCanHaveAttributes()
    {
        $view = $this->blade('<x-form class="my-class"></x-form>');

        $view->assertHasElement('form')->withAttributeValue('class', 'my-class');
    }

    /** @test */
    public function formComponentsCanHaveAnAction()
    {
        $view = $this->blade('<x-form action="/"></x-form>');

        $view->assertHasElement('form')->withAttributeValue('action', '/');
    }

    /** @test */
    public function formComponentsCanHaveAGetMethod()
    {
        $view = $this->blade('<x-form action="/" method="GET"></x-form>');

        $view->assertHasElement('form')->withAttributeValue('method', 'GET');
    }

    /** @test */
    public function formComponentsCanHaveAPostMethod()
    {
        $view = $this->blade('<x-form action="/" method="POST"></x-form>');

        $view->assertHasElement('form')->withAttributeValue('method', 'POST');
        $view->assertHasElement('input[name="_token"]')->withAttributeValue('type', 'hidden')->withAttribute('value');
    }

    /** @test */
    public function formComponentsCanHaveANonStandardMethod()
    {
        $view = $this->blade('<x-form action="/" method="PATCH"></x-form>');

        $view->assertHasElement('form')->withAttributeValue('method', 'POST');
        $view->assertHasElement('input[name="_token"]')->withAttributeValue('type', 'hidden')->withAttribute('value');
        $view->assertHasElement('input[name="_method"]')->withAttributeValue('type', 'hidden')->withAttributeValue('value', 'PATCH');
    }

    /** @test */
    public function formComponentsCanHaveSlotValue()
    {
        $view = $this->blade('<x-form action="/" method="GET"><p>Hello World</p></x-form>');

        $view->assertHasElement('p')->withContents('Hello World');
    }

    /** @test */
    public function formComponentCanHaveARoute()
    {
        Route::post('/example-route', 'ExampleController@example')->name('example');

        $view = $this->blade('<x-form route="example"></x-form>');

        $view->assertHasElement('form')->withAttributeValue('action', config('app.url') . '/example-route')->withAttributeValue('method', 'POST');
        $view->assertHasElement('input[name="_token"]')->withAttributeValue('type', 'hidden')->withAttribute('value');
    }

    /** @test */
    public function formComponentCanHaveARouteWithDifferentMethod()
    {
        Route::post('/example-route', 'ExampleController@example')->name('example');

        $view = $this->blade('<x-form route="example" method="PATCH"></x-form>');

        $view->assertHasElement('form')->withAttributeValue('action', config('app.url') . '/example-route')->withAttributeValue('method', 'POST');
        $view->assertHasElement('input[name="_token"]')->withAttributeValue('type', 'hidden')->withAttribute('value');
        $view->assertHasElement('input[name="_method"]')->withAttributeValue('type', 'hidden')->withAttributeValue('value', 'PATCH');
    }
}
