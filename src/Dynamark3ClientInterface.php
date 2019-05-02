<?php

/**
 * This file is part of graze/dynamark3-client.
 *
 * Copyright (c) 2016 Nature Delivered Ltd. <https://www.graze.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license https://github.com/graze/dynamark3-client/blob/master/LICENSE.md
 * @link    https://github.com/graze/dynamark3-client
 */

namespace Graze\Dynamark3Client;

interface Dynamark3ClientInterface
{
    /**
     * @param string $dsn
     */
    public function connect($dsn);

    /**
     * @param string $name
     * @param array  $arguments
     *
     * @return Dynamark3ResponseInterface
     */
    public function __call($name, array $arguments);
}
