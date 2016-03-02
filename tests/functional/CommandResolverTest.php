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

namespace Graze\Dynamark3Client\Test\Functional;

use \Graze\Dynamark3Client\CommandResolver;
use \Graze\Dynamark3Client\Command\CommandGeneric;
use \Graze\Dynamark3Client\Command\CommandGetxml;

class Dynamark3ResolverTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider dataProviderResolve
     *
     * @param string $expectedInstance
     * @param string $name
     * @param string $expectedCommandText
     *
     * @return void
     */
    public function testResolve($expectedInstance, $name, $expectedCommandText)
    {
        $commandResolver = new CommandResolver();
        $command = $commandResolver->resolve($name);

        $this->assertInstanceOf($expectedInstance, $command);
        $this->assertEquals($expectedCommandText, $command->getCommandText());
    }

    /**
     * @return array
     */
    public function dataProviderResolve()
    {
        return [
            [CommandGeneric::class, 'markStop', 'MARK STOP'],
            [CommandGetxml::class, 'getXml', 'GETXML']
        ];
    }
}
