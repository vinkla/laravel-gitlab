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
use Illuminate\Contracts\Container\Container;
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

        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('gitlab.php')]);
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('gitlab');
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
        $this->registerFactory();
        $this->registerManager();
        $this->registerBindings();
    }

    /**
     * Register the factory class.
     *
     * @return void
     */
    protected function registerFactory()
    {
        $this->app->singleton('gitlab.factory', function () {
            return new GitLabFactory();
        });

        $this->app->alias('gitlab.factory', GitLabFactory::class);
    }

    /**
     * Register the manager class.
     *
     * @return void
     */
    protected function registerManager()
    {
        $this->app->singleton('gitlab', function (Container $app) {
            $config = $app['config'];
            $factory = $app['gitlab.factory'];

            return new GitLabManager($config, $factory);
        });

        $this->app->alias('gitlab', GitLabManager::class);
    }

    /**
     * Register the bindings.
     *
     * @return void
     */
    protected function registerBindings()
    {
        $this->app->bind('gitlab.connection', function (Container $app) {
            $manager = $app['gitlab'];

            return $manager->connection();
        });

        $this->app->alias('gitlab.connection', Client::class);
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
