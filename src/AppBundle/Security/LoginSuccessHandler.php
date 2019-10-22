<?php


namespace AppBundle\Security;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

class LoginSuccessHandler implements AuthenticationSuccessHandlerInterface
{
    protected $router;
    protected $authorizationChecker;

    public function __construct(Router $router, AuthorizationChecker $authorizationChecker)
    {
        $this->router = $router;
        $this->authorizationChecker = $authorizationChecker;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        $session = new Session();
        $response = null;
        if ($this->authorizationChecker->isGranted('ROLE_ADMIN')) {
            $session->set('isAlive', 'true');
            $response = new RedirectResponse($this->router->generate('listing'));
        } else {
            if ($this->authorizationChecker->isGranted('ROLE_MYPROJECT_USER')) {
                $session->set('isAlive', 'true');
                $response = new RedirectResponse($this->router->generate('listing'));
            }
        }
        return $response;
        // TODO: Implement onAuthenticationSuccess() method.
    }

}