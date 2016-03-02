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

use \Graze\TelnetClient\TelnetResponseInterface;
use \Graze\Dynamark3Client\Command\CommandInterface;
use \Graze\TelnetClient\TelnetClientInterface;
use \Graze\Dynamark3Client\CommandResolver;
use \Graze\Dynamark3Client\Dynamark3Client;
use \Graze\Dynamark3Client\Dynamark3ResponseInterface;
use \Graze\Dynamark3Client\Dynamark3Constants;
use \Mockery as m;

class Dynamark3ClientTest extends \PHPUnit_Framework_TestCase
{
    public function testSend()
    {
        $telnetResponse = m::mock(TelnetResponseInterface::class);
        $telnet = m::mock(TelnetClientInterface::class)
            ->shouldReceive('execute')
            ->with('COMMAND ARGS', null)
            ->andReturn($telnetResponse)
            ->once()
            ->getMock();

        $dynamark3Response = m::mock(Dynamark3ResponseInterface::class);
        $command = m::mock(CommandInterface::class)
            ->shouldReceive('getCommandText')
            ->andReturn('COMMAND')
            ->once()
            ->shouldReceive('getArgumentText')
            ->andReturn(' ARGS')
            ->once()
            ->shouldReceive('getPrompt')
            ->andReturn(null)
            ->once()
            ->shouldReceive('parseResponse')
            ->with($telnetResponse)
            ->andReturn($dynamark3Response)
            ->once()
            ->getMock();
        $commandResolver = m::mock(CommandResolver::class)
            ->shouldReceive('resolve')
            ->with('command')
            ->andReturn($command)
            ->once()
            ->getMock();

        $client = new Dynamark3Client($telnet, $commandResolver);
        $resp = $client->command();
        $this->assertSame($dynamark3Response, $resp);
    }

    public function testFactory()
    {
        $this->assertInstanceOf(Dynamark3Client::class, Dynamark3Client::factory());
    }

    public function testConnect()
    {
        $dsn = '127.0.0.1:23';
        $telnet = m::mock(TelnetClientInterface::class)
            ->shouldReceive('connect')
            ->with(
                $dsn,
                Dynamark3Constants::PROMPT,
                Dynamark3Constants::PROMPT_ERROR,
                Dynamark3Constants::LINE_ENDING
            )
            ->once()
            ->getMock();

        $commandResolver = m::mock(CommandResolver::class);

        $client = new Dynamark3Client($telnet, $commandResolver);
        $client->connect($dsn);
    }
}
