<?php

namespace NoelDeMartin\LaravelCypress;

use Illuminate\Support\Str;

class Cypress
{
    protected $modelsNamespace = 'App';

    public function setModelsNamespace(string $modelsNamespace)
    {
        $this->modelsNamespace = $modelsNamespace;
    }

    public function resolveModelClass(string $modelClass)
    {
        if (!Str::contains($modelClass, '\\'))
            return $this->modelsNamespace . '\\' . Str::studly($modelClass);

        return $modelClass;
    }
}
