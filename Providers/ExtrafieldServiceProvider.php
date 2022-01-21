<?php

namespace Modules\Extrafield\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Modules\Extrafield\Facades\ExtrafieldFacade;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Extrafield\Composers\ExtrafieldComposer;
use Modules\Extrafield\Events\Handlers\RegisterExtrafieldSidebar;

class ExtrafieldServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
        $this->registerFacade();

        $this->app['events']->listen(BuildingSidebar::class, RegisterExtrafieldSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('extrafields', array_dot(trans('extrafield::extrafields')));
            // append translations

        });

        view()->composer('block::admin.blocks.edit', ExtrafieldComposer::class);
    }

    public function boot()
    {
        $this->publishConfig('extrafield', 'permissions');

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Extrafield\Repositories\ExtrafieldRepository',
            function () {
                $repository = new \Modules\Extrafield\Repositories\Eloquent\EloquentExtrafieldRepository(new \Modules\Extrafield\Entities\Extrafield());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Extrafield\Repositories\Cache\CacheExtrafieldDecorator($repository);
            }
        );
// add bindings

    }

    private function registerFacade()
    {
        $aliasLoader = AliasLoader::getInstance();
        $aliasLoader->alias('Extrafield', ExtrafieldFacade::class);
    }
}
