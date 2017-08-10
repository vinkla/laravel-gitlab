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

namespace Vinkla\GitLab;

use Gitlab\Client;
use GrahamCampbell\Manager\AbstractManager;
use Illuminate\Contracts\Config\Repository;

/**
 * This is the gitlab manager class.
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
     * Create a new gitlab manager instance.
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
     * @return \Gitlab\Client
     */
    protected function createConnection(array $config): Client
    {
        return $this->factory->make($config);
    }

    /**
     * Get the configuration name.
     *
     * @return string
     */
    protected function getConfigName(): string
    {
        return 'gitlab';
    }

    /**
     * Get the factory instance.
     *
     * @return \Vinkla\GitLab\GitLabFactory
     */
    public function getFactory(): GitLabFactory
    {
        return $this->factory;
    }
}
