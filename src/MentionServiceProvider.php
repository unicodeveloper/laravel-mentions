<?php

namespace Busayo\Mention;

use Busayo\Mention\Factory\MentionBuilder;
use Illuminate\Support\ServiceProvider;

class MentionServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;


    public function boot()
    {
        $this->setup(__DIR__)
             ->publishConfig()
             ->publishViews()
             ->publishAssets()
             ->loadViews()
             ->loadRoutes()
             ->mergeConfig('mentions');
    }


    /**
     * Register the application services
     * @return void
     */
    public function register()
    {
         $this->app->singleton('mentionBuilder', function ($app) {
            $form = new MentionBuilder($app['html'], $app['url'], $app['session.store']->getToken());

            return $form->setSessionStore($app['session.store']);
        });
    }

}
