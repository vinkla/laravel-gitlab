<?php

/*
 * This file is part of Laravel GitLab.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Vinkla\Tests\GitLab;

use Gitlab\Client;
use Vinkla\GitLab\GitLabFactory;

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
            'url' => 'https://git.yourdomain.com',
        ]);

        $this->assertInstanceOf(Client::class, $return);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMakeWithoutToken()
    {
        $factory = $this->getGitLabFactory();

        $factory->make([
            'url' => 'https://git.yourdomain.com',
        ]);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMakeWithoutUrl()
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
