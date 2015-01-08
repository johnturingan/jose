<?php

namespace SpomkyLabs\Jose\Tests;

use SpomkyLabs\Jose\JWK;
use SpomkyLabs\Jose\Util\Base64Url;
use SpomkyLabs\Jose\Algorithm\KeyEncryption\A128GCMKW;
use SpomkyLabs\Jose\Algorithm\KeyEncryption\A192GCMKW;
use SpomkyLabs\Jose\Algorithm\KeyEncryption\A256GCMKW;

class AESGCMKWKeyEncryptionTest extends \PHPUnit_Framework_TestCase
{
    public function testA128GCMKW()
    {
        $header = array();
        $key = new JWK();
        $key->setValues(array(
            "kty" => "oct",
            "k"  => Base64Url::encode(hex2bin("000102030405060708090A0B0C0D0E0F")),
        ));

        $cek = hex2bin("00112233445566778899AABBCCDDEEFF000102030405060708090A0B0C0D0E0F");

        try {
            $aeskw = new A128GCMKW();
            if ($this->isHHVM()) {
                $this->fail("HHVM should not be able to support this Algorithm (PECL extension not available).");
            }  
        } catch (Exception $e) {
            $this->assertTrue(true);
            return;
        }

        $wrapped_cek = $aeskw->encryptKey($key, $cek, $header);

        $this->assertTrue(array_key_exists("iv", $header));
        $this->assertTrue(array_key_exists("tag", $header));
        $this->assertNotNull($header["iv"]);
        $this->assertNotNull($header["tag"]);
        $this->assertEquals($cek, $aeskw->decryptKey($key, $wrapped_cek, $header));
    }

    public function testA192GCMKW()
    {
        $header = array();
        $key = new JWK();
        $key->setValues(array(
            "kty" => "oct",
            "k"  => Base64Url::encode(hex2bin("000102030405060708090A0B0C0D0E0F1011121314151617")),
        ));

        $cek = hex2bin("00112233445566778899AABBCCDDEEFF000102030405060708090A0B0C0D0E0F");

        try {
            $aeskw = new A192GCMKW();
            if ($this->isHHVM()) {
                $this->fail("HHVM should not be able to support this Algorithm (PECL extension not available).");
            }  
        } catch (Exception $e) {
            $this->assertTrue(true);
            return;
        }

        $wrapped_cek = $aeskw->encryptKey($key, $cek, $header);

        $this->assertTrue(array_key_exists("iv", $header));
        $this->assertTrue(array_key_exists("tag", $header));
        $this->assertNotNull($header["iv"]);
        $this->assertNotNull($header["tag"]);
        $this->assertEquals($cek, $aeskw->decryptKey($key, $wrapped_cek, $header));
    }

    public function testA256GCMKW()
    {
        $header = array();
        $key = new JWK();
        $key->setValues(array(
            "kty" => "oct",
            "k"  => Base64Url::encode(hex2bin("000102030405060708090A0B0C0D0E0F101112131415161718191A1B1C1D1E1F")),
        ));

        $cek = hex2bin("00112233445566778899AABBCCDDEEFF000102030405060708090A0B0C0D0E0F");

        try {
            $aeskw = new A256GCMKW();
            if ($this->isHHVM()) {
                $this->fail("HHVM should not be able to support this Algorithm (PECL extension not available).");
            }  
        } catch (Exception $e) {
            $this->assertTrue(true);
            return;
        }

        $wrapped_cek = $aeskw->encryptKey($key, $cek, $header);

        $this->assertTrue(array_key_exists("iv", $header));
        $this->assertTrue(array_key_exists("tag", $header));
        $this->assertNotNull($header["iv"]);
        $this->assertNotNull($header["tag"]);
        $this->assertEquals($cek, $aeskw->decryptKey($key, $wrapped_cek, $header));
    }

    public function isHHVM()
    {
        return defined('HHVM_VERSION');
    }
}
