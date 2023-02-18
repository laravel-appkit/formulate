<?php

namespace AppKit\Formulate;

use AppKit\Formulate\Components\CheckablesComponent;
use AppKit\Formulate\Components\FieldErrorComponent;
use AppKit\Formulate\Components\FieldGroupComponent;
use AppKit\Formulate\Components\FormComponent;
use AppKit\Formulate\Components\InputComponent;
use AppKit\Formulate\Components\LabelComponent;
use AppKit\Formulate\Components\OptionComponent;
use AppKit\Formulate\Components\SelectComponent;
use AppKit\Formulate\Components\TextareaComponent;
use AppKit\Formulate\Tests\Element;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Testing\TestView;

class FormulateServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        // define the blade components that this package exposes
        $components = [
            'checkables' => CheckablesComponent::class,
            'field-errors' => FieldErrorComponent::class,
            'field-group' => FieldGroupComponent::class,
            'form' => FormComponent::class,
            'input' => InputComponent::class,
            'label' => LabelComponent::class,
            'option' => OptionComponent::class,
            'select' => SelectComponent::class,
            'textarea' => TextareaComponent::class,
        ];

        // loop through them
        foreach ($components as $name => $componentClass) {
            // and register them
            Blade::component($name, $componentClass);
        }

        TestView::macro('assertHasElement', function ($path) {
            return tap((new Element($this->rendered)), function ($element) use ($path) {
                $element->assertElementExists($path);
            });
        });

        /*
         * Optional methods to load your package assets
         */
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'formulate');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('formulate.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'formulate');

        // Register the main class to use with the facade
        $this->app->singleton('formulate', function () {
            return new Formulate();
        });
    }
}
