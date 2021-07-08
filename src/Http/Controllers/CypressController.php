<?php

namespace NoelDeMartin\LaravelCypress\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use NoelDeMartin\LaravelCypress\Facades\Cypress;

class CypressController
{
    public function setup()
    {
        //
    }

    public function csrfToken()
    {
        return response()->json(csrf_token());
    }

    public function login($userId, $guard = null)
    {
        $guard = $guard ?: config('auth.defaults.guard');
        $provider = Auth::guard($guard)->getProvider();
        $user = $provider->retrieveById($userId);

        Auth::guard($guard)->login($user);
    }

    public function logout($guard = null)
    {
        Auth::guard($guard ?: config('auth.defaults.guard'))->logout();
    }

    public function currentUser($guard = null)
    {
        return Auth::guard($guard)->user();
    }

    public function createModels(Request $request)
    {
        $request->validate(['modelClass' => 'required']);

        $modelClass = Cypress::resolveModelClass($request->input('modelClass'));
        $quantity = $request->input('quantity');
        $attributes = $request->input('attributes', []);

        return $this->createModelsUsingFactory($modelClass, $quantity, $attributes);
    }

    public function callArtisan(Request $request)
    {
        $request->validate(['command' => 'required']);

        Artisan::call($request->input('command'), $request->input('parameters', []));
        
        return response()->json(Artisan::output());
    }

    public function command(Request $request)
    {
        $request->validate(['command' => 'required']);

        return Cypress::handleCommand($request->get('command'), $request->get('arguments', []));
    }

    private function createModelsUsingFactory($modelClass, $quantity = 1, $attributes = [])
    {
        if (method_exists($modelClass, 'factory')) {
            return $modelClass::factory()->count($quantity)->create($attributes);
        }

        if (function_exists('factory')) {
            return factory($modelClass, $quantity)->create($attributes);
        }

        throw new Exception("Unable to locate factory for {$modelClass}.");
    }
}
