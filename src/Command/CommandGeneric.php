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

namespace Graze\Dynamark3Client\Command;

class CommandGeneric extends AbstractCommand
{
    /**
     * @var string
     */
    protected $commandText;

    /**
     * @param string $commandText
     */
    public function __construct($commandText)
    {
        $this->commandText = $commandText;
    }

    /**
     * @return string
     */
    public function getCommandText()
    {
        return $this->commandText;
    }
}
