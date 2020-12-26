<?php

namespace Imunew\Laravel\ValueObjects\Console;

use Illuminate\Console\GeneratorCommand;

class MakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:value-object';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new value object class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'ValueObject';

    /**
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/value-object.stub';
    }

    /**
     * {@inheritdoc}
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\ValueObjects';
    }
}
