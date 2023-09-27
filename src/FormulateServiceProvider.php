<?php

namespace AppKit\Formulate;

use AppKit\Formulate\Facades\Formulate as FormulateFacade;
use AppKit\Formulate\Middleware\ApplyAlpineJsFormAttributes;
use AppKit\Formulate\Middleware\ApplyFormThemeClassesMiddleware;
use AppKit\Formulate\Middleware\PrecognitionMiddleware;
use AppKit\Formulate\Middleware\RepeatingFieldsMiddleware;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class FormulateServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
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

        // Register the blade components
        FormulateFacade::registerComponents(config('formulate.component_prefix', ''));

        FormulateFacade::registerMiddleware(ApplyFormThemeClassesMiddleware::class);
        FormulateFacade::registerMiddleware(ApplyAlpineJsFormAttributes::class);
        FormulateFacade::registerMiddleware(PrecognitionMiddleware::class);
        FormulateFacade::registerMiddleware(RepeatingFieldsMiddleware::class);
    }
}
