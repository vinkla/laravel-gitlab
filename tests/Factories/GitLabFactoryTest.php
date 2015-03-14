<?php

namespace Vinkla\Tests\GitLab\Factories;

use Vinkla\GitLab\Factories\GitLabFactory;
use Vinkla\Tests\GitLab\AbstractTestCase;

class GitLabFactoryTest extends AbstractTestCase
{
    public function testMakeStandard()
    {
        $factory = $this->getGitLabFactory();

        $return = $factory->make([
            'token' => 'your-token',
            'base_url' => 'http://git.yourdomain.com/api/v3/',
        ]);
        $this->assertInstanceOf('GitLab\Client', $return);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMakeWithoutClientId()
    {
        $factory = $this->getGitLabFactory();

        $factory->make([]);
    }

    protected function getGitLabFactory()
    {
        return new GitLabFactory();
    }
}
