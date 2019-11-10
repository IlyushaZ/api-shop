<?php

namespace App\Application\Http\Client;
use App\Application\Cqs\Registration\Command\RegisterClientCommand;
use App\Application\Cqs\Registration\Dto\RegistrationDto;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/register")
 */
class RegistrationController
{
    /**
     * Регистрация покупателя.
     *
     * @Route("", methods={"POST"})
     *
     * @SWG\Parameter(
     *     name="Информация о регистрирующемся пользователе.",
     *     in="body",
     *     required=true,
     *     type="application/json",
     *     @SWG\Schema(type="object", ref=@Model(type=App\Application\Cqs\Registration\Dto\RegistrationDto::class))
     * )
     *
     * @SWG\Response(
     *     response=201,
     *     description="Возвращает информацию о зарегистрированном пользователе.",
     *     @SWG\Schema(type="object", ref=@Model(type=App\Application\Cqs\User\Common\Output\UserOutput::class))
     * )
     *
     * @SWG\Tag(name="auth")
     */
    public function register(RegisterClientCommand $command, RegistrationDto $dto)
    {
        return $command->execute($dto);
    }
}