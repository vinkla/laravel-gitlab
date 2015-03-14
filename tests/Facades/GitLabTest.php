<?php

namespace Vinkla\Tests\GitLab\Facades;

use GrahamCampbell\TestBench\Traits\FacadeTestCaseTrait;
use Vinkla\Tests\GitLab\AbstractTestCase;

class GitLabTest extends AbstractTestCase
{
    use FacadeTestCaseTrait;

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
