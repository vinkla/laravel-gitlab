<?php

/*
 * This file is part of Laravel GitLab.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vinkla\GitLab;

use GrahamCampbell\Manager\AbstractManager;
use Illuminate\Contracts\Config\Repository;

/**
 * This is the GitLab manager class.
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
     * The factory instance.
     *
     * @var \Vinkla\GitLab\GitLabFactory
     */
    private $factory;

    /**
     * Create a new GitLab manager instance.
     *
     * @param \Illuminate\Contracts\Config\Repository $config
     * @param \Vinkla\GitLab\GitLabFactory $factory
     *
     * @return void
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
     *
     * @return \Vinkla\GitLab\GitLabFactory
     */
    public function getFactory()
    {
        return $this->factory;
    }
}
