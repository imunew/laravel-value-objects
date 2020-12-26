<?php

namespace Tests\Console;

use Imunew\Laravel\ValueObjects\ImmutableObject;
use Tests\TestCase;

class MakeCommandTest extends TestCase
{
    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        foreach (glob($this->getBasePath(). '/app/ValueObjects/{*,*/*}.php', GLOB_BRACE) as $filename) {
            unlink($filename);
        }
        foreach (glob($this->getBasePath(). '/app/ValueObjects/*', GLOB_ONLYDIR) as $directory) {
            rmdir($directory);
        }
    }

    /**
     * @test
     * @dataProvider getTestData
     * @param string $name
     */
    public function handle(string $name)
    {
        $this->artisan("make:value-object {$name}")
            ->assertExitCode(0)
            ->run()
        ;
        $filePath = $this->getBasePath(). "/app/ValueObjects/{$name}.php";
        $this->assertFileExists($filePath);

        require_once $filePath;
        $namespace = str_replace('/', '\\', $name);
        $this->assertTrue(class_exists("App\\ValueObjects\\{$namespace}"));
        $this->assertTrue(is_subclass_of("App\\ValueObjects\\{$namespace}", ImmutableObject::class));
    }

    /**
     * @return array
     */
    public function getTestData()
    {
        return [
            ['PhoneNumber'],
            ['Japanese/Address']
        ];
    }
}
