<?php

namespace App\Controller;

use HWI\Bundle\OAuthBundle\Security\Core\Authentication\Token\OAuthToken;
use HWI\Bundle\OAuthBundle\Security\Http\ResourceOwnerMap;
use HWI\Bundle\OAuthBundle\Security\Http\ResourceOwnerMapInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{

    public function __construct(
        // private Security $security
        private ResourceOwnerMapInterface $resourceOwnerMap

    ) { }

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->redirectToRoute('api_doc');
        // return $this->render('home/index.html.twig', [
        //     'controller_name' => 'HomeController',
        // ]); phpinfo(
    }

    #[
        Route('/google_access_token',name:'connect_google_token')
    ]
    public function getAccessToken(): JsonResponse | RedirectResponse
    {
        $token = $this->container->get('security.token_storage')->getToken();

        if ($token instanceof OAuthToken) {
            if ($token->isExpired()) {
                // Token is dead. Redirect to login or try to refresh.
                return $this->redirectToRoute('hwi_oauth_connect');
            }
        }

        $rawToken = $token->getRawToken();

        return new JsonResponse($rawToken);
    }

    public function getUserInfo($token) {
        $resourceOwner = $this->resourceOwnerMap->getResourceOwnerByName($token->getResourceOwnerName());

        // This calls the Google UserInfo endpoint using the accessToken
        $userResponse = $resourceOwner->getUserInformation($token->getRawToken());

        $data = $userResponse->getData();
        // Contains: 'email', 'family_name', 'given_name', 'picture', etc.
    }
}
