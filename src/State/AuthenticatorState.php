<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class AuthenticatorState implements ProviderInterface
{

    public function __construct(
        private RequestStack $requestStack,
        private Security $security,
        private UrlGeneratorInterface $router,
        private TokenStorageInterface $tokenStorage
    )
    {}

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {

        // $user = $this->security->getUser();
        // var_dump($user);
        // die;

        $session = $this->requestStack->getSession();

        $token = $session->get('security.token_storage', null);

        if(!$token){
            //die("token is null");
            // redirect to route with name "login"
            // Redirect to your HWI OAuth route (from your security.yaml)
            throw new AccessDeniedException('Login required.');
            // $response = new RedirectResponse($this->router->generate('login'));
            //$event->setResponse($response);
            // return $response;
        }

        //$resource = [];
        $resource =[
            'id' => $uriVariables['provider'],
            'message' => "This data came from a custom provider, not an entity!"
        ];

        return $resource;
    }
}
