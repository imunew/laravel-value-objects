<?php

namespace Imunew\Laravel\ValueObjects\Providers;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Imunew\Laravel\ValueObjects\Console\MakeCommand;

/**
 * Class ServiceProvider
 * @package Imunew\Laravel\ValueObjects\Providers
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
