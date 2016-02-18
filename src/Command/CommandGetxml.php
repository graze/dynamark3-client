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

use Graze\TelnetClient\TelnetResponseInterface;

class CommandGetxml extends AbstractCommand
{
    /**
     * @return string
     */
    public function getCommandText()
    {
        return 'GETXML';
    }

    /**
     * @return string
     */
    public function getPrompt()
    {
        return 'RESULT GETXML .+';
    }

    /**
     * @param TelnetResponseInterface $telnetResponse
     *
     * @return Graze\Dynamark3Client\Dynamark3Response
     */
    public function parseResponse(TelnetResponseInterface $telnetResponse)
    {
        $prompt = reset($telnetResponse->getPromptMatches());

        $response = parent::parseResponse($telnetResponse);
        // prompt = RESULT GETXML <xml><something...
        $response->setResponseText(substr($prompt, 14));

        return $response;
    }
}
