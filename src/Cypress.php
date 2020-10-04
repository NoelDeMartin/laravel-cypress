<?php

namespace NoelDeMartin\LaravelCypress;

use Closure;
use Exception;
use Illuminate\Support\Str;

class Cypress
{
    protected $modelsNamespace = null;
    protected $commands = [];

    public function setModelsNamespace(string $modelsNamespace)
    {
        $this->modelsNamespace = $modelsNamespace;
    }

    public function resolveModelClass(string $model)
    {
        if (Str::contains($model, '\\'))
            return $model;

        $modelsNamespace = static::$modelsNamespace ?? $this->guessModelsNamespace();

        return $modelsNamespace . '\\' . Str::studly($model);
    }

    public function command(string $command, Closure $handler) {
        $this->commands[$command] = $handler;
    }

    public function handleCommand(string $command, array $args) {
        if (!array_key_exists($command, $this->commands)) {
            throw new Exception("Called unregistered Cypress command '$command'");
        }

        return call_user_func_array($this->commands[$command], $args);
    }

    private function guessModelsNamespace() {
        $rootNamespace = app()->getNamespace();

        return is_dir(app_path('Models'))
            ? $rootNamespace . 'Models'
            : rtrim($rootNamespace, '\\/');
    }
}
