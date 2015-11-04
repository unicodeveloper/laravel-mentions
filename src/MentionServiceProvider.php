<?php

namespace Unicodeveloper\Mention;

use Illuminate\Support\ServiceProvider;
use Unicodeveloper\Mention\Factory\MentionBuilder;

class MentionServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;


    /**
     *  Publishes all the assets this package needs to function and load all routes
     * @return [type] [description]
     */
    public function boot()
    {
        $config = realpath(__DIR__.'/../resources/config/mentions.php');
        $views  = realpath(__DIR__.'/../resources/views');
        $script = realpath(__DIR__.'/../resources/assets');

        $this->publishes([
            $config => config_path('mentions.php'),
            $views  => base_path('resources/views/vendor/mentions'),
            $script => public_path('js'),
        ]);

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'mentions');

         if (! $this->app->routesAreCached()) {
            require __DIR__.'/Http/routes.php';
        }
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
