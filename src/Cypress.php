<?php

namespace NoelDeMartin\LaravelCypress;

use Closure;
use Exception;
use Illuminate\Support\Str;

class Cypress
{
    protected $modelsNamespace = 'App';
    protected $commands = [];

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

    public function command(string $command, Closure $handler) {
        $this->commands[$command] = $handler;
    }

    public function handleCommand(string $command, array $args) {
        if (!array_key_exists($command, $this->commands)) {
            throw new Exception("Called unregistered Cypress command '$command'");
        }

        return call_user_func_array($this->commands[$command], $args);
    }
}
