<?php

/*
 * This file is part of Laravel GitLab.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vinkla\Tests\GitLab\Factories;

use Vinkla\GitLab\Factories\GitLabFactory;
use Vinkla\Tests\GitLab\AbstractTestCase;

/**
 * This is the GitLab factory test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
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
    public function testMakeWithoutToken()
    {
        $factory = $this->getGitLabFactory();

        $factory->make([
            'base_url' => 'http://git.yourdomain.com/api/v3/',
        ]);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMakeWithoutBaseUrl()
    {
        $factory = $this->getGitLabFactory();

        $factory->make([
            'token' => 'your-token',
        ]);
    }

    protected function getGitLabFactory()
    {
        return new GitLabFactory();
    }
}
