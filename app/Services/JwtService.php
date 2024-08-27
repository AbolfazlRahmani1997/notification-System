<?php

namespace App\Services;

use App\Services\Interfaces\JwtServiceInterface;
use DateTimeImmutable;
use Lcobucci\Clock\SystemClock;
use Lcobucci\JWT\Encoding\CannotDecodeContent;
use Lcobucci\JWT\Encoding\ChainedFormatter;
use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Token\Builder;
use Lcobucci\JWT\Token\InvalidTokenStructure;
use Lcobucci\JWT\Token\Parser;
use Lcobucci\JWT\Token\Plain;
use Lcobucci\JWT\Token\UnsupportedHeaderFound;
use Lcobucci\JWT\UnencryptedToken;
use Lcobucci\JWT\Validation\Constraint\LooseValidAt;
use Lcobucci\JWT\Validation\Validator;
use Lcobucci\JWT\Validation\Constraint\RelatedTo;

class JwtService implements JwtServiceInterface
{


    /**
     * Generate Token
     * @param string $uuid
     * @return Plain
     * @throws \Exception
     */
    public function generateToken(string $uuid): Plain
    {
        $signingKey = InMemory::base64Encoded(config("auth.JWT.JWT_KEY"));
        $now = new DateTimeImmutable();
        $tokenBuilder = (new Builder(new JoseEncoder(), ChainedFormatter::default()));
        $algorithm = new Sha256();

        return $tokenBuilder
            ->issuedBy(env('APP_URL'))
            ->issuedAt($now)
            ->expiresAt($now->modify('+2 hour'))
            ->relatedTo(config("auth.JWT.JWT_RELATED"))
            ->withClaim('uuid', $uuid)
            ->getToken($algorithm, $signingKey);
    }

    /**
     * Decode Token
     * @param string $jwt
     * @return UnencryptedToken
     */
    public function parserToken(string $jwt): UnencryptedToken
    {
        $parser = new Parser(new JoseEncoder());
        try {
            $token = $parser->parse($jwt);
        } catch (CannotDecodeContent|InvalidTokenStructure|UnsupportedHeaderFound $e) {
            echo 'Oh no, an error: ' . $e->getMessage();
        }
        assert($token instanceof UnencryptedToken);

        return $token;
    }

    /**
     * Convert Token
     * @param Plain $token
     * @return string
     */
    public function getStringToken(Plain $token): string
    {
        return $token->toString();
    }

    /**
     * get Return uuid
     */
    public function getUuid(UnencryptedToken $token): string
    {
        return $token->claims()->get('uuid');
    }

    /**
     * Validation Token
     */
    public function validationRelated(string $token): bool
    {

        $parser = new Parser(new JoseEncoder());
        $token = $parser->parse($token);

        $validator = new Validator();

        if (!$validator->validate($token, new RelatedTo(config("auth.JWT.JWT_RELATED")))) {
            return false;
        }
        return true;
    }

    /**
     * Validation Token
     */
    public function expireValidation(string $token): bool
    {
        $parser = new Parser(new JoseEncoder());
        $token = $parser->parse($token);
        $now = SystemClock::fromSystemTimezone();
        $validator = new Validator();
        if (!$validator->validate($token, new LooseValidAt($now))) {
            return false;// will print this
        }
        return true;
    }
}
