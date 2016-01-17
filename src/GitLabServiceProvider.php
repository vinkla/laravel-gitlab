<?php

/*
 * This file is part of Laravel GitLab.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vinkla\GitLab;

use Gitlab\Client;
use Illuminate\Contracts\Container\Container as Application;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;

/**
 * This is the GitLab service provider class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class GitLabServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->setupConfig($this->app);
    }

    /**
     * Setup the config.
     *
     * @param \Illuminate\Contracts\Container\Container $app
     *
     * @return void
     */
    protected function setupConfig(Application $app)
    {
        $source = realpath(__DIR__.'/../config/gitlab.php');

        if ($app instanceof LaravelApplication && $app->runningInConsole()) {
            $this->publishes([$source => config_path('gitlab.php')]);
        } elseif ($app instanceof LumenApplication) {
            $app->configure('gitlab');
        }

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
        $this->registerBindings($this->app);
    }

    /**
     * Register the factory class.
     *
     * @param \Illuminate\Contracts\Container\Container $app
     *
     * @return void
     */
    protected function registerFactory(Application $app)
    {
        $app->singleton('gitlab.factory', function () {
            return new GitLabFactory();
        });

        $app->alias('gitlab.factory', GitLabFactory::class);
    }

    /**
     * Register the manager class.
     *
     * @param \Illuminate\Contracts\Container\Container $app
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

        $app->alias('gitlab', GitLabManager::class);
    }

    /**
     * Register the bindings.
     *
     * @param \Illuminate\Contracts\Container\Container $app
     *
     * @return void
     */
    protected function registerBindings(Application $app)
    {
        $app->bind('gitlab.connection', function ($app) {
            $manager = $app['gitlab'];

            return $manager->connection();
        });

        $app->alias('gitlab.connection', Client::class);
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
            'gitlab.factory',
            'gitlab.connection',
        ];
    }
}
