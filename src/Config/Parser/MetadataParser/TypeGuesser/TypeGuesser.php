<?php

declare(strict_types=1);

namespace Overblog\GraphQLBundle\Config\Parser\MetadataParser\TypeGuesser;

use Overblog\GraphQLBundle\Config\Parser\MetadataParser\ClassesTypesMap;

abstract class TypeGuesser implements TypeGuesserInterface
{
    protected ClassesTypesMap $map;

    public function __construct(ClassesTypesMap $map)
    {
        $this->map = $map;
    }
}
