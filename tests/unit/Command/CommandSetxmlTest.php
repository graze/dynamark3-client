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
 * @link https://github.com/graze/dynamark3-client
 */

namespace Graze\Dynamark3Client\Test\Unit\Command;

use \Graze\Dynamark3Client\Test\AbstractCommandTestCase;
use \Graze\Dynamark3Client\Command\CommandSetxml;
use \Graze\Dynamark3Client\Dynamark3Constants;

class CommandSetxmlTest extends AbstractCommandTestCase
{
    /**
     * @return CommandGetxml
     */
    protected function getCommand()
    {
        return new CommandSetxml();
    }

    /**
     * @return string
     */
    protected function getRawTelnetResponse()
    {
        return Dynamark3Constants::PROMPT . Dynamark3Constants::LINE_ENDING;
    }

    /**
     * @return string
     */
    protected function getExpectedResponseText()
    {
        return Dynamark3Constants::PROMPT;
    }

    /**
     * @return string
     */
    protected function getExpectedArgumentText()
    {
        return ' a 1';
    }
}
