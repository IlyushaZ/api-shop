<?php

namespace App\Infrastructure\Http\Resolver;

use App\Application\Security\LoggedUserProvider;
use App\Domain\User\Entity\Admin;
use App\Domain\User\Entity\Client;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class CurrentUserResolver implements ArgumentValueResolverInterface
{
    private const ROLES = [
        Admin::class,
        Client::class
    ];

    private $currentUser;

    public function __construct(LoggedUserProvider $userProvider)
    {
        $this->currentUser = $userProvider->provideEntity();
    }

    public function supports(Request $request, ArgumentMetadata $argument)
    {
        return in_array($argument->getType(), self::ROLES);
    }

    public function resolve(Request $request, ArgumentMetadata $argument)
    {
        $type = $argument->getType();

        if (!$this->currentUser instanceof $type) {
            throw new AccessDeniedException("You do not have access to this resource");
        }

        yield $this->currentUser;
    }
}