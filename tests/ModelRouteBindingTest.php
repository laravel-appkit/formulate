<?php

namespace AppKit\Formulate\Tests;

use AppKit\Formulate\Facades\Formulate;
use AppKit\Formulate\Helpers\Routing\Route;
use AppKit\Formulate\Tests\Models\Article;

class ModelRouteBindingTest extends TestCase
{
    /** @test */
    public function modelsAreAutomaticallyBoundToTheRouteOnTheFormComponent()
    {
        $data = factory(Article::class)->create(['title' => 'My Title']);

        $view = $this->blade('<x-form route="article.update" :data="$data"></x-form>', compact('data'));

        $view->assertHasElement('form')->withAttributeValue('action', route('article.update', $data));
    }
}
