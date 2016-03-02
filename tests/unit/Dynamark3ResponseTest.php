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

use \Graze\Dynamark3Client\Dynamark3Response;

class Dynamark3ResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider dataProviderSettersAndGetters
     *
     * @param bool $isError
     * @param string $responseText
     * @param int $errorCode
     *
     * @return void
     */
    public function testSettersAndGetters($isError, $responseText, $errorCode = null)
    {
        $response = new Dynamark3Response($responseText, $errorCode);

        $this->assertEquals($responseText, $response->getResponseText());
        $this->assertEquals($errorCode, $response->getErrorCode());
        $this->assertEquals($isError, $response->isError());
    }

    /**
     * @return array
     */
    public function dataProviderSettersAndGetters()
    {
        return [
            [false, 'some text', null],
            [true, 'some other text', 66],
        ];
    }
}
