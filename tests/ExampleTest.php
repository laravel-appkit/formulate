<?php

namespace AppKit\Formulate\Tests;

use AppKit\Formulate\Tests\Models\Article;

class ExampleTest extends TestCase
{
    /** @test */
    public function trueIsTrue()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function articlesCanBeLoaded()
    {
        // create 5 articles
        factory(Article::class, 5)->create();

        // check the database for 5 articles
        $this->assertEquals(5, Article::count());
    }
}
