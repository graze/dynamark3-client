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

namespace Graze\Dynamark3Client;

interface Dynamark3ResponseInterface
{
    /**
     * Any response from the server up until a prompt is encountered.
     *
     * @return string
     */
    public function getResponseText();

    /**
     * Whether an error prompt was encountered.
     *
     * @return bool
     */
    public function isError();

    /**
     * The error code returned from the Dynamark 3 server
     *
     * @return int
     */
    public function getErrorCode();
}
