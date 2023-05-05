<?php

namespace AppKit\Formulate\Components\Concerns;

use Illuminate\View\ComponentAttributeBag;

trait InheritsAttributes
{
    /**
     * Store the inherited attributes
     * @var ComponentAttributeBag
     */
    protected ComponentAttributeBag $inheritedAttributes;

    /**
     * Inherit attributes from a different ComponentAttributeBag into this components attribute bag
     *
     * @param ComponentAttributeBag $attributes
     * @return void
     */
    protected function inheritAttributes(ComponentAttributeBag $attributes)
    {
        $this->attributes = $this->inheritedAttributes = $attributes;
    }

    /**
     * Set the extra attributes that the component should make available
     *
     * @param  array  $attributes
     * @return $this
     */
    public function withAttributes(array $attributes)
    {
        $this->attributes = $this->inheritedAttributes->merge($attributes);

        return $this;
    }
}
