<?php

/*
 * This file is part of Laravel GitLab.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vinkla\GitLab\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * This is the GitLab facade class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class GitLab extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'gitlab';
    }
}
