<?php

namespace Amethyst\AttributeSchemaResolvers;

use Amethyst\Exceptions\AttributeSchemaPayloadInvalidException;
use Railken\Lem\Attributes\BaseAttribute;

class EmailResolver extends Resolver
{
    /**
     * Return \Railken\Lem\Attributes\BaseAttribute class
     *
     * @return string
     */
    public function getSchemaClass(): string
    {
        return \Railken\Lem\Attributes\EmailAttribute::class;
    }

    public function validate()
    {

    }
}
