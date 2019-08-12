<?php

namespace Amethyst\Fakers;

use Faker\Factory;
use Railken\Bag;
use Railken\Lem\Faker;

class AttributeFaker extends Faker
{
    /**
     * @return \Railken\Bag
     */
    public function parameters()
    {
        $faker = Factory::create();

        $bag = new Bag();
        $bag->set('name', $faker->name);
        $bag->set('description', $faker->text);
        $bag->set('schema', 'Text');
        $bag->set('regex', '/^[a-zA-Z_][a-zA-Z0-9_]*$/');
        $bag->set('options', []);
        $bag->set('model', 'foo');
        $bag->set('required', false);

        return $bag;
    }
}
