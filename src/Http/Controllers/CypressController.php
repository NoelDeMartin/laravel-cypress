<?php

namespace NoelDeMartin\LaravelCypress\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use NoelDeMartin\LaravelCypress\Facades\Cypress;

class CypressController extends Controller
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

        return factory($modelClass, $quantity)->create($attributes);
    }

    public function callArtisan(Request $request)
    {
        $request->validate(['command' => 'required']);

        Artisan::call($request->input('command'), $request->input('parameters', []));
    }
}
