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

use Graze\Dynamark3Client\Test\AbstractCommandTestCase;
use Graze\Dynamark3Client\Command\CommandGetxml;
use Graze\Dynamark3Client\Dynamark3Constants;

class CommandGetxmlTest extends AbstractCommandTestCase
{
    /**
     * @return \Graze\Dynamark3Client\Command\CommandInterface
     */
    protected function getCommand()
    {
        return new CommandGetxml();
    }

    /**
     * @return string
     */
    protected function getRawTelnetResponse()
    {
        return 'RESULT GETXML <xml><node>cool xml</node></xml>' . Dynamark3Constants::LINE_ENDING;
    }

    /**
     * @return string
     */
    protected function getExpectedResponseText()
    {
        return '<xml><node>cool xml</node></xml>';
    }
}
