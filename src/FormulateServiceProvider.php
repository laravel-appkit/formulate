<?php

namespace AppKit\Formulate;

use AppKit\Formulate\Components\FormComponent;
use AppKit\Formulate\Components\InputComponent;
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
        Blade::component('form', FormComponent::class);
        Blade::component('input', InputComponent::class);
        Blade::component('textarea', TextareaComponent::class);

        TestView::macro('assertHasElement', function ($path) {
            return tap((new Element($this->rendered)), function ($element) use ($path) {
                $element->assertElementExists($path);
            });
        });

        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'formulate');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'formulate');
        // $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        // $this->loadRoutesFrom(__DIR__ . '/../routes/formulate.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('formulate.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/formulate'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__ . '/../resources/assets' => public_path('vendor/formulate'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__ . '/../resources/lang' => resource_path('lang/vendor/formulate'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
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
