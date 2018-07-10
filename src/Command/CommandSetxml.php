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

namespace Graze\Dynamark3Client\Command;

use \Graze\TelnetClient\TelnetResponseInterface;

class CommandSetxml extends AbstractCommand
{
    /**
     * @return string
     */
    public function getCommandText()
    {
        return 'SETXML';
    }

    /**
     * @param array $arguments
     *
     * @return string
     */
    public function getArgumentText(array $arguments)
    {
        if (empty($arguments)) {
            return '';
        }

        return ' ' . implode(' ', $arguments);
    }
}
