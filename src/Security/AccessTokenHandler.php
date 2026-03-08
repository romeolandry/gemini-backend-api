<?php

namespace App\Security;

use App\Entity\User;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Http\AccessToken\AccessTokenHandlerInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;

class AccessTokenHandler implements AccessTokenHandlerInterface
{
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly EntityManagerInterface $em
        )
    {}

    public function getUserBadgeFrom(string $accessToken): UserBadge
    {
        $this->logger->info('User Access Token: ' .$accessToken);

        $client = HttpClient::create();
        $response = $client->request('GET', 'https://oauth2.googleapis.com/tokeninfo', [
            'query' => ['access_token' => $accessToken]
        ]);

        $statusCode = $response->getStatusCode();

        // Google Authentication Validation
        $this->logger->info('Responce statut code : ' .$statusCode);

        if ($statusCode === 200) {
            $data = $response->toArray();
            // echo "Token is VALID. Seconds remaining: " . $data['expires_in'];
            $user = $this->em->getRepository(User::class)->findBy(["email" =>$data["email"]]);

            if(!$user){
                // tell Doctrine you want to (eventually) save the Product (no queries yet)
                $now = new DateTime();
                $user = new User();
                $user->setEmail($data["email"]);
                $user->setUsername(explode("@",$data["email"])[0]);
                $user->setCreatedat($now)
                    ->setUpdatedat($now);


                $this->logger->info(' Google User : ' . $user->getEmail());


                $this->em->persist($user);
                // actually executes the queries (i.e. the INSERT query)
                $this->em->flush();
            }

            return new UserBadge($data["email"]);

        } else {
             throw new BadCredentialsException('Invalid credentials.');
        }
    }
}
