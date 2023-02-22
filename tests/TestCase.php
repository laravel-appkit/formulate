<?php

namespace AppKit\Formulate\Tests;

use AppKit\Formulate\Facades\Formulate;
use AppKit\Formulate\FormulateServiceProvider;
use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;
use Illuminate\Testing\TestView;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    use InteractsWithViews;

    /**
     * Setup the test environment
     */
    protected function setUp(): void
    {
        parent::setUp();

        // load the migrations that are used for testing only
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        // load default laravel migrations?
        // $this->loadLaravelMigrations();

        // load the model factories
        $this->withFactories(__DIR__ . '/database/factories');

        TestView::macro('assertHasElement', function ($path) {
            return tap((new Element($this->rendered)), function ($element) use ($path) {
                $element->assertElementExists($path);
            });
        });

        Formulate::registerComponents();
    }

    /**
     * Define the service providers
     *
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [FormulateServiceProvider::class];
    }

    /**
     * Define the facades
     *
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return [
            'Formulate' => Formulate::class,
        ];
    }

    /**
     * Define environment setup
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }

    /**
     * Define routes setup.
     *
     * @param  \Illuminate\Routing\Router  $router
     *
     * @return void
     */
    protected function defineRoutes($router)
    {
        $router->post('/user', 'AppKit\Formulate\Tests\Controllers\TestController@store')->name('user.store');
    }
}
