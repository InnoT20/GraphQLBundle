<?php

declare(strict_types=1);

namespace Overblog\GraphQLBundle\Tests\Config\Parser\fixtures\annotations\Enum;

use Overblog\GraphQLBundle\Annotation as GQL;

/**
 * @GQL\Enum
 * @GQL\EnumValue(name="YES", description="Happiness")
 * @GQL\EnumValue(name="NO")
 * @GQL\Description("Choice")
 */
#[GQL\Enum]
#[GQL\Description('Choice')]
enum Choice
{
    #[GQL\Description('Happiness')]
    case YES;
    case NO;
}
