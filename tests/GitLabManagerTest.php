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
use GrahamCampbell\TestBench\AbstractTestCase as AbstractTestBenchTestCase;
use Illuminate\Contracts\Config\Repository;
use Mockery;
use Vinkla\GitLab\GitLabFactory;
use Vinkla\GitLab\GitLabManager;

/**
 * This is the GitLab manager test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class GitLabManagerTest extends AbstractTestBenchTestCase
{
    public function testCreateConnection()
    {
        $config = ['path' => __DIR__];

        $manager = $this->getManager($config);

        $manager->getConfig()->shouldReceive('get')->once()
            ->with('gitlab.default')->andReturn('gitlab');

        $this->assertSame([], $manager->getConnections());

        $return = $manager->connection();

        $this->assertInstanceOf(Client::class, $return);

        $this->assertArrayHasKey('gitlab', $manager->getConnections());
    }

    protected function getManager(array $config)
    {
        $repository = Mockery::mock(Repository::class);
        $factory = Mockery::mock(GitLabFactory::class);

        $manager = new GitLabManager($repository, $factory);

        $manager->getConfig()->shouldReceive('get')->once()
            ->with('gitlab.connections')->andReturn(['gitlab' => $config]);

        $config['name'] = 'gitlab';

        $manager->getFactory()->shouldReceive('make')->once()
            ->with($config)->andReturn(Mockery::mock(Client::class));

        return $manager;
    }
}
