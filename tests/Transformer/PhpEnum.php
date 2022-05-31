<?php

declare(strict_types=1);

namespace Overblog\GraphQLBundle\Tests\Transformer;

enum PhpEnum: string
{
    case op1 = 'val1';
    case op2 = 'val2';
    case op3 = 'val3';
}
