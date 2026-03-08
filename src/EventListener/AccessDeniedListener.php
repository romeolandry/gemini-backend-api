<?php

namespace App\EventListener;


use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

final class AccessDeniedListener
{

    public function __construct(private UrlGeneratorInterface $router) {}

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => ['onKernelException', 2],
        ];
    }

    #[AsEventListener]
    public function onExceptionEvent(ExceptionEvent $event): void
    {

        $exception = $event->getThrowable();
        // var_dump(($exception) );
        // die;
        if (!$exception instanceof AccessDeniedException) {
            return;
        }

        // die("testj");

        $request = $event->getRequest();
        // Only redirect if it's our specific API auth route
        if (str_starts_with($request->getPathInfo(), '/api/auth-user')) {
            // Redirect to your HWI OAuth route (from your security.yaml)
            $response = new RedirectResponse($this->router->generate('login'));
            $event->setResponse($response);
        }
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        if (!$exception instanceof AccessDeniedException) {
            return;
        }

        $request = $event->getRequest();
        // Only redirect if it's our specific API auth route
        if (str_starts_with($request->getPathInfo(), '/api/auth-user')) {
            // Redirect to your HWI OAuth route (from your security.yaml)
            $response = new RedirectResponse($this->router->generate('login'));
            $event->setResponse($response);
        }
    }
}
