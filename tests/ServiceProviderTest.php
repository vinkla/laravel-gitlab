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

use GrahamCampbell\TestBench\Traits\ServiceProviderTestCaseTrait;

/**
 * This is the service provider test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class ServiceProviderTest extends AbstractTestCase
{
    use ServiceProviderTestCaseTrait;

    public function testGitLabFactoryIsInjectable()
    {
        $this->assertIsInjectable('Vinkla\GitLab\Factories\GitLabFactory');
    }

    public function testGitLabManagerIsInjectable()
    {
        $this->assertIsInjectable('Vinkla\GitLab\GitLabManager');
    }
}
