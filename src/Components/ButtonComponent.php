<?php

namespace AppKit\Formulate\Components;

use Illuminate\View\Component;

class ButtonComponent extends BaseComponent
{
    public array $classes = [
        'active:bg-gray-900',
        'bg-gray-800',
        'border-transparent',
        'border',
        'dark:active:bg-gray-300',
        'dark:bg-gray-200',
        'dark:focus:bg-white',
        'dark:focus:ring-offset-gray-800',
        'dark:hover:bg-white',
        'dark:text-gray-800',
        'duration-150',
        'ease-in-out',
        'focus:bg-gray-700',
        'focus:outline-none',
        'focus:ring-2',
        'focus:ring-indigo-500',
        'focus:ring-offset-2',
        'font-semibold',
        'hover:bg-gray-700',
        'inline-flex',
        'items-center',
        'px-4',
        'py-2',
        'rounded-md',
        'text-white',
        'text-xs',
        'tracking-widest',
        'transition',
        'uppercase',
    ];

    /**
     * Initialise the label component
     *
     * @param InputComponent $field
     * @return void
     */
    public function __construct(public string $label, public string $type = 'submit')
    {

    }

    /**
     * Define the view name that is used for the component
     *
     * @return string
     */
    protected function viewName()
    {
        return 'formulate::components.button';
    }
}
