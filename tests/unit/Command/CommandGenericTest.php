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
use Graze\Dynamark3Client\Dynamark3Constants;
use Graze\Dynamark3Client\Command\CommandGeneric;

class CommandGenericTest extends AbstractCommandTestCase
{
    /**
     * @var string
     */
    protected $commandText;

    /**
     * @return CommandGeneric
     */
    protected function getCommand()
    {
        return new CommandGeneric($this->commandText);
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
     * @dataProvider dataProviderCommandSuccess
     *
     * @param string $commandText
     * @param string $rawTelnetResponse
     * @param string $expectedResponseText
     *
     * @return void
     */
    public function testCommandSuccess($commandText)
    {
        $this->commandText = $commandText;
        parent::testCommandSuccess();
    }

    /**
     * @return []
     */
    public function dataProviderCommandSuccess()
    {
        return [
            ['MARK STOP'],
            ['ANOTHERCOMMAND']
        ];
    }
}
