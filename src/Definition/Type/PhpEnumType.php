<?php

declare(strict_types=1);

namespace Overblog\GraphQLBundle\Definition\Type;

use GraphQL\Error\Error;
use GraphQL\Type\Definition\EnumType;
use GraphQL\Utils\Utils;
use UnitEnum;

class PhpEnumType extends EnumType
{
    public const MULTIPLE_DESCRIPTIONS_DISALLOWED = 'Using more than 1 Description attribute is not supported.';
    public const MULTIPLE_DEPRECATIONS_DISALLOWED = 'Using more than 1 Deprecated attribute is not supported.';

    /**
     * @var class-string<UnitEnum>
     */
    protected string $enumClass;

    /**
     * @param class-string<UnitEnum> $enum
     */
    public function __construct(string $enum, array $config)
    {
        $this->enumClass = $enum;

        parent::__construct($config);
    }

    public function serialize($value): string
    {
        if (!is_a($value, $this->enumClass)) {
            $notEnum = Utils::printSafe($value);

            throw new Error("Cannot serialize value as enum: {$notEnum}, expected instance of {$this->enumClass}.");
        }

        return $value->name;
    }
}
