<?php

namespace Amethyst\Services;

use Amethyst\Models;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Railken\Lem\Manager;
use Symfony\Component\Yaml\Yaml;

class Attributable
{
    protected $attributes;

    public function reload()
    {
        $this->attributes = Models\Attribute::all();
    }

    public function boot()
    {
        if (!Schema::hasTable(Config::get('amethyst.attribute.data.attribute.table'))) {
            return;
        }

        $this->reload();
        
        Manager::listen('boot', function ($data) {
            $manager = $data->manager;

            $name = app('amethyst')->tableize($manager->getEntity());

            $attributes = $this->attributes->filter(function($attribute) use ($name) { return $attribute->model === $name; });

            foreach ($attributes as $attributeRaw) {
                $class = config('amethyst.attribute.schema.'.$attributeRaw->schema);
                $attribute = $class::make($attributeRaw->name)->setManager($manager);

                $attribute->setRequired($attributeRaw->required);

                $options = (object) Yaml::parse((string) $attributeRaw->options);

                if (!empty($attributeRaw->regex)) {
                    $attribute->setValidator(function ($entity, $value) use ($attributeRaw) {
                        return preg_match($attributeRaw->regex, $value);
                    });
                }

                if (!empty($options)) {
                    if (!empty($options->options)) {
                        $attribute->setOptions($options->options);
                    }
                }

                $attribute->boot();
                $manager->addAttribute($attribute);
            }
        });
    }
}
