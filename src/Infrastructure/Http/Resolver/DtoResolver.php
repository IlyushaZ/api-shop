<?php

namespace App\Infrastructure\Http\Resolver;


use App\Application\Exception\ValidationException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class DtoResolver implements ArgumentValueResolverInterface
{
    private $serializer;
    private $validator;

    public function __construct(SerializerInterface $serializer, ValidatorInterface $validator)
    {
        $this->serializer = $serializer;
        $this->validator = $validator;
    }

    public function supports(Request $request, ArgumentMetadata $argument)
    {
        return substr($argument->getType(), -3) === 'Dto';
    }

    public function resolve(Request $request, ArgumentMetadata $argument)
    {
        $type = $argument->getType();
        $content = $request->getContent();

        yield $this->deserialize($type, $content);
    }

    private function deserialize(string $type, string $content)
    {
        $deserialized = $this->serializer->deserialize($content, $type, 'json');

        if (null !== $deserialized) {
            $this->validate($deserialized);
        }

        return $deserialized;
    }

    private function validate($data)
    {
        if (count($errors = $this->validator->validate($data)) > 0) {
            $errorsArr = [];

            /** @var ConstraintViolation $e */
            foreach ($errors as $e) {
                $prop = $e->getPropertyPath();
                $errorsArr[] = null !== $prop ? "{$prop}: {$e->getMessage()}" : $e->getMessage();
            }

            throw new ValidationException($errorsArr);
        }
    }
}