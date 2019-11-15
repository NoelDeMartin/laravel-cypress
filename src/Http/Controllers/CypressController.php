<?php

namespace NoelDeMartin\LaravelCypress\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

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

    public function createModels(Request $request)
    {
        $request->validate(['modelClass' => 'required']);

        $modelClass = $request->input('modelClass');

        return factory($modelClass)->create();
    }
}
