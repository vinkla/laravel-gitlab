<?php

/*
 * This file is part of Laravel GitLab.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vinkla\Tests\GitLab\Facades;

use GrahamCampbell\TestBenchCore\FacadeTrait;
use Vinkla\Tests\GitLab\AbstractTestCase;

/**
 * This is the GitLab test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class GitLabTest extends AbstractTestCase
{
    use FacadeTrait;

    /**
     * Get the facade accessor.
     *
     * @return string
     */
    protected function getFacadeAccessor()
    {
        return 'gitlab';
    }

    /**
     * Get the facade class.
     *
     * @return string
     */
    protected function getFacadeClass()
    {
        return 'Vinkla\GitLab\Facades\GitLab';
    }

    /**
     * Get the facade route.
     *
     * @return string
     */
    protected function getFacadeRoot()
    {
        return 'Vinkla\GitLab\GitLabManager';
    }
}
