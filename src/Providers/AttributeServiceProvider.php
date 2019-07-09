<?php

namespace Amethyst\Providers;

use Amethyst\Common\CommonServiceProvider;

class AttributeServiceProvider extends CommonServiceProvider
{
    /**
     * @inherit
     */
    public function register()
    {
        parent::register();

        $this->app->singleton('amethyst.attributable', function ($app) {
            return new \Amethyst\Services\Attributable();
        });
    }

    /**
     * @inherit
     */
    public function boot()
    {
        parent::boot();

        \Illuminate\Database\Eloquent\Builder::macro('attrs', function () {
            return app('amethyst.attributable')->attachAttrsToModel($this);
        });

        app('amethyst.attributable')->boot();
    }
}
