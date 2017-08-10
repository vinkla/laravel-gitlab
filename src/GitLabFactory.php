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
use InvalidArgumentException;

/**
 * This is the gitlab factory class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class GitLabFactory
{
    /**
     * Make a new gitlab client.
     *
     * @param array $config
     *
     * @return \Gitlab\Client
     */
    public function make(array $config): Client
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
     * @return array
     */
    protected function getConfig(array $config): array
    {
        $keys = ['token', 'url'];

        foreach ($keys as $key) {
            if (!array_key_exists($key, $config)) {
                throw new InvalidArgumentException("Missing configuration key [$key].");
            }
        }

        return array_only($config, ['token', 'url', 'method', 'sudo']);
    }

    /**
     * Get the main client.
     *
     * @param array $config
     *
     * @return \Gitlab\Client
     */
    protected function getClient(array $config): Client
    {
        $client = Client::create($config['url']);

        $client->authenticate(
            $config['token'],
            array_get($config, 'method', Client::AUTH_URL_TOKEN),
            array_get($config, 'sudo', null)
        );

        return $client;
    }
}
