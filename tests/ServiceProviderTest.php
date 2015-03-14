<?php

namespace Vinkla\Tests\GitLab;

use GrahamCampbell\TestBench\Traits\ServiceProviderTestCaseTrait;

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
