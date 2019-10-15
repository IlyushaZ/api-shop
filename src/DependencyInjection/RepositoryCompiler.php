<?php

namespace App\DependencyInjection;


use App\Infrastructure\Helper\ClassNameHelper;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class RepositoryCompiler implements CompilerPassInterface
{
    private $implementationPostfix = 'Impl';

    public function process(ContainerBuilder $container)
    {
        foreach ($container->findTaggedServiceIds('doctrine.repository') as $id => $service) {
            $class = $container->getDefinition($id)->getClass();

            if (null === $class) {
                continue;
            }

            $implementation = new \ReflectionClass($class);

            foreach ($implementation->getInterfaces() as $reflectionClass) {
                $interfaceChildName = str_replace('Read', '', ClassNameHelper::getChildName($reflectionClass->getName()));
                $implementationChildName = ClassNameHelper::getChildName($class);

                if ("{$interfaceChildName}{$this->implementationPostfix}" === $implementationChildName) {
                    $container->setAlias($reflectionClass->getName(), $implementation->getName());
                }
            }
        }
    }
}