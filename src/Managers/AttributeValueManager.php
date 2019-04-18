<?php

namespace Railken\Amethyst\Managers;

use Illuminate\Support\Facades\Config;
use Railken\Amethyst\Common\ConfigurableManager;
use Railken\Lem\Contracts\EntityContract;
use Railken\Lem\Manager;
use Railken\Lem\Result;

class AttributeValueManager extends Manager
{
    use ConfigurableManager;

    /**
     * @var string
     */
    protected $config = 'amethyst.attribute.data.attribute-value';

    /**
     * Add the attribute dinamically during the filling.
     *
     * @param \Railken\Amethyst\Models\Attributable $entity
     * @param \Railken\Bag|array                    $parameters
     *
     * @return \Railken\Lem\Result
     */
    public function fill(EntityContract $entity, $parameters)
    {
        $attributes = $this->getAttributes()->filter(function ($attribute) {
            return $attribute->getName() !== 'value';
        });

        $result = new Result();

        // We need to fill the entity before, so we can get the attribute value
        foreach ($attributes as $attribute) {
            $result->addErrors($attribute->update($entity, $parameters));
        }

        // Boot the attribute before updating it
        if ($result->ok()) {
            $class = Config::get('amethyst.attribute.schema.'.ucfirst($entity->attribute->schema));
            $attribute = $class::make(...array_merge(['value'], (array) $entity->attribute->options));
            $attribute->setManager($this);
            $attribute->boot();

            $result->addErrors($attribute->update($entity, $parameters));
        }

        return $result;
    }
}
