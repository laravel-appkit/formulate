<?php

namespace AppKit\Formulate\Tests;

use Illuminate\Testing\Assert as PHPUnit;
use Illuminate\Testing\TestView;
use Symfony\Component\DomCrawler\Crawler;


class Element
{
    private $crawler;

    private $path;

    public function __construct($template)
    {
        $this->crawler = new Crawler($template);
    }

    public function assertElementExists($path)
    {
        // assert it exists
        PHPUnit::assertNotEmpty($this->crawler->filter($path));

        // update the path
        $this->path = $path;

        // make fluent
        return $this;
    }

    public function withAttribute($attribute)
    {
        PHPUnit::assertNotNull($this->crawler->filter($this->path)->attr($attribute));

        return $this;
    }

    public function withoutAttribute($attribute)
    {
        PHPUnit::assertNull($this->crawler->filter($this->path)->attr($attribute));

        return $this;
    }

    public function withAttributeValue($attribute, $value)
    {
        PHPUnit::assertEquals($value, $this->crawler->filter($this->path)->attr($attribute));

        return $this;
    }

    public function withContent($value)
    {
        PHPUnit::assertEquals($value, $this->crawler->filter($this->path)->innerText());

        return $this;
    }
}
