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

class Dynamark3Response
{
    /**
     * @var string
     */
    protected $responseText;

    /**
     * @var int
     */
    protected $errorCode;

    /**
     * @param string $responseText
     * @param int $errorCode
     */
    public function __construct($responseText, $errorCode = null)
    {
        $this->setResponseText($responseText);
        $this->setErrorCode($errorCode);
    }

    /**
     * @param string $responseText
     */
    public function setResponseText($responseText)
    {
        $this->responseText = $responseText;
    }

    /**
     * @param int $errorCode
     */
    public function setErrorCode($errorCode)
    {
        $this->errorCode = (int) $errorCode;
    }

    /**
     * @return string
     */
    public function getResponseText()
    {
        return $this->responseText;
    }

    /**
     * @return bool
     */
    public function isError()
    {
        return (bool) $this->errorCode;
    }

    /**
     * @return int
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }
}
