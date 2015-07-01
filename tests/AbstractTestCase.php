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

use GrahamCampbell\TestBench\AbstractPackageTestCase;
use Vinkla\GitLab\GitLabServiceProvider;

/**
 * This is the abstract test case class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
abstract class AbstractTestCase extends AbstractPackageTestCase
{
    /**
     * Get the service provider class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return string
     */
    protected function getServiceProviderClass($app)
    {
        return GitLabServiceProvider::class;
    }
}
