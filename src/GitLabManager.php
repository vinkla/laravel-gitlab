<?php

namespace Vinkla\GitLab;

use GrahamCampbell\Manager\AbstractManager;
use Illuminate\Contracts\Config\Repository;
use Vinkla\GitLab\Factories\GitLabFactory;

/**
 * Simple API wrapper for Gitlab
 *
 * @property-read \Gitlab\Api\Groups $groups
 * @property-read \Gitlab\Api\Issues $issues
 * @property-read \Gitlab\Api\MergeRequests $merge_requests
 * @property-read \Gitlab\Api\MergeRequests $mr
 * @property-read \Gitlab\Api\Milestones $milestones
 * @property-read \Gitlab\Api\Milestones $ms
 * @property-read \Gitlab\Api\ProjectNamespaces $namespaces
 * @property-read \Gitlab\Api\ProjectNamespaces $ns
 * @property-read \Gitlab\Api\Projects $projects
 * @property-read \Gitlab\Api\Repositories $repositories
 * @property-read \Gitlab\Api\Repositories $repo
 * @property-read \Gitlab\Api\Snippets $snippets
 * @property-read \Gitlab\Api\SystemHooks $hooks
 * @property-read \Gitlab\Api\SystemHooks $system_hooks
 * @property-read \Gitlab\Api\Users $users
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class GitLabManager extends AbstractManager
{
    /**
     * The GitLab factory.
     *
     * @var \Vinkla\GitLab\Factories\GitLabFactory
     */
    private $factory;

    /**
     * Setup the GitLab factory.
     *
     * @param \Illuminate\Contracts\Config\Repository $config
     * @param \Vinkla\GitLab\Factories\GitLabFactory $factory
     */
    public function __construct(Repository $config, GitLabFactory $factory)
    {
        parent::__construct($config);

        $this->factory = $factory;
    }

    /**
     * Create the connection instance.
     *
     * @param array $config
     *
     * @return mixed
     */
    protected function createConnection(array $config)
    {
        return $this->factory->make($config);
    }

    /**
     * Get the configuration name.
     *
     * @return string
     */
    protected function getConfigName()
    {
        return 'gitlab';
    }

    /**
     * Get the factory instance.
     */
    public function getFactory()
    {
        return $this->factory;
    }
}
