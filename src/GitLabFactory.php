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

use Gitlab\Client;
use InvalidArgumentException;

/**
 * This is the GitLab factory class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class GitLabFactory
{
    /**
     * Make a new GitLab client.
     *
     * @param array $config
     *
     * @return \Gitlab\Client
     */
    public function make(array $config)
    {
        $config = $this->getConfig($config);

        return $this->getClient($config);
    }

    /**
     * Get the configuration data.
     *
     * @param string[] $config
     *
     * @throws \InvalidArgumentException
     *
     * @return string
     */
    protected function getConfig(array $config)
    {
        $keys = ['token', 'base_url'];

        foreach ($keys as $key) {
            if (!array_key_exists($key, $config)) {
                throw new InvalidArgumentException("Missing configuration key [$key].");
            }
        }

        return array_only($config, ['token', 'base_url', 'method', 'sudo']);
    }

    /**
     * Get the main client.
     *
     * @param array $config
     *
     * @return \Gitlab\Client
     */
    protected function getClient(array $config)
    {
        $client = new Client($config['base_url']);

        $client->authenticate(
            $config['token'],
            array_get($config, 'method', Client::AUTH_HTTP_TOKEN),
            array_get($config, 'sudo', null)
        );

        return $client;
    }
}
