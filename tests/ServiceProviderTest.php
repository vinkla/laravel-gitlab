<?php

/*
 * This file is part of Laravel GitLab.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Vinkla\Tests\GitLab;

use Gitlab\Client;
use GrahamCampbell\TestBenchCore\ServiceProviderTrait;
use Vinkla\GitLab\GitLabFactory;
use Vinkla\GitLab\GitLabManager;

/**
 * This is the service provider test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class ServiceProviderTest extends AbstractTestCase
{
    use ServiceProviderTrait;

    public function testGitLabFactoryIsInjectable()
    {
        $this->assertIsInjectable(GitLabFactory::class);
    }

    public function testGitLabManagerIsInjectable()
    {
        $this->assertIsInjectable(GitLabManager::class);
    }

    public function testBindings()
    {
        $this->assertIsInjectable(Client::class);

        $original = $this->app['gitlab.connection'];
        $this->app['gitlab']->reconnect();
        $new = $this->app['gitlab.connection'];

        $this->assertNotSame($original, $new);
        $this->assertEquals($original, $new);
    }
}
