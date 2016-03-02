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

namespace Graze\Dynamark3Client\Test;

use \Graze\TelnetClient\PromptMatcher;
use \Graze\TelnetClient\TelnetResponseInterface;
use \Graze\Dynamark3Client\Dynamark3Constants;
use \Graze\Dynamark3Client\Command\CommandInterface;
use \Mockery as m;

abstract class AbstractCommandTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * Returns the Command to be tested
     *
     * @return \Graze\Dynamark3Client\Command\CommandInterface
     */
    abstract protected function getCommand();

    /**
     * An example response from the Dynamark3 server, including line endings
     *
     * @return string
     */
    abstract protected function getRawTelnetResponse();

    /**
     * The expected response text once Command has parsed the TelnetResponse
     *
     * @return string
     */
    abstract protected function getExpectedResponseText();

    /**
     * @return void
     */
    public function testCommandSuccess()
    {
        $command = $this->getCommand();

        $this->assertInstanceOf(CommandInterface::class, $command);

        $telnetResponse = $this->buildTelnetResponse(
            $command->getPrompt() ?: Dynamark3Constants::PROMPT,
            $this->getRawTelnetResponse(),
            false
        );

        $response = $command->parseResponse($telnetResponse);
        $this->assertFalse($response->isError());
        $this->assertEquals($this->getExpectedResponseText(), $response->getResponseText());
    }

    /**
     * @return void
     */
    public function testCommandError()
    {
        $command = $this->getCommand();

        $telnetResponse = $this->buildTelnetResponse(
            Dynamark3Constants::PROMPT_ERROR,
            'ERROR 6' . Dynamark3Constants::LINE_ENDING,
            true
        );

        $response = $command->parseResponse($telnetResponse);
        $this->assertTrue($response->isError());
        $this->assertEquals(6, $response->getErrorCode());
    }

    /**
     * @param string $prompt
     * @param string $rawResponse
     * @param bool $isError
     *
     * @return TelnetResponseInterface
     */
    protected function buildTelnetResponse($prompt, $rawResponse, $isError)
    {
        $promptMatcher = new PromptMatcher();
        $bool = $promptMatcher->isMatch($prompt, $rawResponse, Dynamark3Constants::LINE_ENDING);

        if (!$bool) {
            throw new \Exception('prompt did not match');
        }

        $telnetResponse = m::mock(TelnetResponseInterface::class)
            ->shouldReceive('isError')
            ->andReturn($isError)
            ->shouldReceive('getResponseText')
            ->andReturn($promptMatcher->getResponseText())
            ->shouldReceive('getPromptMatches')
            ->andReturn($promptMatcher->getMatches())
            ->getMock();

        return $telnetResponse;
    }
}
