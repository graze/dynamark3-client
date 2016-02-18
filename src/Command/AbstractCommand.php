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

use Graze\Dynamark3Client\Command\CommandInterface;
use Graze\TelnetClient\TelnetResponseInterface;
use Graze\Dynamark3Client\Dynamark3Response;
use Graze\Dynamark3Client\Dynamark3Constants;

abstract class AbstractCommand implements CommandInterface
{
    /**
     * @return string
     */
    abstract public function getCommandText();

    /**
     * Default to the TelnetClient's prompt
     *
     * @return string
     */
    public function getPrompt()
    {
        return null;
    }

    /**
     * @param TelnetResponseInterface $response
     *
     * @return Graze\Dynamark3Client\Dynamark3Response
     */
    public function parseResponse(TelnetResponseInterface $response)
    {
        $errorCode = null;
        $promptMatches = $response->getPromptMatches();
        $prompt = reset($promptMatches);
        if ($response->isError()) {
            // error prompt - ERROR nnn
            $errorCode = substr($prompt, 6);
        }

        return new Dynamark3Response(
            $prompt,
            $errorCode
        );
    }
}
