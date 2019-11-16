<?php

namespace App\Infrastructure\Http\Resolver;

use App\Application\Cqs\BaseCriteria;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

class CriteriaResolver implements ArgumentValueResolverInterface
{
    public function supports(Request $request, ArgumentMetadata $argument)
    {
        return is_subclass_of($argument->getType(), BaseCriteria::class);
    }

    public function resolve(Request $request, ArgumentMetadata $argument)
    {
        $class = $argument->getType();
        $criteriaObject = new $class;

        if ($request->query->has('filters')) {
            $filters = $request->query->get('filters');
            foreach ($filters as $filter => $value) {
                if (property_exists($criteriaObject, $filter)) {
                    $criteriaObject->{$filter} = $value;
                }
            }

            if ($request->query->has('sort') && $request->query->has('order')) {
                $criteriaObject->sort = $request->query->get('sort');
                $criteriaObject->order = $request->query->get('order');
            }
        }

        yield $criteriaObject;
    }
}