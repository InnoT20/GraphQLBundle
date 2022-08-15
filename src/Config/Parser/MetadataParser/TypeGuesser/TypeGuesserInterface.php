<?php

declare(strict_types=1);

namespace Overblog\GraphQLBundle\Config\Parser\MetadataParser\TypeGuesser;

use ReflectionClass;
use ReflectionProperty;
use Reflector;

interface TypeGuesserInterface
{
   public function supports(Reflector $reflector): bool;

   public function getName(): string;

   public function guessType(ReflectionClass $reflectionClass, Reflector $reflector, array $filterGraphQLTypes = []): ?string;
}
