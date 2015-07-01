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

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

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

        if (class_exists('Illuminate\Foundation\Application', false)) {
            $this->publishes([$source => config_path('gitlab.php')]);
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
            return new GitLabFactory();
        });

        $app->alias('gitlab.factory', GitLabFactory::class);
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

        $app->alias('gitlab', GitLabManager::class);
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
        ];
    }
}
