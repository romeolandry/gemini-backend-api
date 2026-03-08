<?php

namespace App\Security;

use App\Entity\User;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Http\AccessToken\AccessTokenHandlerInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;

class AccessTokenHandler implements AccessTokenHandlerInterface
{
    public function __construct() {}

    public function getUserBadgeFrom(string $accessToken): UserBadge
    {

        $client = HttpClient::create();
        $response = $client->request('GET', 'https://oauth2.googleapis.com/tokeninfo', [
            'query' => ['access_token' => $accessToken]
        ]);

        $statusCode = $response->getStatusCode();

        if ($statusCode === 200) {
            $data = $response->toArray();
            // echo "Token is VALID. Seconds remaining: " . $data['expires_in'];
            return new UserBadge($data["user_Id"]);
        } else {
             throw new BadCredentialsException('Invalid credentials.');
        }
    }
}
