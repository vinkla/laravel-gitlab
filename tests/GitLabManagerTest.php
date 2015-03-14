<?php

namespace Vinkla\Tests\GitLab;

use GrahamCampbell\TestBench\AbstractTestCase as AbstractTestBenchTestCase;
use Mockery;
use Vinkla\GitLab\GitLabManager;

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

        $this->assertInstanceOf('GitLab\Client', $return);

        $this->assertArrayHasKey('gitlab', $manager->getConnections());
    }

    protected function getManager(array $config)
    {
        $repository = Mockery::mock('Illuminate\Contracts\Config\Repository');
        $factory = Mockery::mock('Vinkla\GitLab\Factories\GitLabFactory');

        $manager = new GitLabManager($repository, $factory);

        $manager->getConfig()->shouldReceive('get')->once()
            ->with('gitlab.connections')->andReturn(['gitlab' => $config]);

        $config['name'] = 'gitlab';

        $manager->getFactory()->shouldReceive('make')->once()
            ->with($config)->andReturn(Mockery::mock('GitLab\Client'));

        return $manager;
    }
}
