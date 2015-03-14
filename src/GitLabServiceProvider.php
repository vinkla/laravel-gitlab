<?php

namespace Vinkla\GitLab;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class GitLabServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->setupConfig();
    }

    /**
     * Setup the config.
     *
     * @return void
     */
    protected function setupConfig()
    {
        $source = realpath(__DIR__.'/../config/gitlab.php');
        $this->publishes([$source => config_path('gitlab.php')]);
        $this->mergeConfigFrom($source, 'gitlab');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerFactory($this->app);
        $this->registerManager($this->app);
    }

    /**
     * Register the factory class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function registerFactory(Application $app)
    {
        $app->singleton('gitlab.factory', function () {
            return new Factories\GitLabFactory();
        });

        $app->alias('gitlab.factory', 'Vinkla\GitLab\Factories\GitLabFactory');
    }

    /**
     * Register the manager class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function registerManager(Application $app)
    {
        $app->singleton('gitlab', function ($app) {
            $config = $app['config'];
            $factory = $app['gitlab.factory'];

            return new GitLabManager($config, $factory);
        });

        $app->alias('gitlab', 'Vinkla\GitLab\GitLabManager');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [
            'gitlab',
            'gitlab.factory'
        ];
    }
}
