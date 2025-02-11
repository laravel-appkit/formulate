<?php

namespace AppKit\Formulate\Tests;

use Illuminate\Support\Facades\Route;

class FormComponentTest extends TestCase
{
    /** @test */
    public function formComponentExists()
    {
        $view = $this->blade('<x-formulate::form></x-formulate::form>');

        $view->assertHasElement('form');
    }

    /** @test */
    public function formComponentsCanHaveAttributes()
    {
        $view = $this->blade('<x-formulate::form class="my-class"></x-formulate::form>');

        $view->assertHasElement('form')->withAttributeValue('class', 'my-class');
    }

    /** @test */
    public function formComponentsCanHaveAnAction()
    {
        $view = $this->blade('<x-formulate::form action="/"></x-formulate::form>');

        $view->assertHasElement('form')->withAttributeValue('action', '/');
    }

    /** @test */
    public function formComponentsCanHaveAGetMethod()
    {
        $view = $this->blade('<x-formulate::form action="/" method="GET"></x-formulate::form>');

        $view->assertHasElement('form')->withAttributeValue('method', 'GET');
    }

    /** @test */
    public function formComponentsCanHaveAPostMethod()
    {
        $view = $this->blade('<x-formulate::form action="/" method="POST"></x-formulate::form>');

        $view->assertHasElement('form')->withAttributeValue('method', 'POST');
        $view->assertHasElement('input[name="_token"]')->withAttributeValue('type', 'hidden')->withAttribute('value');
    }

    /** @test */
    public function formComponentsCanHaveANonStandardMethod()
    {
        $view = $this->blade('<x-formulate::form action="/" method="PATCH"></x-formulate::form>');

        $view->assertHasElement('form')->withAttributeValue('method', 'POST');
        $view->assertHasElement('input[name="_token"]')->withAttributeValue('type', 'hidden')->withAttribute('value');
        $view->assertHasElement('input[name="_method"]')->withAttributeValue('type', 'hidden')->withAttributeValue('value', 'PATCH');
    }

    /** @test */
    public function formComponentsCanHaveSlotValue()
    {
        $view = $this->blade('<x-formulate::form action="/" method="GET"><p>Hello World</p></x-formulate::form>');

        $view->assertHasElement('p')->withContent('Hello World');
    }

    /** @test */
    public function formComponentCanHaveARoute()
    {
        Route::post('/example-route', 'ExampleController@example')->name('example');

        $view = $this->blade('<x-formulate::form route="example"></x-formulate::form>');

        $view->assertHasElement('form')->withAttributeValue('action', config('app.url') . '/example-route')->withAttributeValue('method', 'POST');
        $view->assertHasElement('input[name="_token"]')->withAttributeValue('type', 'hidden')->withAttribute('value');
    }

    /** @test */
    public function formComponentCanHaveARouteWithDifferentMethod()
    {
        Route::post('/example-route', 'ExampleController@example')->name('example');

        $view = $this->blade('<x-formulate::form route="example" method="PATCH"></x-formulate::form>');

        $view->assertHasElement('form')->withAttributeValue('action', config('app.url') . '/example-route')->withAttributeValue('method', 'POST');
        $view->assertHasElement('input[name="_token"]')->withAttributeValue('type', 'hidden')->withAttribute('value');
        $view->assertHasElement('input[name="_method"]')->withAttributeValue('type', 'hidden')->withAttributeValue('value', 'PATCH');
    }

    /** @test */
    public function formComponentsCanHaveRoutesWithParams()
    {
        Route::post('/example-route/{name}', 'ExampleController@example')->name('example');

        $params = ['name' => 'my-name'];
        $view = $this->blade('<x-formulate::form route="example" :route-params="$params"></x-formulate::form>', compact('params'));

        $view->assertHasElement('form')->withAttributeValue('action', config('app.url') . '/example-route/my-name')->withAttributeValue('method', 'POST');
        $view->assertHasElement('input[name="_token"]')->withAttributeValue('type', 'hidden')->withAttribute('value');
    }
}
