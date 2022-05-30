<?php

namespace Overblog\GraphQLBundle\Util;

final class EnumHelper
{
    public static function getValue(\UnitEnum $enum): string
    {
        if ($enum instanceof \BackedEnum) {
            return $enum->value;
        }

        return $enum->name;
    }

    public static function buildInstance(string $className, mixed $data): \UnitEnum
    {
        if (is_subclass_of($className, \BackedEnum::class)) {
            return $className::from($data);
        }

        return constant("$className::$data");
    }
}
