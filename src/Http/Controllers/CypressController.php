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
        Artisan::call('migrate:fresh');
    }

    public function csrfToken()
    {
        return response()->json(csrf_token());
    }

    public function currentUser($guard = null)
    {
        return Auth::guard($guard)->user();
    }

    public function createModels(Request $request)
    {
        $request->validate(['modelClass' => 'required']);

        $modelClass = Cypress::resolveModelClass($request->input('modelClass'));
        $quantity = $request->input('quantity', 1);
        $attributes = $request->input('attributes', []);

        return factory($modelClass, $quantity)->create($attributes);
    }
}
