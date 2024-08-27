<?php

namespace App\Services\Interfaces;

use Lcobucci\JWT\Token\Plain;
use Lcobucci\JWT\UnencryptedToken;

interface JwtServiceInterface
{
    /**
     * Generate Token
     * @param string $uuid
     * @return Plain
     * @throws Exception
     */
    public function generateToken(string $uuid):Plain;

    /**
     * Decode Token
     * @param string $jwt
     * @return UnencryptedToken
     */
    public function parserToken(string $jwt): UnencryptedToken;

    /**
     * get Return uuid
     */
    public function getUuid(UnencryptedToken $token):string;

    /**
     * Convert Token
     * @param Plain $token
     * @return string
     */
    public function getStringToken(Plain $token): string;

    /**
     * Validation Token
     */
    public function validationRelated(string $token):bool;

    /**
     * Expire Validation
     * @param string $token
     * @return bool
     */
    public function expireValidation(string $token):bool;

}
