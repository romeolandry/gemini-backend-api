<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\QueryParameter;
use App\Entity\User;
use App\Security\AccessTokenHandler;
use App\State\AuthenticatorState;


#[ApiResource(
    operations: [
        new Get(
            uriTemplate: '/auth-user/{provider}',
            stateless: false,
            provider: AuthenticatorState::class
            // This ensures the 'id' shows up correctly in Swagger/OpenAPI
            // parameters: [
            //     'provider' => new QueryParameter(required: true)
            // ]
        ),
        new Post(
            uriTemplate: '/auth-user/{provider}',
            provider: AuthenticatorState::class
        )
    ]
)]
class AuthenticaticorApiResource
{

    public ?string $provider = null;

    public function __construct(
        private AccessTokenHandler $accessTokenHandler
    ) {}

    public function __invoke(User $user): User
    {
        var_dump("auth handler");
        die;
        $this->accessTokenHandler->handler($user);

        return $user;
    }
}
