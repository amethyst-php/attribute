<?php

namespace Amethyst\Tests\Managers;

use Amethyst\Fakers\AttributeSchemaFaker;
use Amethyst\Fakers\FooFaker;
use Amethyst\Managers\AttributeSchemaManager;
use Amethyst\Managers\FooManager;
use Amethyst\Models\Foo;
use Amethyst\Tests\BaseTest;
use Railken\Lem\Support\Testing\TestableBaseTrait;
use Symfony\Component\Yaml\Yaml;

class AttributeSchemaTest extends BaseTest
{
    use TestableBaseTrait;

    /**
     * Manager class.
     *
     * @var string
     */
    protected $manager = AttributeSchemaManager::class;

    /**
     * Faker class.
     *
     * @var string
     */
    protected $faker = AttributeSchemaFaker::class;

}
