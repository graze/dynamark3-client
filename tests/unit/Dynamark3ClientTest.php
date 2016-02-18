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

namespace Graze\Dynamark3Client\Test\Unit;

use Graze\TelnetClient\TelnetResponseInterface;
use Graze\Dynamark3Client\Command\CommandInterface;
use Graze\TelnetClient\TelnetClientInterface;
use Graze\Dynamark3Client\CommandResolver;
use Graze\Dynamark3Client\Dynamark3Client;
use Mockery as m;

class Dynamark3ClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider dataProviderSend
     *
     * @param string $expectedCommand
     * @param string $commandText
     * @param array $args
     *
     * @return void
     */
    public function testSend($expectedCommand, $commandText, array $args)
    {
        $telnetResponse = m::mock(TelnetResponseInterface::class);
        $telnet = m::mock(TelnetClientInterface::class)
            ->shouldReceive('execute')
            ->with($expectedCommand, null)
            ->andReturn($telnetResponse)
            ->once()
            ->getMock();

        $command = m::mock(CommandInterface::class)
            ->shouldReceive('getCommandText')
            ->andReturn($commandText)
            ->once()
            ->shouldReceive('getPrompt')
            ->andReturn(null)
            ->once()
            ->shouldReceive('parseResponse')
            ->with($telnetResponse)
            ->once()
            ->getMock();
        $commandResolver = m::mock(CommandResolver::class)
            ->shouldReceive('resolve')
            ->with($commandText)
            ->andReturn($command)
            ->getMock();

        $client = new Dynamark3Client($telnet, $commandResolver);
        call_user_func_array([$client, $commandText], $args);
    }

    /**
     * @return []
     */
    public function dataProviderSend()
    {
        return [
            ['aCommandYeah "arg1" "arg2"', 'aCommandYeah', ['arg1', 'arg2']],
            ['sweetCommandBro', 'sweetCommandBro', []],
        ];
    }
}
