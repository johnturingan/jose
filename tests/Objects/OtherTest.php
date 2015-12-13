<?php

/*
 * The MIT License (MIT)
 *
 * Copyright (c) 2014-2015 Spomky-Labs
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

use Jose\JSONSerializationModes;
use Jose\Test\TestCase;

/**
 * Class JWETest.
 *
 * @group Other
 */
class OtherTest extends TestCase
{
    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Argument must be a string or a JWAInterface object.
     */
    public function testCannotRemoveAlgorithm()
    {
        $jwa_manager = $this->getJWAManager();

        $jwa_manager->removeAlgorithm([]);
    }

    public function testOutputModes()
    {
        $this->assertEquals(
            [
                JSONSerializationModes::JSON_COMPACT_SERIALIZATION,
                JSONSerializationModes::JSON_FLATTENED_SERIALIZATION,
                JSONSerializationModes::JSON_SERIALIZATION,
            ],
            JSONSerializationModes::getSupportedSerializationModes()
        );
    }
}
