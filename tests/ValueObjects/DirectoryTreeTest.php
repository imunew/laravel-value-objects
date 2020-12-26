<?php

namespace Tests\ValueObjects;

use Tests\TestCase;

class DirectoryTreeTest extends TestCase
{
    /** @var array */
    private $directoryTree;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->directoryTree = new DirectoryTree([
            'app' => [
                'Http' => [
                    'Controllers' => [],
                    'Middleware' => [],
                    'Requests' => [],
                    'Resources' => [],
                ],
                'ValueObjects' => []
            ]
        ]);
    }

    /**
     * @test
     * @dataProvider getTestDataForHas
     * @param string $key
     * @param bool $exists
     */
    public function hasValue(string $key, bool $exists)
    {
        $this->assertSame($exists, $this->directoryTree->has($key));
    }

    /**
     * @return array
     */
    public function getTestDataForHas()
    {
        return [
            [
                'key' => 'app',
                'exists' => true
            ],
            [
                'key' => 'src',
                'exists' => false
            ],
            [
                'key' => 'app.Models',
                'exists' => false
            ],
            [
                'key' => 'app.ValueObjects',
                'exists' => true
            ],
        ];
    }

    /**
     * @test
     * @dataProvider getTestDataForGet
     * @param string $key
     * @param mixed|null $default
     * @param array|null $directories
     */
    public function getValue(string $key, $default, ?array $directories)
    {
        $this->assertSame($directories, $this->directoryTree->get($key, $default));
    }

    /**
     * @return array
     */
    public function getTestDataForGet()
    {
        return [
            [
                'key' => 'app',
                'default' => null,
                'directories' => [
                    'Http' => [
                        'Controllers' => [],
                        'Middleware' => [],
                        'Requests' => [],
                        'Resources' => [],
                    ],
                    'ValueObjects' => []
                ]
            ],
            [
                'key' => 'src',
                'default' => null,
                'directories' => null
            ],
            [
                'key' => 'app.Models',
                'default' => [],
                'directories' => []
            ],
            [
                'key' => 'app.ValueObjects',
                'default' => null,
                'directories' => []
            ],
        ];
    }
}
