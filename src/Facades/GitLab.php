<?php

namespace Vinkla\GitLab\Facades;

use Illuminate\Support\Facades\Facade;

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
