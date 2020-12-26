<?php

namespace Tests;

use Imunew\Laravel\ValueObjects\Providers\ServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

/**
 * Class TestCase
 * @package Tests
 */
class TestCase extends BaseTestCase
{
    /**
     * {@inheritdoc}
     */
    protected function getPackageProviders($app)
    {
        return [ServiceProvider::class];
    }

    /**
     * {@inheritdoc}
     */
    protected function getBasePath()
    {
        return realpath(__DIR__. '/../laravel');
    }
}
