<?php

namespace Imunew\Laravel\ValueObjects\Provider;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Imunew\Laravel\ValueObjects\Console\MakeCommand;

/**
 * Class ServiceProvider
 * @package Imunew\Laravel\ValueObjects\Provider
 */
class ServiceProvider extends BaseServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function register()
    {
        $this->commands([
            MakeCommand::class
        ]);
    }
}
