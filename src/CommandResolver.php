<?php

/**
 * This file is part of graze/dynamark3-client.
 *
 * Copyright (c) 2016 Nature Delivered Ltd. <https://www.graze.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license https://github.com/graze/dynamark3-client/blob/master/LICENSE
 * @link https://github.com/graze/dynamark3-client
 */

namespace Graze\Dynamark3Client;

use Graze\Dynamark3Client\Command\CommandGeneric;

class CommandResolver
{
    /**
     * @param string $name
     *
     * @return Graze\Dynamark3Client\Command\CommandInterface
     */
    public function resolve($name)
    {
        // attempt to find a specific command
        $className = 'Graze\\Dynamark3Client\\Command\\Command' . ucfirst($name);
        if (class_exists($className)) {
            return new $className();
        }

        // using the generic command
        return new CommandGeneric($this->camelCaseToCommand($name));
    }

    /**
     * @param string $camelCase
     *
     * @return string
     */
    protected function camelCaseToCommand($camelCase)
    {
        $parts = preg_split('/(?=[A-Z])/', $camelCase);
        return strtoupper(implode(' ', $parts));
    }
}
