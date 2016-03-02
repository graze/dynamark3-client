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

namespace Graze\Dynamark3Client;

use \Graze\TelnetClient\TelnetClientInterface;
use \Graze\Dynamark3Client\CommandResolver;
use \Graze\Dynamark3Client\Command\CommandInterface;
use \Graze\TelnetClient\TelnetClient;
use \Graze\Dynamark3Client\Dynamark3Constants;

class Dynamark3Client
{
    /**
     * @var TelnetClientInterface
     */
    protected $telnet;

    /**
     * @var CommandResolver
     */
    protected $commandResolver;

    /**
     * @param TelnetClientInterface $telnet
     * @param CommandResolver $commandResolver
     */
    public function __construct(TelnetClientInterface $telnet, CommandResolver $commandResolver)
    {
        $this->telnet = $telnet;
        $this->commandResolver = $commandResolver;
    }

    /**
     * @param string $dsn
     */
    public function connect($dsn)
    {
        $this->telnet->connect(
            $dsn,
            Dynamark3Constants::PROMPT,
            Dynamark3Constants::PROMPT_ERROR,
            Dynamark3Constants::LINE_ENDING
        );
    }

    /**
     * @param string $name
     * @param array $arguments
     *
     * @return Graze\Dynamark3Client\Dynamark3Response;
     */
    public function __call($name, array $arguments)
    {
        $command = $this->commandResolver->resolve($name);
        $telnetResponse = $this->telnet->execute(
            $command->getCommandText() . $command->getArgumentText($arguments),
            $command->getPrompt()
        );

        return $command->parseResponse($telnetResponse);
    }

    /**
     * @return Dynamark3Client
     */
    public static function factory()
    {
        return new static(
            TelnetClient::factory(),
            new CommandResolver()
        );
    }
}
