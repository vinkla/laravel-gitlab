<?php

/*
 * This file is part of Laravel GitLab.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vinkla\Tests\GitLab;

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
}
