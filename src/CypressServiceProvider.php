<?php

namespace NoelDeMartin\LaravelCypress;

use Exception;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use NoelDeMartin\LaravelCypress\Cypress;

class CypressServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        Route::namespace('NoelDeMartin\LaravelCypress\Http\Controllers')
            ->middleware('web')
            ->group(function () {
                Route::get('/_cypress/setup', 'CypressController@setup');
                Route::get('/_cypress/csrf_token', 'CypressController@csrfToken');
                Route::get('/_cypress/current_user/{guard?}', 'CypressController@currentUser');
                Route::get('/_cypress/login/{userId}/{guard?}', 'CypressController@login');
                Route::get('/_cypress/logout/{guard?}', 'CypressController@logout');
                Route::post('/_cypress/create_models', 'CypressController@createModels');
                Route::post('/_cypress/call_artisan', 'CypressController@callArtisan');
                Route::post('/_cypress/command', 'CypressController@command');
            });
    }

    /**
     * Register any package services.
     *
     * @return void
     * @throws \Exception
     */
    public function register()
    {
        if ($this->app->environment('production')) {
            throw new Exception('It is unsafe to run Laravel Cypress in production.');
        }

        $this->app->bind('cypress', Cypress::class);
    }
}
